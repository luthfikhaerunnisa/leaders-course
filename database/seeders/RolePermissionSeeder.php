<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ownerRole = Role::firstOrCreate(['name' => 'owner']);
        $studentRole = Role::firstOrCreate(['name' => 'student']);
        $teacherRole = Role::firstOrCreate(['name' => 'teacher']);
        
        $userOwner = User::create([
            'name' => 'Leaders',
            'occupation' => 'Educator',
            'avatar' => 'images/default-avatar.png',
            'email' => 'leadersinternship@gmail.com',
            'password' => bcrypt('leaders123*')
        ]);

        // Assign role to the user
        $userOwner->assignRole($ownerRole);
    }
}
