<?php declare(strict_types = 1);

/**
 * (c) Jonah Böther <mail@jbtcd.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jbtcd\Fitbit\Request\Activity;

use jbtcd\Fitbit\Entity\AccessTokenEntityInterface;
use jbtcd\Fitbit\Exception\AccessTokenExpiredException;
use jbtcd\Fitbit\Exception\FitbitException;
use jbtcd\Fitbit\Logger\DebugStack;
use Symfony\Component\HttpClient\CachingHttpClient;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpKernel\HttpCache\Store;

/**
 * Fetch activity data of a specific time range
 */
class GetActivityTimeSeriesRequest
{
    public const FITBIT_ACTIVITY_STEPS = 'activities/steps';

    private const FITBIT_GET_ACTIVITY_TIME_SERIES_URL_SCHEMA = 'https://api.fitbit.com/1/user/%s/%s/date/%s/%s.json';

    private AccessTokenEntityInterface $accessTokenEntity;
    private DebugStack $debugStack;

    public function __construct(DebugStack $debugStack)
    {
        $this->debugStack = $debugStack;
    }

    public function setAccessTokenEntity(AccessTokenEntityInterface $accessTokenEntity): void
    {
        $this->accessTokenEntity = $accessTokenEntity;
    }

    public function fetchData(string $resource, \DateTime $startDate, \DateTime $endDate): array
    {
        $url = sprintf(
            self::FITBIT_GET_ACTIVITY_TIME_SERIES_URL_SCHEMA,
            '-',
            $resource,
            $startDate->format('Y-m-d'),
            $endDate->format('Y-m-d'),
        );

        return $this->request($url);
    }

    private function request(string $url): array
    {
        $this->debugStack->startCall($url);

        $store = new Store(__DIR__ . '/../../../cache');

        $curlHttpClient = new CurlHttpClient([
            'http_version' => '2.0',
        ]);

        $curlHttpClient = new CachingHttpClient($curlHttpClient, $store, ['default_ttl' => 60]);

        $response = $curlHttpClient->request('GET', $url, [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => 'Bearer ' . $this->accessTokenEntity->getAccessToken(),
            ],
        ]);

        $this->debugStack->endCall();

        if ($response->getStatusCode() === 401) {
            throw new AccessTokenExpiredException();
        }

        if ($response->getStatusCode() !== 200) {
            throw new FitbitException();
        }

        return $response->toArray();
    }
}
