<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use App\Services\FacebookPublisher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProduitController extends Controller
{
    public function index(Request $request)
    {
        $query = Produit::orderBy('ordre', 'asc')->latest();

        if ($request->filled('search')) {
            $query->where('nom', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('statut')) {
            $query->where('actif', $request->statut === 'actif');
        }

        $produits = $query->paginate(10)->withQueryString();

        return view('admin.produits.index', compact('produits'));
    }

    public function create()
    {
        return view('admin.produits.form', ['produit' => new Produit()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom'                => 'required|string|max:255',
            'categorie'          => 'required|string|max:255',
            'description_courte' => 'required|string|max:500',
            'description'        => 'required|string',
            'avantages'          => 'nullable|string', // We will explode this into an array
            'mode_emploi'        => 'nullable|string',
            'prix'               => 'nullable|string|max:255',
            'image'              => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'en_vedette'         => 'boolean',
            'actif'              => 'boolean',
            'ordre'              => 'nullable|integer|min:0',
        ]);

        $data['slug']       = Str::slug($data['nom']);
        $data['en_vedette'] = $request->boolean('en_vedette');
        $data['actif']      = $request->boolean('actif');
        $data['ordre']      = $data['ordre'] ?? 0;
        
        if (!empty($data['avantages'])) {
            $data['avantages'] = array_map('trim', explode("\n", $data['avantages']));
            $data['avantages'] = array_filter($data['avantages']); // Remove empty lines
        } else {
            $data['avantages'] = [];
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('produits', 'public');
        }

        Produit::create($data);

        return redirect()->route('admin.produits.index')
            ->with('success', '✅ Produit créé avec succès !');
    }

    public function edit(Produit $produit)
    {
        return view('admin.produits.form', compact('produit'));
    }

    public function update(Request $request, Produit $produit)
    {
        $data = $request->validate([
            'nom'                => 'required|string|max:255',
            'categorie'          => 'required|string|max:255',
            'description_courte' => 'required|string|max:500',
            'description'        => 'required|string',
            'avantages'          => 'nullable|string',
            'mode_emploi'        => 'nullable|string',
            'prix'               => 'nullable|string|max:255',
            'image'              => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'en_vedette'         => 'boolean',
            'actif'              => 'boolean',
            'ordre'              => 'nullable|integer|min:0',
        ]);

        $data['slug']       = Str::slug($data['nom']);
        $data['en_vedette'] = $request->boolean('en_vedette');
        $data['actif']      = $request->boolean('actif');
        $data['ordre']      = $data['ordre'] ?? 0;
        
        if (!empty($data['avantages'])) {
            $data['avantages'] = array_map('trim', explode("\n", $data['avantages']));
            $data['avantages'] = array_filter($data['avantages']); // Remove empty lines
        } else {
            $data['avantages'] = [];
        }

        if ($request->hasFile('image')) {
            if ($produit->image && Storage::disk('public')->exists($produit->image)) {
                Storage::disk('public')->delete($produit->image);
            }
            $data['image'] = $request->file('image')->store('produits', 'public');
        } else {
            unset($data['image']);
        }

        $produit->update($data);

        return redirect()->route('admin.produits.index')
            ->with('success', '✅ Produit mis à jour avec succès !');
    }

    public function destroy(Produit $produit)
    {
        if ($produit->image && Storage::disk('public')->exists($produit->image)) {
            Storage::disk('public')->delete($produit->image);
        }

        $produit->delete();

        return redirect()->route('admin.produits.index')
            ->with('success', '🗑️ Produit supprimé.');
    }

    public function toggleActif(Produit $produit)
    {
        $produit->update(['actif' => !$produit->actif]);

        $msg = $produit->actif ? '✅ Produit activé.' : '📝 Produit désactivé.';

        return redirect()->back()->with('success', $msg);
    }

    public function publishToFacebook(Produit $produit, FacebookPublisher $facebook)
    {
        try {
            $facebook->publishProduct($produit);
            
            $produit->update([
                'published_to_facebook' => true,
                'published_at_facebook' => now(),
            ]);

            return redirect()->route('admin.produits.index')
                ->with('success', '✅ Produit publié sur Facebook !');
        } catch (\Exception $e) {
            Log::error("Facebook publish error: " . $e->getMessage());
            
            return redirect()->back()
                ->with('error', '❌ Erreur: ' . $e->getMessage());
        }
    }
}
