<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserDisplayNameTest extends TestCase
{
    /** @test */
    public function it_formats_display_name_as_first_middle_initial_last(): void
    {
        $user = new User([
            'first_name' => 'Jane',
            'middle_name' => 'Q',
            'last_name' => 'Doe',
        ]);

        $this->assertEquals('Jane Q. Doe', $user->display_name);
    }

    /** @test */
    public function it_handles_missing_middle_name(): void
    {
        $user = new User([
            'first_name' => 'John',
            'last_name' => 'Smith',
        ]);

        $this->assertEquals('John Smith', $user->display_name);
    }
}
