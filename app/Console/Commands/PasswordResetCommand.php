<?php

namespace App\Console\Commands;

use App\Models\User;
use DB;
use Exception;
use Illuminate\Console\Command;

use function Laravel\Prompts\info;
use function Laravel\Prompts\search;

use Str;
use Throwable;

class PasswordResetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:password-reset
                                {--id= : The ID of the user to reset the password for}
                                {--email= : The ID of the user to reset the password for}
                                {--password=admin123 : password to use}
                        ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset a users password';

    /**
     * Execute the console command.
     *
     * @throws Throwable
     */
    public function handle(): int
    {
        $user = match (true) {
            (bool) $this->option('id')    => User::findOrFail($this->option('id')),
            (bool) $this->option('email') => User::where('email', $this->option('email'))->firstOrFail(),
            default                       => null
        };

        if ( ! $user) {
            info('No user specified, searching...');
            $user_id = search(
                label: 'User Search',
                options: function (string $value) {
                    $pluck_string = 'CONCAT("id: ", id, " ", email, " ", first_name, " ", last_name) as name';
                    $base_query   = User::query()->limit(100);

                    if (mb_strlen($value) === 0) {
                        return $base_query
                            ->pluck(
                                DB::raw($pluck_string),
                                'id'
                            )
                            ->all();
                    }

                    $search_term = Str::of($value)
                        ->wrap('%', '%')
                        ->replace(' ', '%')
                        ->toString();

                    return $base_query
                        ->searchName($search_term)
                        ->orWhere('email', 'like', $search_term)
                        ->pluck(
                            DB::raw($pluck_string),
                            'id'
                        )
                        ->all();
                },
                placeholder: 'Search for a user',
                hint: 'Search for a user by name or email address',
            );

            $user = User::findOrFail($user_id);
        }

        throw_if(
            ! $user,
            new Exception('You must specify either an ID or an email address')
        );

        $user->update([
            'password' => $this->option('password'),
        ]);

        info(sprintf(
            "\r\nPassword reset for user %s (%s) to \"%s\".\r\n",
            $user->name,
            $user->email,
            $this->option('password')
        ));

        return self::SUCCESS;
    }
}
