<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles and permissions first
        $this->call(RolePermissionSeeder::class);

        // Create or update a super-admin account so migrations+seeding provide an admin
        $superRole = Role::where('slug', 'superadmin')->first();

        if ($superRole) {
            $user = User::where('email', 'admin@djiboservices.com')->first();
            if (!$user) {
                $user = User::create([
                    'name' => 'Super Admin',
                    'email' => 'admin@djiboservices.com',
                    'password' => Hash::make('Admin@djibo2026'),
                    'is_admin' => true,
                ]);
            }

            // Ensure the user has the superadmin role
            $user->role_id = $superRole->id;
            $user->is_admin = true;
            $user->save();
        }
    }
}
