<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class TransferStudents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:transfer_students';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'transfer students';

    protected $user;

    /**
     * Create a new command instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct();

        $this->user = $user;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->user->activateTransferStudents();
    }
}
