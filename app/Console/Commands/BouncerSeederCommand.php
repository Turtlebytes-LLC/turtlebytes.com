<?php

namespace App\Console\Commands;

use Bouncer;
use Illuminate\Console\Command;

class BouncerSeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bouncer:seeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reads the models directory and creates a seeder for each model.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        collect(scandir(app_path('Models')))
            ->filter(fn ($file) => ! in_array($file, ['.', '..']))
            ->map(fn ($file) => str_replace('.php', '', $file))
            ->each(function ($model): void {
                $abilities = [
                    'create',
                    'view',
                    'update',
                    'delete',
                ];

                Bouncer::allow('admin')->to($abilities, "App\\Models\\{$model}");
                //                Bouncer::allow('instructor')->to($abilities, "App\\Models\\{$model}");
                //                Bouncer::allow('student')->to($abilities, "App\\Models\\{$model}");
                //                Bouncer::allow('user')->to($abilities, "App\\Models\\{$model}");
            });
    }
}
