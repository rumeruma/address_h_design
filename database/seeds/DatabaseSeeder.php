<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
//        DB::table('users')->insert(
//            array(
//                [
//                    'name' => 'defaultuser',
//                    'email' => 'defaultuser@gmail.com',
//                    'password' => bcrypt('123456'),
//                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
//                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
//                ],
//                [
//                    'name' => 'defaultuser2',
//                    'email' => 'defaultuser2@gmail.com',
//                    'password' => bcrypt('123456'),
//                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
//                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
//                ])
//        );

        DB::table('admins')->insert(
            array(
                [
                    'name' => 'almas',
                    'email' => 'kutsnalmas@gmail.com',
                    'password' => bcrypt('123456'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'name' => 'another',
                    'email' => 'almasonly@gmail.com',
                    'password' => bcrypt('123456'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ])
        );

//        DB::table('roles')->insert(
//            array(
//                [
//                    'name' => 'admin',
//                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
//                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
//                ],
//                [
//                    'name' => 'reporter',
//                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
//                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
//                ])
//        );
//        DB::table('role_admins')->insert(
//            array(
//                [
//                    'role_id' => 1,
//                    'admin_id' => 1,
//                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
//                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
//                ],
//                [
//                    'role_id' => 2,
//                    'admin_id' => 2,
//                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
//                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
//                ])
//        );
    }
}
