<?php
declare(strict_types=1);

namespace Orba\RandomCat\Model;

use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\View\Asset\Repository;
use Orba\RandomCat\Api\Data\RandomCatImageInterface;
use Orba\RandomCat\Logger\Logger;

class RandomCatImage implements RandomCatImageInterface
{
    /**
     * @var Curl
     */
    private $curlClient;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var Repository
     */
    private $assertRepe;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * @param Curl $curl
     * @param SerializerInterface $serializer
     * @param Repository $assetRepo
     * @param Logger $logger
     */
    public function __construct(
        Curl $curl,
        SerializerInterface $serializer,
        Repository $assetRepo,
        Logger $logger
    ) {
        $this->curlClient = $curl;
        $this->serializer = $serializer;
        $this->assertRepe = $assetRepo;
        $this->logger = $logger;
    }

    /**
     * Get random image
     *
     * @return string
     */
    public function getRandomCatImage(): string
    {
        return $this->getImageFromApi();
    }

    /**
     * Getting a valid path to a random picture or picture
     * that must be set if the picture from API is not valid or is missing
     *
     * @return string
     */
    public function getImageFromApi(): string
    {
        $this->curlClient->get($this->getApiUrl());
        return $this->getValidImage();
    }

    /**
     * Returns a request to get a random image from the API
     *
     * @return string
     */
    private function getApiUrl(): string
    {
        return self::API_URL . '?' . self::REQUEST_METHOD . '=' . '5up3rc0nf1d3n714llp455w0rdf0rc47s';
    }

    /**
     * Checking the existence of a file on the server.
     * If there is no file for the received url, return the file 404.
     *
     * @return string
     */
    public function getValidImage(): string
    {
        if ($this->curlClient->getStatus() !== 200) {
            $this->logger->error('Image not found');
            return $this->assertRepe->getUrl("Orba_RandomCat::images/404.jpg");
        } else {
            $imageUrl = $this->serializer->unserialize($this->curlClient->getBody())['url'];
            $this->curlClient->get($imageUrl);
            if ($this->curlClient->getStatus() === 200) {
                return (string) $imageUrl;
            } else {
                $this->logger->error('Image is non valid');
                return $this->assertRepe->getUrl("Orba_RandomCat::images/404.jpg");
            }
        }
    }
}
