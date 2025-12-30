<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{

    public function run(): void
    {
        $roles = [
            ['name' => 'admin'],
            ['name' => 'panitia'],
            ['name' => 'santri'],
            ['name' => 'penguji'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
