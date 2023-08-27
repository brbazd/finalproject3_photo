<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rolenames = ['admin','user'];

        foreach($rolenames as $rolename)
        {
            Role::create([
                'name' => $rolename
            ]);
        }
    }
}
