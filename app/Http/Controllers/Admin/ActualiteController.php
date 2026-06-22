<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ActualiteController extends Controller
{
    public function index(Request $request)
    {
        $query = Actualite::latest('date_publication');

        if ($request->filled('search')) {
            $query->where('titre', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('statut')) {
            $query->where('publie', $request->statut === 'publie');
        }

        $actualites = $query->paginate(10)->withQueryString();

        return view('admin.actualites.index', compact('actualites'));
    }

    public function create()
    {
        return view('admin.actualites.form', ['actualite' => new Actualite()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titre' => 'required|string|max:255',
            'extrait' => 'required|string|max:500',
            'contenu' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'date_publication' => 'required|date',
            'publie' => 'boolean',
            'ordre' => 'nullable|integer|min:0',
        ]);

        $data['slug'] = Str::slug($data['titre']);
        $data['publie'] = $request->boolean('publie');
        $data['ordre'] = $data['ordre'] ?? 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('actualites', 'public');
        }

        Actualite::create($data);

        return redirect()->route('admin.actualites.index')
            ->with('success', '✅ Publication créée avec succès !');
    }

    public function edit(Actualite $actualite)
    {
        return view('admin.actualites.form', compact('actualite'));
    }

    public function update(Request $request, Actualite $actualite)
    {
        $data = $request->validate([
            'titre' => 'required|string|max:255',
            'extrait' => 'required|string|max:500',
            'contenu' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'date_publication' => 'required|date',
            'publie' => 'boolean',
            'ordre' => 'nullable|integer|min:0',
        ]);

        $data['slug'] = Str::slug($data['titre']);
        $data['publie'] = $request->boolean('publie');
        $data['ordre'] = $data['ordre'] ?? 0;

        if ($request->hasFile('image')) {
            // Delete old image if stored in public disk
            if ($actualite->image && Storage::disk('public')->exists($actualite->image)) {
                Storage::disk('public')->delete($actualite->image);
            }
            $data['image'] = $request->file('image')->store('actualites', 'public');
        } else {
            unset($data['image']); // Keep existing
        }

        $actualite->update($data);

        return redirect()->route('admin.actualites.index')
            ->with('success', '✅ Publication mise à jour avec succès !');
    }

    public function destroy(Actualite $actualite)
    {
        if ($actualite->image && Storage::disk('public')->exists($actualite->image)) {
            Storage::disk('public')->delete($actualite->image);
        }

        $actualite->delete();

        return redirect()->route('admin.actualites.index')
            ->with('success', '🗑️ Publication supprimée.');
    }

    public function togglePublie(Actualite $actualite)
    {
        $actualite->update(['publie' => !$actualite->publie]);

        $msg = $actualite->publie ? '✅ Publication mise en ligne.' : '📝 Publication mise en brouillon.';

        return redirect()->back()->with('success', $msg);
    }
}
