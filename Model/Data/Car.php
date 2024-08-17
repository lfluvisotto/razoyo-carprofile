<?php
declare(strict_types=1);

namespace Razoyo\CarProfile\Model\Data;

use Magento\Framework\DataObject;
use Razoyo\CarProfile\Api\Data\CarInterface;

class Car extends DataObject implements CarInterface
{
    public function getId(): string
    {
        return $this->getData(self::ID);
    }

    public function setId(string $id): CarInterface
    {
        return $this->setData(self::ID, $id);
    }

    public function getYear(): int
    {
        return $this->getData(self::YEAR);
    }

    public function setYear(int $year): CarInterface
    {
        return $this->setData(self::YEAR, $year);
    }

    public function getMake(): string
    {
        return $this->getData(self::MAKE);
    }

    public function setMake(string $make): CarInterface
    {
        return $this->setData(self::MAKE, $make);
    }

    public function getModel(): string
    {
        return $this->getData(self::MODEL);
    }

    public function setModel(string $model): CarInterface
    {
        return $this->setData(self::MODEL, $model);
    }

    public function getPrice(): float
    {
        return $this->getData(self::PRICE);
    }

    public function setPrice(float $price): CarInterface
    {
        return $this->setData(self::PRICE, $price);
    }

    public function getSeats(): int
    {
        return $this->getData(self::SEATS);
    }

    public function setSeats(int $seats): CarInterface
    {
        return $this->setData(self::SEATS, $seats);
    }

    public function getMpg(): int
    {
        return $this->getData(self::MPG);
    }

    public function setMpg(int $mpg): CarInterface
    {
        return $this->setData(self::MPG, $mpg);
    }

    public function getImage(): string
    {
        return $this->getData(self::IMAGE);
    }

    public function setImage(string $image): CarInterface
    {
        return $this->setData(self::IMAGE, $image);
    }
}
