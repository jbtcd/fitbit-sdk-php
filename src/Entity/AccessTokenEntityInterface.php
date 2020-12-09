<?php declare(strict_types = 1);

/**
 * (c) Jonah Böther <mail@jbtcd.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jbtcd\Fitbit\Entity;

/**
 * Fitbit AccessToken object interface
 *
 * @author Jonah Böther <mail@jbtcd.me>
 */
interface AccessTokenEntityInterface
{
    public function setAccessToken(string $accessToken): self;

    public function getAccessToken(): string;

    public function setExpiresIn(int $expiresIn): self;

    public function getExpiresIn(): int;

    public function setRefreshToken(string $refreshToken): self;

    public function getRefreshToken(): string;

    public function setTokenType(string $tokenType): self;

    public function getTokenType(): string;

    public function setUserId(string $userId): self;

    public function getUserId(): string;

    public function fromArray(array $accessTokenArray): self;
}
