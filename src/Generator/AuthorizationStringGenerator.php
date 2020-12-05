<?php declare(strict_types = 1);

/**
 * (c) Jonah Böther <mail@jbtcd.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jbtcd\Fitbit\Generator;

use jbtcd\Fitbit\FitbitConfiguration;

/**
 * Generates a base64 encoded authorization string
 *
 * @author Jonah Böther <mail@jbtcd.me>
 */
class AuthorizationStringGenerator
{
    private FitbitConfiguration $fitbitConfiguration;

    public function __construct(
        FitbitConfiguration $fitbitConfiguration
    ) {
        $this->fitbitConfiguration = $fitbitConfiguration;
    }

    public function getAuthorizationString(): string
    {
        return 'Basic ' . base64_encode(sprintf(
            '%s:%s',
            $this->fitbitConfiguration->getClientId(),
            $this->fitbitConfiguration->getClientSecret()
        ));
    }
}
