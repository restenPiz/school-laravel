<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);

        $user = User::create([
            'name'          => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin@123'),
            'created_at'    => date("Y-m-d H:i:s")
        ]);
        $user->assignRole('Admin');

        $user2 = User::create([
            'name' => 'Abdul Meque',
            'email' => 'abdul@gmail.com',
            'password' => bcrypt('admin@123'),
            'created_at'    => date("Y-m-d H:i:s")
        ]);
        $user2->assignRole('Teacher');

        $user3 = User::create([
            'name' => 'Tobia Dai',
            'email' => 'tobiasParent@gmail.com',
            'password' => bcrypt('admin@123'),
            'created_at'    => date("Y-m-d H:i:s")
        ]);
        $user3->assignRole('Parent');

        $user4 = User::create([
            'name' => 'Mauro Peniel',
            'email' => 'mauroStudent@gmail.com',
            'password' => bcrypt('admin@123'),
            'created_at'    => date("Y-m-d H:i:s")
        ]);
        $user4->assignRole('Student');


        DB::table('teachers')->insert([
            [
                'user_id'           => $user2->id,
                'gender'            => 'male',
                'phone'             => '6969540014',
                'dateofbirth'       => '1990-04-11',
                'current_address'   => '63 Walnut Hill Drive',
                'permanent_address' => '385 Emma Street',
                'created_at'        => date("Y-m-d H:i:s")
            ]
        ]);

        DB::table('parents')->insert([
            [
                'user_id'           => $user3->id,
                'gender'            => 'male',
                'phone'             => '0147854545',
                'current_address'   => '46 Custer Street',
                'permanent_address' => '46 Custer Street',
                'created_at'        => date("Y-m-d H:i:s")
            ]
        ]);

        DB::table('grades')->insert([
            'teacher_id'        => 1,
            'class_numeric'     => 1,
            'class_name'        => 'One',
            'class_description' => 'class one',
            'registration_fee' => 3000,
            'monthly_fee' => 5000,
        ]);

        DB::table('students')->insert([
            [
                'user_id'           => $user4->id,
                'parent_id'         => 1,
                'class_id'          => 1,
                'roll_number'       => 1,
                'gender'            => 'male',
                'phone'             => '7801256654',
                'dateofbirth'       => '2007-04-11',
                'current_address'   => '103 Pine Tree Lane',
                'permanent_address' => '103 Pine Tree Lane',
                'created_at'        => date("Y-m-d H:i:s")
            ]
        ]);

    }
}
