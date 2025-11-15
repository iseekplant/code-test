<?php

namespace Tests\Feature;

use App\Models\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class JobsIndexTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_renders_the_jobs_index_page(): void
    {
        $this->get(route('jobs.index'))
            ->assertSuccessful()
            ->assertInertia(fn(AssertableInertia $page) => $page->component('Jobs/Index'));
    }

    #[Test]
    public function it_returns_all_of_the_jobs(): void
    {
        $buildAShed = Job::factory([
            'contact_name' => 'Reilly',
            'contact_phone' => '0400000002',
            'contact_email' => 'reilly@biz.com.au',
            'location' => 'Cairns',
            'details' => 'I want to build a shed.',
            'created_at' => now()->subHour(),
        ])->create();

        $digAHole = Job::factory([
            'contact_name' => 'Rod',
            'contact_phone' => '0400000001',
            'contact_email' => 'rod@biz.com.au',
            'location' => 'Brisbane',
            'details' => 'I want to dig a hole.',
        ])->create();

        $this->get(route('jobs.index'))
            ->assertSuccessful()
            ->assertInertia(fn(AssertableInertia $page) => $page->count('jobs', 2)
                ->where('jobs.0', [
                    'id' => $digAHole->id,
                    'contact_name' => 'Rod',
                    'contact_phone' => '0400000001',
                    'contact_email' => 'rod@biz.com.au',
                    'location' => 'Brisbane',
                    'details' => 'I want to dig a hole.',
                ])
                ->where('jobs.1', [
                    'id' => $buildAShed->id,
                    'contact_name' => 'Reilly',
                    'contact_phone' => '0400000002',
                    'contact_email' => 'reilly@biz.com.au',
                    'location' => 'Cairns',
                    'details' => 'I want to build a shed.',
                ]));
    }
    #[Test]
    public function it_can_filter_jobs_by_contact_email(): void
    {
        // Job that SHOULD match
        $matchingJob = Job::factory()->create([
            'contact_name'  => 'Rod',
            'contact_phone' => '0400000001',
            'contact_email' => 'rod@biz.com.au',
            'location'      => 'Brisbane',
            'details'       => 'I want to dig a hole.',
        ]);

        // Job that SHOULD NOT match
        $otherJob = Job::factory()->create([
            'contact_name'  => 'Reilly',
            'contact_phone' => '0400000002',
            'contact_email' => 'reilly@biz.com.au',
            'location'      => 'Cairns',
            'details'       => 'I want to build a shed.',
        ]);

        $this->get(route('jobs.index', ['email' => 'rod@biz.com.au']))
            ->assertSuccessful()
            ->assertInertia(
                fn(AssertableInertia $page) => $page
                    ->component('Jobs/Index')
                    ->where('email', 'rod@biz.com.au')
                    ->count('jobs', 1)
                    ->where('jobs.0.id', $matchingJob->id)
            );
    }
}
