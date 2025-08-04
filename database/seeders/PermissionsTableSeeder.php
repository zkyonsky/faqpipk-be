<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //permission for categories
        Permission::create(['name' => 'categories.index']);
        Permission::create(['name' => 'categories.create']);
        Permission::create(['name' => 'categories.edit']);
        Permission::create(['name' => 'categories.delete']);

         //permission for topics
        Permission::create(['name' => 'topics.index']);
        Permission::create(['name' => 'topics.create']);
        Permission::create(['name' => 'topics.edit']);
        Permission::create(['name' => 'topics.delete']);

        //permission for problems
        Permission::create(['name' => 'problems.index']);
        Permission::create(['name' => 'problems.create']);
        Permission::create(['name' => 'problems.edit']);
        Permission::create(['name' => 'problems.delete']);

        //permission for clusters
        Permission::create(['name' => 'clusters.index']);
        Permission::create(['name' => 'clusters.create']);
        Permission::create(['name' => 'clusters.edit']);
        Permission::create(['name' => 'clusters.delete']);

        //permission for courses
        Permission::create(['name' => 'courses.index']);
        Permission::create(['name' => 'courses.create']);
        Permission::create(['name' => 'courses.edit']);
        Permission::create(['name' => 'courses.delete']);

        //permission for roles
        Permission::create(['name' => 'roles.index']);
        Permission::create(['name' => 'roles.create']);
        Permission::create(['name' => 'roles.edit']);
        Permission::create(['name' => 'roles.delete']);

        //permission for permissions
        Permission::create(['name' => 'permissions.index']);

        //permission for users
        Permission::create(['name' => 'users.index']);
        Permission::create(['name' => 'users.create']);
        Permission::create(['name' => 'users.edit']);
        Permission::create(['name' => 'users.delete']);
    }
}
