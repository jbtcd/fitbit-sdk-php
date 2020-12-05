<?php declare(strict_types = 1);

namespace jbtcd\Fitbit\Client;

use jbtcd\Fitbit\Entity\AccessTokenEntity;
use jbtcd\Fitbit\Request\Authentication\FetchAccessTokenRequest;

class InitialFitbitAccessTokenRequestClient
{
    private FetchAccessTokenRequest $fetchAccessTokenRequest;

    public function __construct(
        FetchAccessTokenRequest $fetchAccessTokenRequest
    ) {
        $this->fetchAccessTokenRequest = $fetchAccessTokenRequest;
    }

    public function fetchAccessTokenByCode(string $code): AccessTokenEntity
    {
        return $this->fetchAccessTokenRequest->fetchAccessToken($code);
    }
}
