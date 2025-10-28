<?php

namespace Tests\Feature;

use Inertia\Testing\AssertableInertia;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class HomeTest extends TestCase
{
    #[Test]
    public function it_renders_the_home_page(): void
    {
        $this->get(route('home'))
            ->assertSuccessful()
            ->assertInertia(fn (AssertableInertia $page) => $page->component('Home'));
    }
}
