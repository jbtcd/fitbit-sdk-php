<?php declare(strict_types=1);

/**
 * (c) Jonah Böther <mail@jbtcd.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jbtcd\Fitbit;

/**
 * Class Fitbit
 *
 * @author Jonah Böther <mail@jbtcd.me>
 */
class Fitbit
{
    /** @var string */
    private $clientId;
    /** @var string */
    private $clientSecret;
    /** @var array */
    private $scopes;
    /** @var int */
    private $expiresIn;
    /** @var string */
    private $redirectUrl;

    public function __construct(
        string $clientId,
        string $clientSecret,
        array $scopes,
        int $expiresIn,
        string $redirectUrl
    ) {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->scopes = $scopes;
        $this->expiresIn = $expiresIn;
        $this->redirectUrl = $redirectUrl;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    public function getScopes(): array
    {
        return $this->scopes;
    }

    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }

    public function getRedirectUrl(): string
    {
        return $this->redirectUrl;
    }
}
