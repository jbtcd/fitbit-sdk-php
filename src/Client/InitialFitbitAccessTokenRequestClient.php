<?php declare(strict_types = 1);

/**
 * (c) Jonah Böther <mail@jbtcd.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jbtcd\Fitbit\Client;

use jbtcd\Fitbit\Entity\AccessTokenEntityInterface;
use jbtcd\Fitbit\Request\Authentication\FetchAccessTokenRequest;

/**
 * Request for the initial AccessToken
 *
 * @author Jonah Böther <mail@jbtcd.me>
 */
class InitialFitbitAccessTokenRequestClient
{
    private FetchAccessTokenRequest $fetchAccessTokenRequest;

    public function __construct(
        FetchAccessTokenRequest $fetchAccessTokenRequest
    ) {
        $this->fetchAccessTokenRequest = $fetchAccessTokenRequest;
    }

    public function fetchAccessTokenByCode(string $code): AccessTokenEntityInterface
    {
        return $this->fetchAccessTokenRequest->fetchAccessToken($code);
    }
}
