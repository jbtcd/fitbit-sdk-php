<?php declare(strict_types = 1);

/**
 * (c) Jonah Böther <mail@jbtcd.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jbtcd\Fitbit\Entity;

/**
 * Fitbit AccessToken object
 *
 * @author Jonah Böther <mail@jbtcd.me>
 */
class AccessTokenEntity implements AccessTokenEntityInterface
{
    private string $accessToken;
    private int $expiresIn;
    private string $refreshToken;
    private string $tokenType;
    private string $userId;

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function setAccessToken(string $accessToken): self
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }

    public function setExpiresIn(int $expiresIn): self
    {
        $this->expiresIn = $expiresIn;

        return $this;
    }

    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }

    public function setRefreshToken(string $refreshToken): self
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    public function getTokenType(): string
    {
        return $this->tokenType;
    }

    public function setTokenType(string $tokenType): self
    {
        $this->tokenType = $tokenType;

        return $this;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function setUserId(string $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function fromArray(array $accessTokenArray): self
    {
        $this->setAccessToken($accessTokenArray['access_token'] ?? '');
        $this->setExpiresIn($accessTokenArray['expires_in']);
        $this->setRefreshToken($accessTokenArray['refresh_token']);
        $this->setTokenType($accessTokenArray['token_type']);
        $this->setUserId($accessTokenArray['user_id']);

        return $this;
    }

}
