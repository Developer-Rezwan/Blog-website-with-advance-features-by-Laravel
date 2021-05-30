<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use App\Notifications\ReminderEmail;
use Carbon\Carbon;

class EmailToInactiveUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remind:inactiveUsers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email to the inactive User';

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
        $befor7days  = Carbon::now()->subDay(7);

        $users = User::where('login_at', '<=', $befor7days)->get();
        $count = 1;
        $this->info($users->count());
        foreach ($users as $user) {
            $user->notify(new ReminderEmail($user));
            $this->info($count++ . '. Successfully send the email to  ' . $user->email);
        }
    }
}