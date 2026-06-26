<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Temoignage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TemoignageController extends Controller
{
    public function index(Request $request)
    {
        $query = Temoignage::latest('created_at');

        if ($request->filled('search')) {
            $query->where('nom_client', 'like', '%' . $request->search . '%')
                  ->orWhere('role', 'like', '%' . $request->search . '%')
                  ->orWhere('localisation', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('statut')) {
            $query->where('publie', $request->statut === 'publie');
        }

        $temoignages = $query->paginate(10)->withQueryString();

        return view('admin.temoignages.index', compact('temoignages'));
    }

    public function create()
    {
        return view('admin.temoignages.form', ['temoignage' => new Temoignage()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom_client' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'localisation' => 'required|string|max:255',
            'type' => 'required|in:text,image,video',
            'contenu' => 'required|string',
            'media' => 'nullable|file|mimes:jpeg,png,jpg,webp,mp4,mov,avi,mkv|max:50000',
            'avant' => 'nullable|string|max:500',
            'apres' => 'nullable|string|max:500',
            'publie' => 'boolean',
            'ordre' => 'nullable|integer|min:0',
        ]);

        $data['publie'] = $request->boolean('publie');
        $data['ordre'] = $data['ordre'] ?? 0;

        if ($request->hasFile('media')) {
            if ($data['type'] === 'image') {
                $data['media'] = $request->file('media')->store('temoignages/images', 'public');
            } elseif ($data['type'] === 'video') {
                $data['media'] = $request->file('media')->store('temoignages/videos', 'public');
            }
        }

        Temoignage::create($data);

        return redirect()->route('admin.temoignages.index')
            ->with('success', '✅ Témoignage créé avec succès !');
    }

    public function edit(Temoignage $temoignage)
    {
        return view('admin.temoignages.form', compact('temoignage'));
    }

    public function update(Request $request, Temoignage $temoignage)
    {
        $data = $request->validate([
            'nom_client' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'localisation' => 'required|string|max:255',
            'type' => 'required|in:text,image,video',
            'contenu' => 'required|string',
            'media' => 'nullable|file|mimes:jpeg,png,jpg,webp,mp4,mov,avi,mkv|max:50000',
            'avant' => 'nullable|string|max:500',
            'apres' => 'nullable|string|max:500',
            'publie' => 'boolean',
            'ordre' => 'nullable|integer|min:0',
        ]);

        $data['publie'] = $request->boolean('publie');
        $data['ordre'] = $data['ordre'] ?? 0;

        if ($request->hasFile('media')) {
            // Supprimer l'ancien fichier
            if ($temoignage->media && Storage::disk('public')->exists($temoignage->media)) {
                Storage::disk('public')->delete($temoignage->media);
            }

            if ($data['type'] === 'image') {
                $data['media'] = $request->file('media')->store('temoignages/images', 'public');
            } elseif ($data['type'] === 'video') {
                $data['media'] = $request->file('media')->store('temoignages/videos', 'public');
            }
        } else {
            unset($data['media']); // Conserver l'existant
        }

        $temoignage->update($data);

        return redirect()->route('admin.temoignages.index')
            ->with('success', '✅ Témoignage mis à jour avec succès !');
    }

    public function destroy(Temoignage $temoignage)
    {
        if ($temoignage->media && Storage::disk('public')->exists($temoignage->media)) {
            Storage::disk('public')->delete($temoignage->media);
        }

        $temoignage->delete();

        return redirect()->route('admin.temoignages.index')
            ->with('success', '✅ Témoignage supprimé avec succès !');
    }

    /**
     * Changer le statut de publication
     */
    public function togglePublish(Temoignage $temoignage)
    {
        $temoignage->update(['publie' => !$temoignage->publie]);

        return back()->with('success', '✅ Statut mis à jour avec succès !');
    }

    /**
     * Changer l'ordre
     */
    public function updateOrder(Request $request)
    {
        $data = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:temoignages,id'
        ]);

        foreach ($data['ids'] as $index => $id) {
            Temoignage::find($id)->update(['ordre' => $index]);
        }

        return response()->json(['message' => '✅ Ordre mis à jour avec succès !']);
    }
}
