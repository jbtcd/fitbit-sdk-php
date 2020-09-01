<?php declare(strict_types=1);

/**
 * (c) Jonah Böther <mail@jbtcd.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jbtcd\Fitbit\Config;

/**
 * Interface FitbitConfig
 *
 * @author Jonah Böther <mail@jbtcd.me>
 */
interface FitbitConfig
{
    public const DAY = 86400;
    public const WEEK = 604800;
    public const MONTH = 2592000;
    public const YEAR = 31536000;
}
