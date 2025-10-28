<?php

namespace App\Jobs;

use App\Models\Job;

class SendJobNotification
{
    public function __construct(private $jobId)
    {
    }

    public function handle(): void
    {
        info(sprintf('Notification for job %s', $this->jobId));
    }

    public function job()
    {
        return Job::find($this->jobId);
    }
}
