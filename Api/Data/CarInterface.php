<?php
declare(strict_types=1);

namespace Razoyo\CarProfile\Api\Data;

interface CarInterface
{
    public const ID = 'id';
    public const YEAR = 'year';
    public const MAKE ='make';
    public const MODEL ='model';
    public const PRICE = 'price';
    public const SEATS ='seats';
    public const MPG ='mpg';
    public const IMAGE ='image';

    public function getId(): string;

    public function setId(string $id): CarInterface;

    public function getYear(): int;

    public function setYear(int $year): CarInterface;

    public function getMake(): string;

    public function setMake(string $make): CarInterface;

    public function getModel(): string;

    public function setModel(string $model): CarInterface;

    public function getPrice(): float;

    public function setPrice(float $price): CarInterface;

    public function getSeats(): int;

    public function setSeats(int $seats): CarInterface;

    public function getMpg(): int;

    public function setMpg(int $mpg): CarInterface;

    public function getImage(): string;

    public function setImage(string $image): CarInterface;
}
