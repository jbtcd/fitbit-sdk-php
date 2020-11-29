<?php declare(strict_types = 1);

/**
 * (c) Jonah Böther <mail@jbtcd.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jbtcd\Fitbit\Client;

use jbtcd\Fitbit\Config\FitbitUrlConfig;
use jbtcd\Fitbit\Entity\AccessTokenEntity;
use jbtcd\Fitbit\FitbitConfiguration;
use jbtcd\Fitbit\ResponseHandler\AuthorizationRequestResponseHandler;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Provides functionality to refresh an access token for the fitbit api
 *
 * @author Jonah Böther <mail@jbtcd.me>
 */
class FitbitRefreshTokenClient
{
    private FitbitConfiguration $fitbit;

    public function __construct(FitbitConfiguration $fitbit)
    {
        $this->fitbit = $fitbit;
    }

    public function fetchAccessTokenByRefreshToken(string $refreshToken): AccessTokenEntity
    {
        $curlHttpClient = new CurlHttpClient([
            'http_version' => '2.0',
        ]);

        $response = $curlHttpClient->request('POST', FitbitUrlConfig::FITBIT_TOKEN_REQUEST_URL, [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => $this->getAuthorizationString(),
            ],
            'body' => [
                'clientId' => $this->fitbit->getClientId(),
                'grant_type' => 'refresh_token',
                'refresh_token' => $refreshToken,
            ],
        ]);

        $this->handleResponse($response);

        return (new AccessTokenEntity())->fromArray(json_decode($response->getContent(), true));
    }

    private function handleResponse(ResponseInterface $response): void
    {
        $responseHandlerChain = new AuthorizationRequestResponseHandler();

        $responseHandlerChain->handleResponse($response);
    }

    private function getAuthorizationString(): string
    {
        return 'Basic ' . base64_encode($this->fitbit->getClientId().':'.$this->fitbit->getClientSecret());
    }
}
