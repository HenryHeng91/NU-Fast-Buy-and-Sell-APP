<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'role_name' => 'read_only',
                'readonly_access' => 1,
                'api_access' => 0,
                'dashboard_access' => 0,
                'full_access' => 0,
            ],
            [
                'id' => 2,
                'role_name' => 'user',
                'readonly_access' => 1,
                'api_access' => 1,
                'dashboard_access' => 0,
                'full_access' => 0,
            ],
            [
                'id' => 3,
                'role_name' => 'dev',
                'readonly_access' => 1,
                'api_access' => 1,
                'dashboard_access' => 1,
                'full_access' => 0,
            ],
            [
                'id' => 4,
                'role_name' => 'admin',
                'readonly_access' => 1,
                'api_access' => 1,
                'dashboard_access' => 1,
                'full_access' => 1,
            ]
        ];
        DB::table('roles')->insert($data);
    }
}
