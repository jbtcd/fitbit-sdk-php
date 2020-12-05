<?php declare(strict_types = 1);

/**
 * (c) Jonah Böther <mail@jbtcd.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jbtcd\Fitbit\Request\Authentication;

use jbtcd\Fitbit\Entity\AccessTokenEntity;
use jbtcd\Fitbit\Exception\FitbitException;
use Symfony\Component\HttpClient\CurlHttpClient;
use function PHPStan\dumpType;

/**
 * Get current state of AccessToken
 *
 * @author Jonah Böther <mail@jbtcd.me>
 */
class RetrieveStateOfAccessTokenRequest
{
    private const FITBIT_INTROSPECT_URL = 'https://api.fitbit.com/1.1/oauth2/introspect';

    public function fetchCurrentStatusOfToken(AccessTokenEntity $accessTokenEntity): bool
    {
        $curlHttpClient = new CurlHttpClient([
            'http_version' => '2.0',
        ]);

        $response = $curlHttpClient->request('POST', self::FITBIT_INTROSPECT_URL, [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => 'Bearer ' . $accessTokenEntity->getAccessToken(),
            ],
            'body' => [
                'token' => $accessTokenEntity->getAccessToken(),
            ],
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new FitbitException();
        }

        $responseContent = $response->toArray(false);

        return $responseContent['active'];
    }
}