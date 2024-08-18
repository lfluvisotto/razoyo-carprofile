<?php
declare(strict_types=1);

namespace Razoyo\CarProfile\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\HTTP\ClientInterface;
use Magento\Framework\Serialize\SerializerInterface;
use Razoyo\CarProfile\Api\CarsInterface;
use Razoyo\CarProfile\Api\Data\CarInterface;
use Razoyo\CarProfile\Api\Data\CarInterfaceFactory;
use Razoyo\CarProfile\Model\Data\CarIndexFactory;

class Cars implements CarsInterface
{
    private const XML_PATH_CUSTOMER_RAZOYO_CARPROFILE_SERVER = 'customer/razoyo_carprofile/server';
    private const ENDPOINT_CARS = 'cars';
    private const HEADER_AUTHORIZATION = 'Authorization';
    private const HEADER_BEARER = 'Bearer %s';
    private const HEADER_YOUR_TOKEN = 'your-token';
    private const BODY_CAR = 'car';
    private const BODY_CARS = 'cars';
    private const HTTP_STATUS_OK = 200;

    public function __construct(
        private readonly ScopeConfigInterface $scopeConfig,
        private readonly ClientInterface $client,
        private readonly SerializerInterface $serializer,
        private readonly CarIndexFactory $carIndexFactory,
        private readonly CarInterfaceFactory $carInterfaceFactory
    ) {
    }
    /**
     * @inheritDoc
     */
    public function getCars(): array
    {
        $this->getApiCars();

        $return = [];

        if ($this->client->getStatus() === self::HTTP_STATUS_OK) {
            $cars = $this->unserialize($this->client->getBody(), self::BODY_CARS);

            foreach ($cars as $car) {
                $carIndex = $this->carIndexFactory->create();
                $carIndex->setData($car);

                $return[] = $carIndex;
            }
        }

        return $return;
    }

    public function getCar(string $id): CarInterface
    {
        $car = $this->carInterfaceFactory->create();

        if ($id) {
            $this->getCars();

            $this->getApiCars(true);

            $this->client->get(sprintf('%s/%s/%s', $this->getServer(), self::ENDPOINT_CARS, $id));

            if ($this->client->getStatus() === self::HTTP_STATUS_OK) {
                $carData = $this->unserialize($this->client->getBody(), self::BODY_CAR);

                $car->setData($carData);
            }
        }

        return $car;
    }

    private function getServer(): string
    {
        return $this->scopeConfig->getValue(self::XML_PATH_CUSTOMER_RAZOYO_CARPROFILE_SERVER);
    }

    private function getApiCars(bool $setHeaderYourToken = false): void
    {
        $this->client->get(sprintf('%s/%s', $this->getServer(), self::ENDPOINT_CARS));

        if ($setHeaderYourToken) {
            $this->client->setHeaders([
                self::HEADER_AUTHORIZATION =>
                    sprintf(self::HEADER_BEARER, $this->client->getHeaders()[self::HEADER_YOUR_TOKEN])
            ]);
        }
    }

    private function unserialize(string $response, string $key = ''): array
    {
        if ($key) {
            return $this->serializer->unserialize($response)[$key];
        }

        return $this->serializer->unserialize($response);
    }
}
