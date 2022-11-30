<?php

namespace App\Console\Commands;

use App\Models\LogAdmin;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class resetLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:reset_log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset log activity admin setiap setahun sekali';

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
        return LogAdmin::whereYear('created_at', '<=', Carbon::now()->year)->delete();
    }
}
