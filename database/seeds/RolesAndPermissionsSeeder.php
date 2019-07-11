<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{
		// Reset cached roles and permissions
		app()['cache']->forget('spatie.permission.cache');

		// create permissions
		Permission::firstOrCreate(['name' => 'create hotel', 'guard_name' => 'api']);
		Permission::firstOrCreate(['name' => 'update hotel' , 'guard_name' => 'api']);
		Permission::firstOrCreate(['name' => 'delete hotel', 'guard_name' => 'api']);

		// create roles and assign created permissions

		$role = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'api']);
		$role->givePermissionTo(Permission::all());
	}
}
