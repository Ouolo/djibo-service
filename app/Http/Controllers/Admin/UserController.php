<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
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
        if (!auth()->user()->hasPermission('read_users')) {
            abort(403, 'Vous n\'avez pas la permission de consulter les utilisateurs.');
        }

        $search = $request->input('search');
        $roleId = $request->input('role_id');

        $usersQuery = User::with('role');

        if (!auth()->user()->isSuperAdmin()) {
            $usersQuery->whereDoesntHave('role', function ($query) {
                $query->whereIn('slug', ['superadmin', 'admin']);
            });
        }

        if ($search) {
            $usersQuery->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($roleId) {
            $usersQuery->where('role_id', $roleId);
        }

        $users = $usersQuery->paginate(15)->withQueryString();
        
        $rolesQuery = Role::with('permissions');
        if (!auth()->user()->isSuperAdmin()) {
            $rolesQuery->whereNotIn('slug', ['superadmin', 'admin']);
        }
        $roles = $rolesQuery->get();

        if (!auth()->user()->isSuperAdmin()) {
            $myPermissionIds = auth()->user()->role->permissions()->pluck('permissions.id')->toArray();
            $roles = $roles->filter(function($role) use ($myPermissionIds) {
                $rolePermissionIds = $role->permissions->pluck('id')->toArray();
                return empty(array_diff($rolePermissionIds, $myPermissionIds));
            });
        }

        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->hasPermission('create_users')) {
            abort(403, 'Vous n\'avez pas la permission de créer des utilisateurs.');
        }

        $rolesQuery = Role::with('permissions');
        if (!auth()->user()->isSuperAdmin()) {
            $rolesQuery->whereNotIn('slug', ['superadmin', 'admin']);
        }
        $roles = $rolesQuery->get();

        // Permissions supplémentaires disponibles (celles de l'admin actuel uniquement)
        $availableExtraPermissions = collect();
        if (!auth()->user()->isSuperAdmin()) {
            $myPermissionIds = auth()->user()->role->permissions()->pluck('permissions.id')->toArray();
            $roles = $roles->filter(function($role) use ($myPermissionIds) {
                $rolePermissionIds = $role->permissions->pluck('id')->toArray();
                return empty(array_diff($rolePermissionIds, $myPermissionIds));
            });
            $availableExtraPermissions = \App\Models\Permission::whereIn('id', $myPermissionIds)
                ->orderBy('group')->orderBy('action')->get()->groupBy('group');
        } else {
            $availableExtraPermissions = \App\Models\Permission::orderBy('group')->orderBy('action')->get()->groupBy('group');
        }

        return view('admin.users.create', compact('roles', 'availableExtraPermissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->hasPermission('create_users')) {
            abort(403, 'Vous n\'avez pas la permission de créer des utilisateurs.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        $role = Role::findOrFail($validated['role_id']);
        if (!auth()->user()->isSuperAdmin()) {
            if (in_array($role->slug, ['superadmin', 'admin'])) {
                abort(403, 'Vous n\'êtes pas autorisé à créer un utilisateur avec ce rôle.');
            }
            $myPermissionIds = auth()->user()->role->permissions()->pluck('permissions.id')->toArray();
            $rolePermissionIds = $role->permissions()->pluck('permissions.id')->toArray();
            if (array_diff($rolePermissionIds, $myPermissionIds)) {
                abort(403, 'Vous ne pouvez pas attribuer un rôle ayant des permissions supérieures aux vôtres.');
            }
        }

        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);

        // Permissions individuelles supplémentaires
        $extraIds = $request->input('extra_permissions', []);
        if (!empty($extraIds) && !auth()->user()->isSuperAdmin()) {
            $myPermissionIds = auth()->user()->role->permissions()->pluck('permissions.id')->toArray();
            $extraIds = array_intersect($extraIds, $myPermissionIds);
        }
        $user->extraPermissions()->sync($extraIds);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if (!auth()->user()->hasPermission('read_users')) {
            abort(403, 'Vous n\'avez pas la permission de consulter les utilisateurs.');
        }

        $this->ensureCannotManageAdmins($user);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if (!auth()->user()->hasPermission('update_users')) {
            abort(403, 'Vous n\'avez pas la permission de modifier les utilisateurs.');
        }

        $this->ensureCannotManageAdmins($user);

        $rolesQuery = Role::with('permissions');
        if (!auth()->user()->isSuperAdmin()) {
            $rolesQuery->whereNotIn('slug', ['superadmin', 'admin']);
        }
        $roles = $rolesQuery->get();

        $availableExtraPermissions = collect();
        if (!auth()->user()->isSuperAdmin()) {
            $myPermissionIds = auth()->user()->role->permissions()->pluck('permissions.id')->toArray();
            $roles = $roles->filter(function($role) use ($myPermissionIds) {
                $rolePermissionIds = $role->permissions->pluck('id')->toArray();
                return empty(array_diff($rolePermissionIds, $myPermissionIds));
            });
            $availableExtraPermissions = \App\Models\Permission::whereIn('id', $myPermissionIds)
                ->orderBy('group')->orderBy('action')->get()->groupBy('group');
        } else {
            $availableExtraPermissions = \App\Models\Permission::orderBy('group')->orderBy('action')->get()->groupBy('group');
        }

        $userExtraPermissionIds = $user->extraPermissions()->pluck('permissions.id')->toArray();

        return view('admin.users.edit', compact('user', 'roles', 'availableExtraPermissions', 'userExtraPermissionIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if (!auth()->user()->hasPermission('update_users')) {
            abort(403, 'Vous n\'avez pas la permission de modifier les utilisateurs.');
        }

        $this->ensureCannotManageAdmins($user);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $role = Role::findOrFail($validated['role_id']);
        if (!auth()->user()->isSuperAdmin()) {
            if (in_array($role->slug, ['superadmin', 'admin'])) {
                abort(403, 'Vous n\'êtes pas autorisé à attribuer ce rôle.');
            }
            $myPermissionIds = auth()->user()->role->permissions()->pluck('permissions.id')->toArray();
            $rolePermissionIds = $role->permissions()->pluck('permissions.id')->toArray();
            if (array_diff($rolePermissionIds, $myPermissionIds)) {
                abort(403, 'Vous ne pouvez pas attribuer un rôle ayant des permissions supérieures aux vôtres.');
            }
        }

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = bcrypt($validated['password']);
        }

        $user->update($validated);

        // Permissions individuelles supplémentaires
        $extraIds = $request->input('extra_permissions', []);
        if (!empty($extraIds) && !auth()->user()->isSuperAdmin()) {
            $myPermissionIds = auth()->user()->role->permissions()->pluck('permissions.id')->toArray();
            $extraIds = array_intersect($extraIds, $myPermissionIds);
        }
        $user->extraPermissions()->sync($extraIds);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (!auth()->user()->hasPermission('delete_users')) {
            abort(403, 'Vous n\'avez pas la permission de supprimer les utilisateurs.');
        }

        $this->ensureCannotManageAdmins($user);

        // Prevent deleting the only super admin
        if ($user->role->slug === 'superadmin' && User::whereHas('role', function ($q) {
            $q->where('slug', 'superadmin');
        })->count() === 1) {
            return redirect()->route('admin.users.index')->with('error', 'Impossible de supprimer le seul super admin.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }

    protected function ensureCannotManageAdmins(User $user)
    {
        if ($user->role && in_array($user->role->slug, ['superadmin', 'admin']) && !auth()->user()->isSuperAdmin()) {
            abort(403, 'Vous n\'avez pas la permission d\'interagir avec ce compte.');
        }
    }
}
