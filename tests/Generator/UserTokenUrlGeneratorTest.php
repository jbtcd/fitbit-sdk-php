<?php declare(strict_types = 1);

/**
 * (c) Jonah Böther <mail@jbtcd.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jbtcd\FitbitTest\Generator;

use jbtcd\Fitbit\FitbitConfiguration;
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
                'expectedUrl' => 'https://www.fitbit.com/oauth2/authorize?client_id=ABC12&response_type=code&scope=',
                'fitbitConfigurationArray' => [
                    'clientId' => 'ABC12',
                    'responseType' => 'code',
                    'clientSecret' => '',
                    'scopes' => [],
                ],
            ],
            [
                // @codingStandardsIgnoreLine
                'expectedUrl' => 'https://www.fitbit.com/oauth2/authorize?client_id=ABC12&response_type=code&scope=activity weight&redirect_uri=https://127.0.0.1:8000/r',
                'fitbitConfigurationArray' => [
                    'clientId' => 'ABC12',
                    'responseType' => 'code',
                    'clientSecret' => '',
                    'scopes' => [
                        'activity',
                        'weight'
                    ],
                    'redirectUrl' => 'https://127.0.0.1:8000/r',
                ],
            ],
            [
                // @codingStandardsIgnoreLine
                'expectedUrl' => 'https://www.fitbit.com/oauth2/authorize?client_id=ABC12&response_type=code&scope=activity weight&redirect_uri=https://127.0.0.1:8000/r&expires_in=86400',
                'fitbitConfigurationArray' => [
                    'clientId' => 'ABC12',
                    'responseType' => 'code',
                    'clientSecret' => '',
                    'scopes' => [
                        'activity',
                        'weight'
                    ],
                    'redirectUrl' => 'https://127.0.0.1:8000/r',
                    'expiresIn' => 86400,
                ],
            ],
        ];
    }

    private function getFitbitConfigurationFromArray(array $fitbitConfigurationArray): FitbitConfiguration
    {
        $fitbitConfiguration = new FitbitConfiguration(
            $fitbitConfigurationArray['clientId'],
            $fitbitConfigurationArray['responseType'],
            $fitbitConfigurationArray['clientSecret'],
            $fitbitConfigurationArray['scopes']
        );

        if (isset($fitbitConfigurationArray['expiresIn'])) {
            $fitbitConfiguration->setExpiresIn($fitbitConfigurationArray['expiresIn']);
        }

        if (isset($fitbitConfigurationArray['redirectUrl'])) {
            $fitbitConfiguration->setRedirectUrl($fitbitConfigurationArray['redirectUrl']);
        }

        return $fitbitConfiguration;
    }

    private function getUserTokenUrlGenerator(FitbitConfiguration $fitbit): UserTokenUrlGenerator
    {
        return new UserTokenUrlGenerator($fitbit);
    }
}
