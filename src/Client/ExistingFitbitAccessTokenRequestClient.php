<?php declare(strict_types = 1);

namespace jbtcd\Fitbit\Client;

use jbtcd\Fitbit\Entity\AccessTokenEntity;
use jbtcd\Fitbit\Request\Authentication\RefreshAccessTokenRequest;
use jbtcd\Fitbit\Request\Authentication\RetrieveStateOfAccessTokenRequest;

class ExistingFitbitAccessTokenRequestClient
{
    private RetrieveStateOfAccessTokenRequest $retrieveStateOfAccessTokenRequest;
    private RefreshAccessTokenRequest $refreshAccessTokenRequest;

    public function __construct(
        RetrieveStateOfAccessTokenRequest $retrieveStateOfAccessTokenRequest,
        RefreshAccessTokenRequest $refreshAccessTokenRequest
    ) {
        $this->retrieveStateOfAccessTokenRequest = $retrieveStateOfAccessTokenRequest;
        $this->refreshAccessTokenRequest = $refreshAccessTokenRequest;
    }

    public function checkAndRefreshToken(AccessTokenEntity $accessTokenEntity): AccessTokenEntity
    {
        $currentState = $this->retrieveStateOfAccessTokenRequest->fetchCurrentStatusOfToken($accessTokenEntity);

        if ($currentState === true) {
            return $accessTokenEntity;
        }

        return $this->refreshAccessTokenRequest->refreshAccessToken($accessTokenEntity);
    }
}
