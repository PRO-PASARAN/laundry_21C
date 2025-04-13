<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'Razvan Pasaran',
            'email' => 'razvanandreipasaran@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
            'is_active' => true,
            // Câmpurile pentru student pot rămâne null pentru admin
            'faculty' => null,
            'room' => null,
            'floor' => null,
        ]);
    }
}
