<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        convercity\User::create([   'first_name'    => 'Sean',
                                    'last_name'     => 'Alaback',
                                    'email'         => 'sean.alaback@gmail.com',
                                    'password'      => Hash::make('test123')
        ]);

    }

}
