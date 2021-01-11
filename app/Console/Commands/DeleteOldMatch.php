<?php

namespace App\Console\Commands;

use App\Models\Match;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\Request;
class DeleteOldMatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'match:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete old matches';

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
        Match::where('updated_at','<',Carbon::now()->subMinutes(3))->delete();
        Request::where('updated_at','<',Carbon::now()->subMinutes(3))->where('status','!=','pending')->delete();
    }
}
