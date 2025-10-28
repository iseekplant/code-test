<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class StoreJobTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_stores_a_new_job(): void
    {
        $this->post(route('jobs.store'), [
            'contact_name' => 'Someone',
            'contact_phone' => '0400000001',
            'contact_email' => 'test@user.com.au',
            'location' => 'Somewhere',
            'details' => 'Something',
        ])
            ->assertRedirect(route('jobs.index'))
            ->assertStatus(303);

        $this->assertDatabaseHas('jobs', [
            'contact_name' => 'Someone',
            'contact_phone' => '0400000001',
            'contact_email' => 'test@user.com.au',
            'location' => 'Somewhere',
            'details' => 'Something',
        ]);
    }

    #[Test]
    public function it_requires_certain_fields()
    {
        $this->post(route('jobs.store'), [])
            ->assertInvalid([
                'contact_name',
                'contact_phone',
                'contact_email',
                'location',
                'details',
            ]);
    }
}
