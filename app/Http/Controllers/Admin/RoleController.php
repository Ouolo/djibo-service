<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
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
            abort(403, 'Vous n\'avez pas la permission de consulter les rôles.');
        }

        $search = $request->input('search');

        $query = Role::with('permissions');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        $roles = $query->paginate(15)->withQueryString();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->hasPermission('create_roles')) {
            abort(403, 'Vous n\'avez pas la permission de créer des rôles.');
        }

        $permissionsQuery = Permission::orderBy('group')->orderBy('action');
        if (!auth()->user()->isSuperAdmin()) {
            $myPermissionIds = auth()->user()->role->permissions()->pluck('permissions.id')->toArray();
            $permissionsQuery->whereIn('id', $myPermissionIds);
        }
        $permissions = $permissionsQuery->get()->groupBy('group');

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->hasPermission('create_roles')) {
            abort(403, 'Vous n\'avez pas la permission de créer des rôles.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles',
            'slug' => 'required|string|max:255|unique:roles',
            'description' => 'nullable|string',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        if (!auth()->user()->isSuperAdmin()) {
            $myPermissionIds = auth()->user()->role->permissions()->pluck('permissions.id')->toArray();
            $submittedPermissionIds = $request->input('permissions', []);
            if (array_diff($submittedPermissionIds, $myPermissionIds)) {
                return redirect()->back()->withInput()->withErrors(['permissions' => 'Vous ne pouvez attribuer que les permissions que vous possédez déjà.']);
            }
        }

        $role = Role::create($validated);
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('admin.roles.index')->with('success', 'Rôle créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        if (!auth()->user()->hasPermission('read_roles')) {
            abort(403, 'Vous n\'avez pas la permission de consulter les rôles.');
        }

        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        if (!auth()->user()->hasPermission('update_roles')) {
            abort(403, 'Vous n\'avez pas la permission de modifier les rôles.');
        }

        if (in_array($role->slug, ['superadmin', 'admin', 'editor', 'viewer'])
            && !auth()->user()->isSuperAdmin()) {
            abort(403, 'Vous n\'avez pas la permission de modifier ce rôle système.');
        }

        $permissionsQuery = Permission::orderBy('group')->orderBy('action');
        if (!auth()->user()->isSuperAdmin()) {
            $myPermissionIds = auth()->user()->role->permissions()->pluck('permissions.id')->toArray();
            $permissionsQuery->whereIn('id', $myPermissionIds);
        }
        $permissions = $permissionsQuery->get()->groupBy('group');
        $rolePermissions = $role->permissions()->pluck('permissions.id')->toArray();

        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        if (!auth()->user()->hasPermission('update_roles')) {
            abort(403, 'Vous n\'avez pas la permission de modifier les rôles.');
        }

        // Prevent modifying built-in roles for non-superadmin users
        if (in_array($role->slug, ['superadmin', 'admin', 'editor', 'viewer'])
            && !auth()->user()->isSuperAdmin()) {
            return redirect()->back()->with('error', 'Impossible de modifier un rôle système.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'description' => 'nullable|string',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        if (!auth()->user()->isSuperAdmin()) {
            $myPermissionIds = auth()->user()->role->permissions()->pluck('permissions.id')->toArray();
            $submittedPermissionIds = $request->input('permissions', []);
            if (array_diff($submittedPermissionIds, $myPermissionIds)) {
                return redirect()->back()->withInput()->withErrors(['permissions' => 'Vous ne pouvez attribuer que les permissions que vous possédez déjà.']);
            }
        }

        $role->update($validated);
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('admin.roles.index')->with('success', 'Rôle mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if (!auth()->user()->hasPermission('delete_roles')) {
            abort(403, 'Vous n\'avez pas la permission de supprimer les rôles.');
        }

        // Prevent deleting built-in roles
        if (in_array($role->slug, ['superadmin', 'admin', 'editor', 'viewer'])) {
            return redirect()->back()->with('error', 'Impossible de supprimer un rôle système.');
        }

        // Prevent deleting roles that have users
        if ($role->users()->count() > 0) {
            return redirect()->back()->with('error', 'Impossible de supprimer un rôle qui a des utilisateurs.');
        }

        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', 'Rôle supprimé avec succès.');
    }
}
