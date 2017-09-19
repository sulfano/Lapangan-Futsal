<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
            // [
            //     'name' => 'create-role',
            //     'display_name' => 'Create Role',
            //     'description'=> 'Create Role'
            // ],
            // [
            //     'name' => 'update-role',
            //     'display_name' => 'Update Role',
            //     'description'=> 'Update Role'
            // ],
            // [
            //     'name' => 'delete-role',
            //     'display_name' => 'Delete Role',
            //     'description'=> 'Delete Role'
            // ],
        	// [
        	// 	'name' => 'admin-create-kecamatan',
        	// 	'display_name' => 'Create Kecamatan',
        	// 	'description'=> 'Create Kecamatan'
        	// ],
        	// [
        	// 	'name' => 'admin-update-kelurahan',
        	// 	'display_name' => 'Update Kelurahan',
        	// 	'description'=> 'Update Kelurahan'
        	// ],
        	// [
        	// 	'name' => 'admin-delete-acara',
        	// 	'display_name' => 'Delete Acara',
        	// 	'description'=> 'Delete Acara'
        	// ],
        ];

        foreach ($permission as $key => $value) {
            Permission::create($value);
        }
    }
}
