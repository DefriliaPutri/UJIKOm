<?php

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\User;
        $administrator->username = "arul";
        $administrator->name = "Site Administrator";
        $administrator->email = "administrator2@gmail.com";
        $administrator->password = \Hash::make("admin1235");
        $administrator->phone = "081285075469";
        $administrator->avatar = "saat-ini-tidak-ada-file.png";
        $administrator->address = "Kota Bogor";
        
        $administrator->save();


        $this->command->info("User Admin berhasil diinsert");
        }
    }

