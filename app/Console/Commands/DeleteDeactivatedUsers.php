<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class DeleteDeactivatedUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:delete_deactivated';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes deactivated users';

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
     * @return mixed
     */
    public function handle()
    {

        User::whereNotNull('deactivated_at')->chunk(100, function ($users) {
            foreach ($users as $user) {
                $user->delete();
            }
        });

    }
}
