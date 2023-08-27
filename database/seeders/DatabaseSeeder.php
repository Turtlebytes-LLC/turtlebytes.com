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
            'name'     => 'Test User',
            'email'    => 'admin@admin.com',
            'password' => 'admin123',
        ]);

        $user->assign('superadmin');
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
