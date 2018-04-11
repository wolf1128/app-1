<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('clients')->insert(
            [
                'title' => 'mr',
                'name' => 'Salar',
                'last_name' => 'Farahmand',
                'address' => 'Street 123',
                'zip_code' => '06040',
                'city' => 'Tulsa',
                'state' => 'Ok',
                'email' => 'salar@example.com',
            ]
        );

        DB::table('clients')->insert(
            [
                'title' => 'mrs',
                'name' => 'Mahsa',
                'last_name' => 'Arsalani',
                'address' => 'Another street 456',
                'zip_code' => '13000',
                'city' => 'Los angeles',
                'state' => 'CA',
                'email' => 'mahsa@example.com',
            ]
        );
    }
}
