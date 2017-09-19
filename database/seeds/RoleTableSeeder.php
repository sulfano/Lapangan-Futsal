<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
        	// [
        	// 	'name' => 'administrator',
        	// 	'display_name' => 'Administrator',
        	// 	'description'=> 'Administrator'
        	// ],
        	// [
        	// 	'name' => 'member-lapangan',
        	// 	'display_name' => 'Member Lapangan',
        	// 	'description'=> 'Member Lapangan'
        	// ],
        	[
        		'name' => 'member-acara',
        		'display_name' => 'Member Acara',
        		'description'=> 'Member Acara'
        	]
        ];

        foreach ($role as $key => $value) {
        	Role::create($value);
        }
    }
}
