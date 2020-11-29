<?php declare(strict_types = 1);

/**
 * (c) Jonah Böther <mail@jbtcd.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jbtcd\Fitbit\Generator;

use jbtcd\Fitbit\Config\FitbitConfig;
use jbtcd\Fitbit\Config\FitbitUrlConfig;
use jbtcd\Fitbit\Fitbit;

/**
 * Provides a method to generate the url for the authorization page of Fitbit
 *
 * @author Jonah Böther <mail@jbtcd.me>
 */
class UserTokenUrlGenerator
{
    private Fitbit $fitbit;

    public function __construct(
        Fitbit $fitbit
    ) {
        $this->fitbit = $fitbit;
    }

    public function generateUserTokenUrl(): string
    {
        return sprintf(
            FitbitUrlConfig::FITBIT_AUTHORIZE_URL_PATTERN,
            $this->fitbit->getClientId(),
            $this->fitbit->getRedirectUrl(),
            implode(' ', $this->fitbit->getScopes()),
            $this->fitbit->getExpiresIn() ?: FitbitConfig::DAY
        );
    }
}
