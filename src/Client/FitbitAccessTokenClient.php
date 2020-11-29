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
use jbtcd\Fitbit\Fitbit;
use jbtcd\Fitbit\ResponseHandler\AuthorizationRequestResponseHandler;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Provides functionality to get an access token for the fitbit api by an user code
 *
 * @author Jonah Böther <mail@jbtcd.me>
 */
class FitbitAccessTokenClient
{
    private Fitbit $fitbit;

    public function __construct(Fitbit $fitbit)
    {
        $this->fitbit = $fitbit;
    }

    public function fetchAccessTokenByCode(string $code): AccessTokenEntity
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
                'grant_type' => 'authorization_code',
                'redirect_uri' => $this->fitbit->getRedirectUrl(),
                'code' => $code,
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
