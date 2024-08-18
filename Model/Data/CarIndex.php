<?php
declare(strict_types=1);

namespace Razoyo\CarProfile\Model\Data;

use Magento\Framework\DataObject;
use Razoyo\CarProfile\Api\Data\CarIndexInterface;

class CarIndex extends DataObject implements CarIndexInterface
{
    public function getId(): string
    {
        return (string)$this->getData(self::ID);
    }

    public function setId(string $id): CarIndexInterface
    {
        return $this->setData(self::ID, $id);
    }

    public function getYear(): int
    {
        return (int)$this->getData(self::YEAR);
    }

    public function setYear(int $year): CarIndexInterface
    {
        return $this->setData(self::YEAR, $year);
    }

    public function getMake(): string
    {
        return (string)$this->getData(self::MAKE);
    }

    public function setMake(string $make): CarIndexInterface
    {
        return $this->setData(self::MAKE, $make);
    }

    public function getModel(): string
    {
        return (string)$this->getData(self::MODEL);
    }

    public function setModel(string $model): CarIndexInterface
    {
        return $this->setData(self::MODEL, $model);
    }
}
