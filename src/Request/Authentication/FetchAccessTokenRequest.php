<?php declare(strict_types = 1);

/**
 * (c) Jonah Böther <mail@jbtcd.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jbtcd\Fitbit\Request\Authentication;

use jbtcd\Fitbit\Entity\AccessTokenEntityInterface;
use jbtcd\Fitbit\Exception\FitbitException;
use jbtcd\Fitbit\FitbitConfiguration;
use jbtcd\Fitbit\Generator\AuthorizationStringGenerator;
use Symfony\Component\HttpClient\CurlHttpClient;

/**
 * Fetch new AccessToken with code
 *
 * @author Jonah Böther <mail@jbtcd.me>
 */
class FetchAccessTokenRequest
{
    private const FITBIT_ACCESS_TOKEN_REQUEST_URL = 'https://api.fitbit.com/oauth2/token';

    private AuthorizationStringGenerator $authorizationStringGenerator;
    private FitbitConfiguration $fitbitConfiguration;

    public function __construct(
        AuthorizationStringGenerator $authorizationStringGenerator,
        FitbitConfiguration $fitbitConfiguration
    ) {
        $this->authorizationStringGenerator = $authorizationStringGenerator;
        $this->fitbitConfiguration = $fitbitConfiguration;
    }

    public function fetchAccessToken(string $code): AccessTokenEntityInterface
    {
        $curlHttpClient = new CurlHttpClient([
            'http_version' => '2.0',
        ]);

        $response = $curlHttpClient->request('POST', self::FITBIT_ACCESS_TOKEN_REQUEST_URL, [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => $this->authorizationStringGenerator->getAuthorizationString(),
            ],
            'body' => [
                'clientId' => $this->fitbitConfiguration->getClientId(),
                'grant_type' => 'authorization_code',
                'redirect_uri' => $this->fitbitConfiguration->getRedirectUrl(),
                'code' => $code,
            ],
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new FitbitException();
        }

        $accessTokenEntityClassName = $this->fitbitConfiguration->getAccessTokenEntityClass();
        /** @var AccessTokenEntityInterface $accessTokenEntity */
        $accessTokenEntity = new $accessTokenEntityClassName();

        return $accessTokenEntity->fromArray($response->toArray());
    }
}
