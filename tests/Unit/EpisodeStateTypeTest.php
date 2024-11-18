<?php

namespace Tests\Unit;

use App\Enum\EpisodeStateType;
use Tests\TestCase;

class EpisodeStateTypeTest extends TestCase
{

    public function test_receiving_correct_values()
    {
        $this->assertSame('draft', EpisodeStateType::DRAFT->value);
        $this->assertSame('published', EpisodeStateType::PUBLISHED->value);

    }

}
