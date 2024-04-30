<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Roles::create([
            'name' => 'Admin'
        ]);

        Roles::create([
            'name' => 'Karyawan'
        ]);

        User::create([
            'name' => 'Admin',
            'username' => 'admin@gmail.com',
            'password' => bcrypt('Shuudesh07!;'),
            'roles_id' => '1'
        ]);

        User::create([
            'name' => 'Karyawan',
            'username' => 'karyawan@gmail.com',
            'password' => bcrypt('Khooomeei12!;'),
            'roles_id' => '2'
        ]);

        $this->call(KategoriSeeder::class);
        $this->call(MenuSeeder::class);
    }
}
