<?php declare(strict_types = 1);

/**
 * (c) Jonah Böther <mail@jbtcd.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jbtcd\Fitbit\Service;

use jbtcd\Fitbit\FitbitConfiguration;

/**
 * Fetch an AccessToken
 *
 * @author Jonah Böther <mail@jbtcd.me>
 */
class FitbitAccessTokenService
{
    private FitbitConfiguration $fitbitConfiguration;

    public function __construct(
        FitbitConfiguration $fitbitConfiguration
    ) {
        $this->fitbitConfiguration = $fitbitConfiguration;
    }

    public function fetchAccessToken(string $code): string
    {
        // TODO: Implement logic

        return $code;
    }
}
