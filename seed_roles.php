<?php
use App\Models\Role;
use App\Models\User;

$roles = [
    ['name' => 'super_admin', 'display_name' => 'Super Admin'],
    ['name' => 'admin', 'display_name' => 'Admin'],
    ['name' => 'teacher', 'display_name' => 'Teacher'],
    ['name' => 'accountant', 'display_name' => 'Accountant'],
    ['name' => 'reception', 'display_name' => 'Reception'],
    ['name' => 'student', 'display_name' => 'Student'],
];

foreach ($roles as $r) {
    Role::updateOrCreate(['name' => $r['name']], ['display_name' => $r['display_name']]);
}

$users = User::all();
foreach ($users as $user) {
    if ($user->role_id) {
        $user->roles()->syncWithoutDetaching([$user->role_id]);
    }
}
echo "Roles seeded and users attached successfully.\n";
