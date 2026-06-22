<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Realisation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RealisationController extends Controller
{
    public function index(Request $request)
    {
        $query = Realisation::latest();

        if ($request->filled('search')) {
            $query->where('titre', 'like', '%' . $request->search . '%')
                  ->orWhere('localisation', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('statut')) {
            $query->where('actif', $request->statut === 'actif');
        }

        $realisations = $query->paginate(10)->withQueryString();

        return view('admin.realisations.index', compact('realisations'));
    }

    public function create()
    {
        return view('admin.realisations.form', ['realisation' => new Realisation()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titre'       => 'required|string|max:255',
            'localisation'=> 'required|string|max:255',
            'impact'      => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'date_projet' => 'nullable|date',
            'actif'       => 'boolean',
            'ordre'       => 'nullable|integer|min:0',
        ]);

        $data['slug']  = Str::slug($data['titre']);
        $data['actif'] = $request->boolean('actif');
        $data['ordre'] = $data['ordre'] ?? 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('realisations', 'public');
        }

        Realisation::create($data);

        return redirect()->route('admin.realisations.index')
            ->with('success', '✅ Réalisation créée avec succès !');
    }

    public function edit(Realisation $realisation)
    {
        return view('admin.realisations.form', compact('realisation'));
    }

    public function update(Request $request, Realisation $realisation)
    {
        $data = $request->validate([
            'titre'       => 'required|string|max:255',
            'localisation'=> 'required|string|max:255',
            'impact'      => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'date_projet' => 'nullable|date',
            'actif'       => 'boolean',
            'ordre'       => 'nullable|integer|min:0',
        ]);

        $data['actif'] = $request->boolean('actif');
        $data['ordre'] = $data['ordre'] ?? 0;

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si stockée sur le disque public
            if ($realisation->image && Storage::disk('public')->exists($realisation->image)) {
                Storage::disk('public')->delete($realisation->image);
            }
            $data['image'] = $request->file('image')->store('realisations', 'public');
        } else {
            unset($data['image']); // Conserver l'image existante
        }

        $realisation->update($data);

        return redirect()->route('admin.realisations.index')
            ->with('success', '✅ Réalisation mise à jour avec succès !');
    }

    public function destroy(Realisation $realisation)
    {
        if ($realisation->image && Storage::disk('public')->exists($realisation->image)) {
            Storage::disk('public')->delete($realisation->image);
        }

        $realisation->delete();

        return redirect()->route('admin.realisations.index')
            ->with('success', '🗑️ Réalisation supprimée.');
    }

    public function toggleActif(Realisation $realisation)
    {
        $realisation->update(['actif' => !$realisation->actif]);

        $msg = $realisation->actif ? '✅ Réalisation mise en ligne.' : '📝 Réalisation masquée.';

        return redirect()->back()->with('success', $msg);
    }
}
