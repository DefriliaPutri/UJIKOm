<?php

use Illuminate\Database\Seeder;

class OutletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\Outlet;
        $administrator->nama = "Oke Laundry";
        $administrator->alamat = "Jl. Pajajaran no.33";
        $administrator->tlp = "025163819";
        $administrator->save();

        $administrator = new \App\Outlet;
        $administrator->nama = "Sipp Laundry";
        $administrator->alamat = "Jl. Siliwangi no.33";
        $administrator->tlp = "025163828";
        $administrator->save();


        $this->command->info("User Admin berhasil diinsert");
    }
}
