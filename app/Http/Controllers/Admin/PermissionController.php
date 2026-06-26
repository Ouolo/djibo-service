<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!auth()->user()->hasPermission('read_roles')) {
            abort(403, 'Vous n\'avez pas la permission de consulter les permissions.');
        }

        $search = $request->input('search');
        $group = $request->input('group');

        $query = Permission::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        if ($group) {
            $query->where('group', $group);
        }

        $permissions = $query->orderBy('group')->orderBy('action')->paginate(25)->withQueryString();
        $groups = Permission::select('group')->distinct()->pluck('group');

        return view('admin.permissions.index', compact('permissions', 'groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->hasPermission('create_roles')) {
            abort(403, 'Vous n\'avez pas la permission de créer des permissions.');
        }

        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->hasPermission('create_roles')) {
            abort(403, 'Vous n\'avez pas la permission de créer des permissions.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:permissions',
            'group' => 'required|string',
            'action' => 'required|string',
            'description' => 'nullable|string',
        ]);

        Permission::create($validated);

        return redirect()->route('admin.permissions.index')->with('success', 'Permission créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        if (!auth()->user()->hasPermission('read_roles')) {
            abort(403, 'Vous n\'avez pas la permission de consulter les permissions.');
        }

        return view('admin.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        if (!auth()->user()->hasPermission('update_roles')) {
            abort(403, 'Vous n\'avez pas la permission de modifier les permissions.');
        }

        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        if (!auth()->user()->hasPermission('update_roles')) {
            abort(403, 'Vous n\'avez pas la permission de modifier les permissions.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'group' => 'required|string',
            'action' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $permission->update($validated);

        return redirect()->route('admin.permissions.index')->with('success', 'Permission mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        if (!auth()->user()->hasPermission('delete_roles')) {
            abort(403, 'Vous n\'avez pas la permission de supprimer les permissions.');
        }

        $permission->delete();

        return redirect()->route('admin.permissions.index')->with('success', 'Permission supprimée avec succès.');
    }
}
