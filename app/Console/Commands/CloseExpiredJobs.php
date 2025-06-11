<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Job;
use Carbon\Carbon;

class CloseExpiredJobs extends Command
{
    protected $signature = 'jobs:close-expired';
    protected $description = 'Automatically close job posts when their close_date has passed';

    public function handle()
    {
        $expiredJobs = Job::where('status', '!=', 'closed')
                          ->whereDate('close_date', '<', Carbon::today())
                          ->update(['status' => 'closed']);

        $this->info("Expired jobs updated successfully.");
    }
}
