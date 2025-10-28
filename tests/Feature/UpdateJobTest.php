<?php

namespace Tests\Feature;

use App\Models\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateJobTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_updates_the_details_of_a_job(): void
    {
        $job = Job::factory()->create();

        $this->put(route('jobs.update', $job), [
            'contact_name' => 'New Contact Name',
            'contact_phone' => '0400000001',
            'contact_email' => 'test@user.com.au',
            'location' => 'New Location',
            'details' => 'New Details',
        ])
            ->assertRedirect(route('jobs.index'))
            ->assertStatus(303);

        $this->assertDatabaseCount('jobs',1);

        $this->assertDatabaseHas('jobs',[
            'id' => $job->id,
            'contact_name' => 'New Contact Name',
            'contact_phone' => '0400000001',
            'contact_email' => 'test@user.com.au',
            'location' => 'New Location',
            'details' => 'New Details',
        ]);
    }

    #[Test]
    public function it_requires_certain_fields()
    {
        $this->put(route('jobs.update', Job::factory()->create()), [])
            ->assertInvalid([
                'contact_name',
                'contact_phone',
                'contact_email',
                'location',
                'details',
            ]);
    }

    #[Test]
    public function it_requires_a_valid_job()
    {
        $this->put(route('jobs.update', 123), [
            'contact_name' => 'New Contact Name',
            'contact_phone' => '0400000001',
            'contact_email' => 'test@user.com.au',
            'location' => 'New Location',
            'details' => 'New Details',
        ])
            ->assertNotFound();
    }
}
