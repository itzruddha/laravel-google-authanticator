<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Admin::truncate();
        $admin = Admin::create([
            'name' => 'Admin',
            'type' => 'admin',
            'password' => Hash::make('123456'),
            'email' => 'admin@admin.com',
            'mobile' => '0909778899',
            'picture' => '',
            'status' => 1,
        ]);
    }
}
