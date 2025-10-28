<?php

namespace Tests\Feature;

use App\Models\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class EditJobTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_renders_the_edit_job_page(): void
    {
        $this->get(route('jobs.edit', Job::factory()->create()))
            ->assertSuccessful()
            ->assertInertia(fn (AssertableInertia $page) => $page->component('Jobs/Edit'));
    }

    #[Test]
    public function it_returns_the_job_details(): void
    {
        $this->get(route('jobs.edit', $job = Job::factory()->create()))
            ->assertSuccessful()
            ->assertInertia(fn (AssertableInertia $page) => $page->where(
                'job',
                [
                    'id' => $job->id,
                    'contact_name' => $job->contact_name,
                    'contact_phone' => $job->contact_phone,
                    'contact_email' => $job->contact_email,
                    'location' => $job->location,
                    'details' => $job->details,
                ],
            ));
    }

    #[Test]
    public function it_requires_a_valid_job(): void
    {
        $this->get(route('jobs.edit', 123))
            ->assertNotFound();
    }
}
