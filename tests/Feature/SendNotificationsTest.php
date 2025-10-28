<?php

namespace Tests\Feature;

use App\Jobs\SendJobNotification;
use App\Models\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SendNotificationsTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_dispatches_a_notification_for_each_job(): void
    {
        Bus::fake();

        [$firstJob, $secondJob] = Job::factory()
            ->count(2)
            ->create();

        $this->artisan('notifications:send')
            ->assertOk();

        Bus::assertDispatched(
            SendJobNotification::class,
            fn (SendJobNotification $job) => $job->job()->is($firstJob),
        );

        Bus::assertDispatched(
            SendJobNotification::class,
            fn (SendJobNotification $job) => $job->job()->is($secondJob),
        );

        Bus::assertDispatchedTimes(SendJobNotification::class, 2);
    }
}
