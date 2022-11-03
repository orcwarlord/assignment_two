<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(1)
            ->create([
                'name' => 'Test Admin 1',
                'email' => 'testadmin1@testadmin.com',
                'password' => Hash::make('password'),
                'userlevel' => 'admin',
            ]);

        User::factory()
        ->count(1)
        ->create([
            'name' => 'Test Admin 2',
            'email' => 'testadmin2@testadmin.com',
            'password' => Hash::make('password'),
            'userlevel' => 'admin',
        ]);

        User::factory()
            ->count(4)
            ->create([
                'userlevel' => 'user',
            ]);

    }
}

