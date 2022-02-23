<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class Hello extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hello';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // == https://laravel.com/docs/8.x/artisan#command-io

        $name = $this->ask('What is your name?');
        $email = $this->ask('What is your email?');
        $password = $this->secret('What is the password?');

        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt($password);

        if ($this->confirm('Do you wish to create the user?')) {

            $user->save();
            $this->info('The user was created!');

            return 0;
        }

        $this->warn('aborted...');

        return 1;
    }
}
