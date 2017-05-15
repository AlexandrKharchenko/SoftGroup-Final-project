<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersAdmin = [
            [
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin1545'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]

        ];

        DB::table('roles')->insert([
            [
                'name' => 'admin',
                'display_name' => 'Администратор',
                'description' => 'Администратор системы со всеми правами',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'user',
                'display_name' => 'Пользователь',
                'description' => 'Пользователь системы, доступны все дейтвия во Front-end',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        foreach ($usersAdmin as $admin){
            $adminDb = User::create($admin);
            $adminDb->roles()->attach(1);

        }
    }
}
