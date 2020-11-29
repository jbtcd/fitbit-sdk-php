<?php declare(strict_types = 1);

/**
 * (c) Jonah Böther <mail@jbtcd.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jbtcd\Fitbit\Config;

/**
 * Provides Fitbit url schemas
 *
 * @author Jonah Böther <mail@jbtcd.me>
 */
interface FitbitUrlConfig
{
    public const FITBIT_API_URL = 'https://api.fitbit.com/';
    public const FITBIT_TOKEN_REQUEST_URL = 'https://api.fitbit.com/oauth2/token';
}
