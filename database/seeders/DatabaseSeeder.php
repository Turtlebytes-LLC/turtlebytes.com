<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Bouncer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Bouncer::allow('superadmin')->everything();

        $user = User::firstOrCreate(['email' => 'admin@admin.com'], [
            'name'     => 'Zach Robichaud',
            'email'    => 'admin@admin.com',
            'password' => 'admin123',
        ]);

        $user->assign('superadmin');

        $this->call([
            BlogSeeder::class,
        ]);
    }
}
