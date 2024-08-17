<?php
declare(strict_types=1);

namespace Razoyo\CarProfile\Api;

use Razoyo\CarProfile\Api\Data\CarIndexInterface;
use Razoyo\CarProfile\Api\Data\CarInterface;

interface CarsInterface
{
    /**
     * @return CarIndexInterface[]
     */
    public function getCars(): array;

    public function getCar(string $id): CarInterface;
}
