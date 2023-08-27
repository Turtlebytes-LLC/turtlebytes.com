<?php

namespace Database\Seeders;

use App\Models\Blog;
use Exception;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws Exception
     */
    public function run(): void
    {
        if (Blog::count()) {
            return;
        }

        Blog::factory(random_int(2, 5))
            ->hasPosts(random_int(2, 5))
            ->create();
    }
}
