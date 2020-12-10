<?php declare(strict_types = 1);

/**
 * (c) Jonah Böther <mail@jbtcd.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jbtcd\Fitbit\Request\Authentication;

use jbtcd\Fitbit\Entity\AccessTokenEntityInterface;
use jbtcd\Fitbit\Logger\DebugStack;
use Symfony\Component\HttpClient\CurlHttpClient;

/**
 * Get current state of AccessToken
 *
 * @author Jonah Böther <mail@jbtcd.me>
 */
class RetrieveStateOfAccessTokenRequest
{
    private DebugStack $debugStack;

    public function __construct(
        DebugStack $debugStack
    ) {
        $this->debugStack = $debugStack;
    }

    private const FITBIT_INTROSPECT_URL = 'https://api.fitbit.com/1.1/oauth2/introspect';

    public function fetchCurrentStatusOfToken(AccessTokenEntityInterface $accessTokenEntity): bool
    {
        $this->debugStack->startCall(self::FITBIT_INTROSPECT_URL);

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

        $this->debugStack->endCall();

        if ($response->getStatusCode() === 200) {
            return true;
        }

        return false;
    }
}
