<?php declare(strict_types = 1);

/**
 * (c) Jonah Böther <mail@jbtcd.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jbtcd\Fitbit;

/**
 * Provides the user configuration
 *
 * @author Jonah Böther <mail@jbtcd.me>
 */
class FitbitConfiguration
{
    private string $clientId;
    private string $responseType;
    private string $clientSecret;
    private array $scopes;

    private ?string $redirectUrl = null;
    private ?int $expiresIn = null;
    private ?string $prompt = null;
    private ?string $state = null;
    private ?string $codeChallenge = null;
    private ?string $codeChallengeMethod = null;

    public function __construct(
        string $clientId,
        string $responseType,
        string $clientSecret,
        array $scopes
    ) {
        $this->clientId = $clientId;
        $this->responseType = $responseType;
        $this->clientSecret = $clientSecret;
        $this->scopes = $scopes;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function getResponseType(): string
    {
        return $this->responseType;
    }

    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    public function getScopes(): array
    {
        return $this->scopes;
    }

    public function getExpiresIn(): ?int
    {
        return $this->expiresIn;
    }

    public function setExpiresIn(?int $expiresIn): self
    {
        $this->expiresIn = $expiresIn;

        return $this;
    }

    public function getRedirectUrl(): ?string
    {
        return $this->redirectUrl;
    }

    public function setRedirectUrl(?string $redirectUrl): self
    {
        $this->redirectUrl = $redirectUrl;

        return $this;
    }

    public function getPrompt(): ?string
    {
        return $this->prompt;
    }

    public function setPrompt(?string $prompt): self
    {
        $this->prompt = $prompt;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getCodeChallenge(): ?string
    {
        return $this->codeChallenge;
    }

    public function setCodeChallenge(?string $codeChallenge): self
    {
        $this->codeChallenge = $codeChallenge;

        return $this;
    }

    public function getCodeChallengeMethod(): ?string
    {
        return $this->codeChallengeMethod;
    }

    public function setCodeChallengeMethod(?string $codeChallengeMethod): self
    {
        $this->codeChallengeMethod = $codeChallengeMethod;

        return $this;
    }
}
