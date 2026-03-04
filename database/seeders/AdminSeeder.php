<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Create default roles
        $roles = [
            ['name' => 'super_admin', 'display_name' => 'Super Admin', 'description' => 'Full system access'],
            ['name' => 'admin',       'display_name' => 'Admin',       'description' => 'Administrative access'],
            ['name' => 'teacher',     'display_name' => 'Teacher',     'description' => 'Teacher access'],
            ['name' => 'student',     'display_name' => 'Student',     'description' => 'Student access'],
            ['name' => 'parent',      'display_name' => 'Parent',      'description' => 'Parent/Guardian access'],
            ['name' => 'accountant',  'display_name' => 'Accountant',  'description' => 'Accounts access'],
            ['name' => 'librarian',   'display_name' => 'Librarian',   'description' => 'Library access'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role['name']], $role);
        }

        // Create default Super Admin user
        $superAdminRole = Role::where('name', 'super_admin')->first();

        User::firstOrCreate(
            ['email' => 'admin@mbclasses.com'],
            [
                'name'     => 'Super Admin',
                'email'    => 'admin@mbclasses.com',
                'phone'    => '9931148498',
                'password' => Hash::make('admin123'),
                'role_id'  => $superAdminRole->id,
                'status'   => 'active',
            ]
        );

        echo "✅ Roles created: " . count($roles) . "\n";
        echo "✅ Super Admin user: admin@mbclasses.com / admin123\n";
    }
}
