<?php
use App\User;
use App\Grade;
use App\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);

        // Criação do Usuário Admin
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin@123'),
            'created_at' => now(),
        ]);
        $user->assignRole('Admin');

        // Criação do Usuário Professor
        $user2 = User::create([
            'name' => 'Abdul Meque',
            'email' => 'abdul@gmail.com',
            'password' => bcrypt('admin@123'),
            'created_at' => now(),
        ]);
        $user2->assignRole('Teacher');

        // Criação do Usuário Pai
        $user3 = User::create([
            'name' => 'Tobia Dai',
            'email' => 'tobiasParent@gmail.com',
            'password' => bcrypt('admin@123'),
            'created_at' => now(),
        ]);
        $user3->assignRole('Parent');

        // Criação do Usuário Estudante
        $user4 = User::create([
            'name' => 'Mauro Peniel',
            'email' => 'mauroStudent@gmail.com',
            'password' => bcrypt('admin@123'),
            'created_at' => now(),
        ]);
        $user4->assignRole('Student');

        // Criação de Professor
        $teacher = Teacher::create([
            'user_id' => $user2->id,
            'gender' => 'male',
            'phone' => '6969540014',
            'dateofbirth' => '1990-04-11',
            'current_address' => '63 Walnut Hill Drive',
            'permanent_address' => '385 Emma Street',
            'created_at' => now(),
        ]);

        DB::table('parents')->insert([
            'user_id' => $user3->id,
            'gender' => 'male',
            'phone' => '0147854545',
            'current_address' => '46 Custer Street',
            'permanent_address' => '46 Custer Street',
            'created_at' => now(),
        ]);

        $grade = Grade::create([
            'class_numeric' => 1,
            'class_name' => 'Tecnologia de Informacao',
            'class_description' => 'IT',
            'registration_fee' => 3000,
            'monthly_fee' => 5000,
        ]);

        $grade->teacher()->sync([$teacher->id]);

        DB::table('students')->insert([
            'user_id' => $user4->id,
            'parent_id' => $user3->id,
            'class_id' => $grade->id,
            'roll_number' => 1,
            'gender' => 'male',
            'phone' => '7801256654',
            'dateofbirth' => '2007-04-11',
            'current_address' => '103 Pine Tree Lane',
            'permanent_address' => '103 Pine Tree Lane',
            'created_at' => now(),
        ]);
    }
}
