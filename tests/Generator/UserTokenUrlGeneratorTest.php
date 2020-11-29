<?php declare(strict_types = 1);

/**
 * (c) Jonah Böther <mail@jbtcd.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jbtcd\FitbitTest\Generator;

use jbtcd\Fitbit\Fitbit;
use jbtcd\Fitbit\Generator\UserTokenUrlGenerator;
use PHPUnit\Framework\TestCase;

/**
 * @author Jonah Böther <mail@jbtcd.me>
 */
class UserTokenUrlGeneratorTest extends TestCase
{
    /**
     * @dataProvider dataProviderForGenerateUserTokenUrlTest
     */
    public function testGenerateUserTokenUrl(string $expectedUrl, array $fitbitConfigurationArray): void
    {
        $fitbitConfiguration = $this->getFitbitConfigurationFromArray($fitbitConfigurationArray);
        $userTokenUrlGenerator = $this->getUserTokenUrlGenerator($fitbitConfiguration);

        self::assertEquals($expectedUrl, $userTokenUrlGenerator->generateUserTokenUrl());
    }

    public function dataProviderForGenerateUserTokenUrlTest(): array
    {
        return [
            [
                // @codingStandardsIgnoreLine
                'expectedUrl' => 'https://www.fitbit.com/oauth2/authorize?response_type=code&client_id=ABC12&redirect_uri=https://127.0.0.1:8000/r&scope=&expires_in=60',
                'fitbitConfigurationArray' => [
                    'clientId' => 'ABC12',
                    'clientSecret' => '',
                    'scopes' => [],
                    'expiresIn' => 60,
                    'redirectUrl' => 'https://127.0.0.1:8000/r',
                ],
            ],
            [
                // @codingStandardsIgnoreLine
                'expectedUrl' => 'https://www.fitbit.com/oauth2/authorize?response_type=code&client_id=ABC12&redirect_uri=https://127.0.0.1:8000/r&scope=activity weight&expires_in=120',
                'fitbitConfigurationArray' => [
                    'clientId' => 'ABC12',
                    'clientSecret' => '',
                    'scopes' => [
                        'activity',
                        'weight'
                    ],
                    'expiresIn' => 120,
                    'redirectUrl' => 'https://127.0.0.1:8000/r',
                ],
            ],
        ];
    }

    private function getFitbitConfigurationFromArray(array $fitbitConfigurationArray): Fitbit
    {
        return new Fitbit(
            $fitbitConfigurationArray['clientId'],
            $fitbitConfigurationArray['clientSecret'],
            $fitbitConfigurationArray['scopes'],
            $fitbitConfigurationArray['expiresIn'],
            $fitbitConfigurationArray['redirectUrl'],
        );
    }

    private function getUserTokenUrlGenerator(Fitbit $fitbit): UserTokenUrlGenerator
    {
        return new UserTokenUrlGenerator($fitbit);
    }
}
