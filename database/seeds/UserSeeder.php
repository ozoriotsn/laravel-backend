<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory('App\User', 2)->create();

        $users = [
            [
                'name' => 'Ozorio Neto',
                'email' => 'ozorio.silva.neto@gmail.com',
                'password' => Hash::make('user@123'),
                'remember_token' => Str::random(10),
                'email_verified_at' => now()
            ],
            [
                'name' => 'Diogo Zarpelon',
                'email' => 'diogo.zarpelon@jointecnologia.com.br',
                'password' => Hash::make('user@123'),
                'remember_token' => Str::random(10),
                'email_verified_at' => now()
            ]
        ];
        DB::table('users')->insert($users);


    }
}
