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
use jbtcd\Fitbit\Generator\AuthorizationStringGenerator;
use Symfony\Component\HttpClient\CurlHttpClient;

/**
 * Revoke an AccessToken
 *
 * @author Jonah Böther <mail@jbtcd.me>
 */
class RevokeAccessTokenRequest
{
    private const FITBIT_REVOKE_URL = 'https://api.fitbit.com/oauth2/revoke';

    private AuthorizationStringGenerator $authorizationStringGenerator;

    public function __construct(
        AuthorizationStringGenerator $authorizationStringGenerator
    ) {
        $this->authorizationStringGenerator = $authorizationStringGenerator;
    }

    public function revokeAccessToken(AccessTokenEntityInterface $accessTokenEntity): void
    {
        $curlHttpClient = new CurlHttpClient([
            'http_version' => '2.0',
        ]);

        $response = $curlHttpClient->request('POST', self::FITBIT_REVOKE_URL, [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => $this->authorizationStringGenerator->getAuthorizationString(),
            ],
            'body' => [
                'token' => $accessTokenEntity->getAccessToken(),
            ],
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new FitbitException();
        }
    }
}
