<?php declare(strict_types = 1);

/**
 * (c) Jonah Böther <mail@jbtcd.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jbtcd\Fitbit\Client;

use jbtcd\Fitbit\Entity\AccessTokenEntityInterface;
use jbtcd\Fitbit\Request\Authentication\RevokeAccessTokenRequest;

/**
 * Revoke access for an AccessToken
 *
 * @author Jonah Böther <mail@jbtcd.me>
 */
class RevokeAccessTokenClient
{
    private RevokeAccessTokenRequest $revokeAccessTokenRequest;

    public function __construct(
        RevokeAccessTokenRequest $revokeAccessTokenRequest
    ) {
        $this->revokeAccessTokenRequest = $revokeAccessTokenRequest;
    }

    public function revokeAccessToken(AccessTokenEntityInterface $accessTokenEntity): void
    {
        $this->revokeAccessTokenRequest->revokeAccessToken($accessTokenEntity);
    }
}
