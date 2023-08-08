<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            'name' => 'Sohag Mollik',
            'email' => '180146.cse@student.just.edu.bd',
            'password' => bcrypt('12345678')
        ];
        Admin::create($admin);
    }
}
