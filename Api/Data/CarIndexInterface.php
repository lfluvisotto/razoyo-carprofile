<?php
declare(strict_types=1);

namespace Razoyo\CarProfile\Api\Data;

interface CarIndexInterface
{
    public const ID = 'id';
    public const YEAR = 'year';
    public const MAKE ='make';
    public const MODEL ='model';

    public function getId(): string;

    public function setId(string $id): CarIndexInterface;

    public function getYear(): int;

    public function setYear(int $year): CarIndexInterface;

    public function getMake(): string;

    public function setMake(string $make): CarIndexInterface;

    public function getModel(): string;

    public function setModel(string $model): CarIndexInterface;
}
