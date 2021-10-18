<?php declare(strict_types = 1);

/**
 * (c) Jonah Böther <mail@jbtcd.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jbtcd\FitbitTest\Generator;

use jbtcd\Fitbit\Configuration\FitbitConfiguration;
use jbtcd\Fitbit\Generator\AuthorizationStringGenerator;
use PHPUnit\Framework\TestCase;

/**
 * @author Jonah Böther <mail@jbtcd.me>
 */
class AuthorizationStringGeneratorTest extends TestCase
{
    /**
     * @dataProvider dataProviderForGenerateUserTokenUrlTest
     */
    public function testGenerateUserTokenUrl(string $expectedAuthorizationString, array $fitbitConfigurationArray): void
    {
        $fitbitConfiguration = $this->getFitbitConfigurationFromArray($fitbitConfigurationArray);
        $authorizationStringGenerator = $this->getAuthorizationStringGenerator($fitbitConfiguration);

        self::assertEquals($expectedAuthorizationString, $authorizationStringGenerator->getAuthorizationString());
    }

    public function dataProviderForGenerateUserTokenUrlTest(): array
    {
        return [
            [
                // @codingStandardsIgnoreLine
                'expectedAuthorizationString' => 'Basic QUJDMTI6U0VDUkVU',
                'fitbitConfigurationArray' => [
                    'clientId' => 'ABC12',
                    'responseType' => '',
                    'clientSecret' => 'SECRET',
                    'scopes' => [],
                ],
            ],
            [
                // @codingStandardsIgnoreLine
                'expectedAuthorizationString' => 'Basic QUJDMTI6T1RIRVJfU0VDUkVU',
                'fitbitConfigurationArray' => [
                    'clientId' => 'ABC12',
                    'responseType' => '',
                    'clientSecret' => 'OTHER_SECRET',
                    'scopes' => [],
                ],
            ],
        ];
    }

    private function getFitbitConfigurationFromArray(array $fitbitConfigurationArray): FitbitConfiguration
    {
        return new FitbitConfiguration(
            $fitbitConfigurationArray['clientId'],
            $fitbitConfigurationArray['responseType'],
            $fitbitConfigurationArray['clientSecret'],
            $fitbitConfigurationArray['scopes']
        );
    }

    private function getAuthorizationStringGenerator(FitbitConfiguration $fitbit): AuthorizationStringGenerator
    {
        return new AuthorizationStringGenerator($fitbit);
    }
}
