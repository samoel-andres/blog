<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // roles
        $admin = Role::create(['name' => 'Administrator']);
        $author = Role::create(['name' => 'Author']);

        // permissions
        Permission::create(['name' => 'admin.index', 'description' => 'Ver el Dashboard'])
            ->syncRoles([$admin, $author]);

        // categories
        Permission::create(['name' => 'categories.index', 'description' => 'Ver categorias'])
            ->syncRoles([$admin, $author]);
        Permission::create(['name' => 'categories.create', 'description' => 'Crear categorias'])
            ->assignRole($admin);
        Permission::create(['name' => 'categories.edit', 'description' => 'Editar categorias'])
            ->assignRole($admin);
        Permission::create(['name' => 'categories.destroy', 'description' => 'Eliminar categorias'])
            ->assignRole($admin);

        // articles
        Permission::create(['name' => 'articles.index', 'description' => 'Ver articulos'])
            ->syncRoles([$admin, $author]);
        Permission::create(['name' => 'articles.create', 'description' => 'Crear articulos'])
            ->syncRoles([$admin, $author]);
        Permission::create(['name' => 'articles.edit', 'description' => 'Editar articulos'])
            ->syncRoles([$admin, $author]);
        Permission::create(['name' => 'articles.destroy', 'description' => 'Eliminar articulos'])
            ->syncRoles([$admin, $author]);

        // comments
        Permission::create(['name' => 'comments.index', 'description' => 'Ver comentarios'])
            ->syncRoles([$admin, $author]);
        Permission::create(['name' => 'comments.create', 'description' => 'Crear comentarios'])
            ->syncRoles([$admin, $author]);

        // users
        Permission::create(['name' => 'users.index', 'description' => 'Ver usuarios'])
            ->assignRole($admin);
        Permission::create(['name' => 'users.edit', 'description' => 'Editar usuarios'])
            ->assignRole($admin);
        Permission::create(['name' => 'users.destroy', 'description' => 'Eliminar usuarios'])
            ->assignRole($admin);

        // roles
        Permission::create(['name' => 'roles.index', 'description' => 'Ver roles'])
            ->assignRole($admin);
        Permission::create(['name' => 'roles.create', 'description' => 'Crear roles'])
            ->assignRole($admin);
        Permission::create(['name' => 'roles.edit', 'description' => 'Editar roles'])
            ->assignRole($admin);
        Permission::create(['name' => 'roles.destroy', 'description' => 'Eliminar roles'])
            ->assignRole($admin);
    }
}
