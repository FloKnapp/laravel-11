<?php

namespace Tests\Unit;

use App\Enum\SymptomTimingType;
use Tests\TestCase;

class SymptomTimingTypeTest extends TestCase
{

    public function test_receiving_correct_values()
    {
        $this->assertSame('pre', SymptomTimingType::PRE->value);
        $this->assertSame('during', SymptomTimingType::DURING->value);
        $this->assertSame('post', SymptomTimingType::POST->value);

    }

}
