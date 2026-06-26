<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            // Actualites permissions
            ['name' => 'Créer actualités', 'slug' => 'create_actualites', 'group' => 'actualites', 'action' => 'create'],
            ['name' => 'Voir actualités', 'slug' => 'read_actualites', 'group' => 'actualites', 'action' => 'read'],
            ['name' => 'Modifier actualités', 'slug' => 'update_actualites', 'group' => 'actualites', 'action' => 'update'],
            ['name' => 'Supprimer actualités', 'slug' => 'delete_actualites', 'group' => 'actualites', 'action' => 'delete'],

            // Produits permissions
            ['name' => 'Créer produits', 'slug' => 'create_produits', 'group' => 'produits', 'action' => 'create'],
            ['name' => 'Voir produits', 'slug' => 'read_produits', 'group' => 'produits', 'action' => 'read'],
            ['name' => 'Modifier produits', 'slug' => 'update_produits', 'group' => 'produits', 'action' => 'update'],
            ['name' => 'Supprimer produits', 'slug' => 'delete_produits', 'group' => 'produits', 'action' => 'delete'],
            ['name' => 'Publier produits sur Facebook', 'slug' => 'publish_produits_facebook', 'group' => 'produits', 'action' => 'publish'],

            // Realisations permissions
            ['name' => 'Créer réalisations', 'slug' => 'create_realisations', 'group' => 'realisations', 'action' => 'create'],
            ['name' => 'Voir réalisations', 'slug' => 'read_realisations', 'group' => 'realisations', 'action' => 'read'],
            ['name' => 'Modifier réalisations', 'slug' => 'update_realisations', 'group' => 'realisations', 'action' => 'update'],
            ['name' => 'Supprimer réalisations', 'slug' => 'delete_realisations', 'group' => 'realisations', 'action' => 'delete'],

            // Users permissions
            ['name' => 'Créer utilisateurs', 'slug' => 'create_users', 'group' => 'users', 'action' => 'create'],
            ['name' => 'Voir utilisateurs', 'slug' => 'read_users', 'group' => 'users', 'action' => 'read'],
            ['name' => 'Modifier utilisateurs', 'slug' => 'update_users', 'group' => 'users', 'action' => 'update'],
            ['name' => 'Supprimer utilisateurs', 'slug' => 'delete_users', 'group' => 'users', 'action' => 'delete'],
            ['name' => 'Assigner rôles', 'slug' => 'assign_roles', 'group' => 'users', 'action' => 'assign'],

            // Roles permissions
            ['name' => 'Créer rôles', 'slug' => 'create_roles', 'group' => 'roles', 'action' => 'create'],
            ['name' => 'Voir rôles', 'slug' => 'read_roles', 'group' => 'roles', 'action' => 'read'],
            ['name' => 'Modifier rôles', 'slug' => 'update_roles', 'group' => 'roles', 'action' => 'update'],
            ['name' => 'Supprimer rôles', 'slug' => 'delete_roles', 'group' => 'roles', 'action' => 'delete'],
        ];

        $createdPermissions = [];
        foreach ($permissions as $permission) {
            $createdPermissions[$permission['slug']] = Permission::firstOrCreate(
                ['slug' => $permission['slug']],
                $permission
            );
        }

        // Create roles
        $superAdmin = Role::firstOrCreate(
            ['slug' => 'superadmin'],
            [
                'name' => 'Super Admin',
                'description' => 'Accès complet à toutes les fonctionnalités'
            ]
        );

        $admin = Role::firstOrCreate(
            ['slug' => 'admin'],
            [
                'name' => 'Admin',
                'description' => 'Accès complet sauf gestion des admins'
            ]
        );

        $editor = Role::firstOrCreate(
            ['slug' => 'editor'],
            [
                'name' => 'Éditeur',
                'description' => 'Peut créer et modifier du contenu'
            ]
        );

        $viewer = Role::firstOrCreate(
            ['slug' => 'viewer'],
            [
                'name' => 'Lecteur',
                'description' => 'Accès en lecture seule'
            ]
        );

        // Assign permissions to Super Admin (all permissions)
        $superAdmin->permissions()->sync(array_values($createdPermissions));

        // Assign permissions to Admin (everything except role management)
        $adminPermissions = array_filter($createdPermissions, function ($key) {
            return !str_starts_with($key, 'create_roles') 
                && !str_starts_with($key, 'update_roles') 
                && !str_starts_with($key, 'delete_roles');
        }, ARRAY_FILTER_USE_KEY);
        $admin->permissions()->sync($adminPermissions);

        // Assign permissions to Editor (create and update actualites, produits, realisations)
        $editorPermissions = [
            'create_actualites',
            'read_actualites',
            'update_actualites',
            'create_produits',
            'read_produits',
            'update_produits',
            'create_realisations',
            'read_realisations',
            'update_realisations',
        ];
        $editor->permissions()->sync(array_map(function ($slug) use ($createdPermissions) {
            return $createdPermissions[$slug]->id;
        }, $editorPermissions));

        // Assign permissions to Viewer (read-only)
        $viewerPermissions = [
            'read_actualites',
            'read_produits',
            'read_realisations',
            'read_users',
            'read_roles',
        ];
        $viewer->permissions()->sync(array_map(function ($slug) use ($createdPermissions) {
            return $createdPermissions[$slug]->id;
        }, $viewerPermissions));
    }
}
