<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesandPermissionsSeeder extends Seeder
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
		Permission::create(['name' => 'create hotel']);
		Permission::create(['name' => 'update hotel']);
		Permission::create(['name' => 'delete hotel']);

		// create roles and assign created permissions

		$role = Role::create(['name' => 'admin']);
		$role->givePermissionTo(Permission::all());
	}
}
