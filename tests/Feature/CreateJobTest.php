<?php

namespace Tests\Feature;

use Inertia\Testing\AssertableInertia;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateJobTest extends TestCase
{
    #[Test]
    public function it_renders_the_create_job_page(): void
    {
        $this->get(route('jobs.create'))
            ->assertSuccessful()
            ->assertInertia(fn (AssertableInertia $page) => $page->component('Jobs/Create'));
    }
}
