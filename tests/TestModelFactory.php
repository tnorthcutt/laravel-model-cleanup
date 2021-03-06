<?php

namespace Spatie\ModelCleanup\Test;

use Carbon\Carbon;
use Spatie\ModelCleanup\Test\Models\TestModel;

class TestModelFactory
{
    private ?Carbon $startingFrom = null;

    private int $numberOfDays = 0;

    public static function new(): self
    {
        return new static();
    }

    public function startingFrom(Carbon $startingFrom): self
    {
        $this->startingFrom = $startingFrom;

        return $this;
    }

    public function forPreviousDays(int $numberOfDays): self
    {
        $this->numberOfDays = $numberOfDays;

        return $this;
    }

    public function create()
    {
        $createdAt = $this->startingFrom;

        foreach (range(1, $this->numberOfDays) as $i) {
            TestModel::create(['created_at' => $createdAt->subDay()]);
        }
    }
}
