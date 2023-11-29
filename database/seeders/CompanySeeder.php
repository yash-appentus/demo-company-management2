<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create(['name' => 'Demo 1', 'email' => 'demo1@gmail.com', 'phone' => '1234567890', 'parent_id' => '0', 'role_id' => '0', 'password' => Hash::make('demo1'),]);
        Company::create(['name' => 'Demo 2', 'email' => 'demo2@gmail.com', 'phone' => '0000000000', 'parent_id' => '0', 'role_id' => '0', 'password' => Hash::make('demo2'),]);
    }
}
