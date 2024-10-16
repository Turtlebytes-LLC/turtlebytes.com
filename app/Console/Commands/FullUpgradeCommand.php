<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RuntimeException;
use Symfony\Component\Process\Process;

class FullUpgradeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upgrade:full
                              {--no-bun}
                              {--no-composer}
                              {--no-migrate}
                              {--no-git-pull}
                              {--no-abilities}
                          ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run a full upgrade';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $check = $this->is_connected();

        if ( ! $check) {
            $this->error('No internet connection');

            return;
        }

        // run git pull if the argument is passed
        if ( ! $this->option('no-git-pull')) {
            $this->runProcess(command: ['git', 'pull']);
        }

        if (!$this->option('no-bun')) {
            $this->runProcess(command: ['bun', 'upgrade'], buffer_output: false);
        }

        if ( ! $this->option('no-composer')) {
            $this->runProcess(command: ['composer', 'update', '--quiet'], buffer_output: false);
        }

        if ( ! $this->option('no-migrate')) {
            $this->call('migrate');
        }

        if ( ! $this->option('no-abilities')) {
            $this->call(BouncerSeederCommand::class);
        }

        $this->info('All done have a great day!');
    }

    public function is_connected($url = 'www.google.com')
    {
        $connected = @fsockopen($url, 80); //website, port (try 80 or 443)
        if ($connected) {
            $is_conn = true; //action when connected
            fclose($connected);
        } else {
            $is_conn = false; //action in connection failure
        }

        return $is_conn;
    }

    /**
     * Run a process.
     *
     * @return void
     */
    protected function runProcess(array $command, int $timeout = 300, bool $buffer_output = true): void
    {
        $process_name = implode(' ', $command);

        $this->info("Running \"{$process_name}\"...");

        $process = new Process($command);
        $process->setTimeout($timeout); // 300 seconds = 5 minutes

        $process->run(function ($type, $buffer) use ($buffer_output): void {
            if ($buffer_output) {
                $this->output->write($buffer);
            }
        });

        if ( ! $process->isSuccessful()) {
            throw new RuntimeException($process->getErrorOutput());
        }

        $this->info("Finished running \"{$process_name}\".");
        $this->newLine();
    }
}
