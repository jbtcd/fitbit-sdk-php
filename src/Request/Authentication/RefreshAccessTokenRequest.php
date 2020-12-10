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
use jbtcd\Fitbit\Logger\DebugStack;
use Symfony\Component\HttpClient\CurlHttpClient;

/**
 * Refresh an existing AccessToken
 *
 * @author Jonah Böther <mail@jbtcd.me>
 */
class RefreshAccessTokenRequest
{
    private const FITBIT_ACCESS_TOKEN_REQUEST_URL = 'https://api.fitbit.com/oauth2/token';

    private AuthorizationStringGenerator $authorizationStringGenerator;
    private FitbitConfiguration $fitbitConfiguration;
    private DebugStack $debugStack;

    public function __construct(
        AuthorizationStringGenerator $authorizationStringGenerator,
        FitbitConfiguration $fitbitConfiguration,
        DebugStack $debugStack
    ) {
        $this->authorizationStringGenerator = $authorizationStringGenerator;
        $this->fitbitConfiguration = $fitbitConfiguration;
        $this->debugStack = $debugStack;
    }

    public function refreshAccessToken(AccessTokenEntityInterface $accessTokenEntity): AccessTokenEntityInterface
    {
        $this->debugStack->startCall(self::FITBIT_ACCESS_TOKEN_REQUEST_URL);

        $curlHttpClient = new CurlHttpClient([
            'http_version' => '2.0',
        ]);

        $response = $curlHttpClient->request('POST', self::FITBIT_ACCESS_TOKEN_REQUEST_URL, [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => $this->authorizationStringGenerator->getAuthorizationString(),
            ],
            'body' => [
                'expires_in' => $this->fitbitConfiguration->getExpiresIn(),
                'grant_type' => 'refresh_token',
                'refresh_token' => $accessTokenEntity->getRefreshToken(),
            ],
        ]);

        $this->debugStack->endCall();

        if ($response->getStatusCode() !== 200) {
            throw new FitbitException();
        }

        return $accessTokenEntity->fromArray($response->toArray());
    }
}
