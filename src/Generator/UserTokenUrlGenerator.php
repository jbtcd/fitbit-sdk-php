<?php declare(strict_types = 1);

/**
 * (c) Jonah Böther <mail@jbtcd.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jbtcd\Fitbit\Generator;

use jbtcd\Fitbit\Configuration\FitbitConfiguration;

/**
 * Provides a method to generate the url for the authorization page of Fitbit
 *
 * @author Jonah Böther <mail@jbtcd.me>
 */
class UserTokenUrlGenerator
{
    private const FITBIT_AUTHORIZE_URL = 'https://www.fitbit.com/oauth2/authorize?';
    private const PARAMETER_SCHEMA = '%s=%s&';

    private FitbitConfiguration $fitbit;

    private string $userTokenUrl;

    public function __construct(
        FitbitConfiguration $fitbit
    ) {
        $this->fitbit = $fitbit;
    }

    public function generateUserTokenUrl(): string
    {
        $this->userTokenUrl = self::FITBIT_AUTHORIZE_URL;

        $this->addParameterToUrl('client_id', $this->fitbit->getClientId());
        $this->addParameterToUrl('response_type', 'code');
        $this->addParameterToUrl('scope', implode(' ', $this->fitbit->getScopes()));
        $this->addParameterToUrl('redirect_uri', $this->fitbit->getRedirectUrl());
        $this->addParameterToUrl('expires_in', $this->fitbit->getExpiresIn());
        $this->addParameterToUrl('prompt', null);
        $this->addParameterToUrl('state', null);
        $this->addParameterToUrl('code_challenge', null);
        $this->addParameterToUrl('code_challenge_method', null);

        return rtrim($this->userTokenUrl, '&');
    }

    private function addParameterToUrl(string $parameterName, $parameterValue): void
    {
        if ($parameterValue === null) {
            return;
        }

        $this->userTokenUrl .= sprintf(
            self::PARAMETER_SCHEMA,
            $parameterName,
            $parameterValue
        );
    }
}
