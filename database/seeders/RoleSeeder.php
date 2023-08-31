<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administratorRole = Role::create(['name' => 'admin']);
        $responsableRole = Role::create(['name' => 'responsable']);
        $testRole = Role::create(['name' => 'testRole']);

        Permission::create([
            'name' => 'admin.home',
            'description' => 'Ver panel administrativo'
        ])->syncRoles([$administratorRole, $responsableRole, $testRole]);

        //CUSTOMERS
        Permission::create([
            'name' => 'admin.customers.index',
            'description' => 'Listar clientes'
        ])->syncRoles([$administratorRole, $responsableRole]);
        Permission::create([
            'name' => 'admin.customers.store',
            'description' => 'Registrar clientes'
        ])->syncRoles([$administratorRole]);
        Permission::create([
            'name' => 'admin.customers.update',
            'description' => 'Actualizar clientes'
        ])->syncRoles([$administratorRole]);
        Permission::create([
            'name' => 'admin.customers.watchDocuments',
            'description' => 'Ver documentos de clientes'
        ])->syncRoles([$administratorRole, $responsableRole]);

        //COMERCIAL OFFERS
        Permission::create([
            'name' => 'admin.commercialOffers.index',
            'description' => 'Ver ofertas comerciales'
        ])->syncRoles([$administratorRole, $responsableRole]);
        Permission::create([
            'name' => 'admin.commercialOffers.store',
            'description' => 'Registrar ofertas comerciales'
        ])->syncRoles([$administratorRole]);
        //Permission::create(['name' => 'admin.commercialOffers.update']);
        //Permission::create(['name' => 'admin.commercialOffers.watchDocuments']);
    }
}
