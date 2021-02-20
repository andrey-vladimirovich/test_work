<?php
declare(strict_types=1);

namespace Orba\RandomCat\Api\Data;

interface RandomCatImageInterface
{
    const API_URL = 'http://randomcatapi.orbalab.com/';

    const REQUEST_METHOD = 'api_key';

    public function getRandomCatImage(): string;
}
