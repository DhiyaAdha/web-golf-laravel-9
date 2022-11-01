<?php

namespace App\Console\Commands;

use App\Models\Visitor;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class expiredMember extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:member';

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
        $user = Visitor::where('expired_date', '<=', Carbon::now())->update(['status' => 'inactive']);
        return $user;
    }
}
