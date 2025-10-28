<?php

namespace App\Console\Commands;

use App\Jobs\SendJobNotification;
use App\Models\Job;
use Illuminate\Console\Command;

class SendNotifications extends Command
{
    protected $signature = 'notifications:send';

    protected $description = 'Send a notification for each job';

    public function handle()
    {
        Job::all()
            ->each(fn (Job $job) => dispatch(new SendJobNotification($job->id)));
    }
}
