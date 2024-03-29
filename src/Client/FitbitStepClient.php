<?php declare(strict_types = 1);

namespace jbtcd\Fitbit\Client;

use DateTime;
use jbtcd\Fitbit\Configuration\FitbitConstants;
use jbtcd\Fitbit\Entity\AccessTokenEntityInterface;
use jbtcd\Fitbit\Request\Activity\GetActivityTimeSeriesRequest;
use jbtcd\Fitbit\Request\Authentication\RefreshAccessTokenRequest;
use jbtcd\Fitbit\Request\Authentication\RetrieveStateOfAccessTokenRequest;

class FitbitStepClient
{
    private RefreshAccessTokenRequest $refreshAccessTokenRequest;
    private RetrieveStateOfAccessTokenRequest $retrieveStateOfAccessTokenRequest;
    private GetActivityTimeSeriesRequest $getActivityTimeSeriesRequest;

    private AccessTokenEntityInterface $accessTokenEntity;

    public function __construct(
        RefreshAccessTokenRequest $refreshAccessTokenRequest,
        RetrieveStateOfAccessTokenRequest $retrieveStateOfAccessTokenRequest,
        GetActivityTimeSeriesRequest $getActivityTimeSeriesRequest
    ) {
        $this->refreshAccessTokenRequest = $refreshAccessTokenRequest;
        $this->retrieveStateOfAccessTokenRequest = $retrieveStateOfAccessTokenRequest;
        $this->getActivityTimeSeriesRequest = $getActivityTimeSeriesRequest;
    }

    public function fetchStepsByDate(DateTime $startDateTime, ?DateTime $endDateTime): array
    {
        if ($this->retrieveStateOfAccessTokenRequest->fetchCurrentStatusOfToken($this->accessTokenEntity) === false) {
            $this->accessTokenEntity = $this->refreshAccessTokenRequest->refreshAccessToken($this->accessTokenEntity);
        }

        if ($endDateTime === null) {
            $endDateTime = new DateTime('today');
        }

        $this->getActivityTimeSeriesRequest->setAccessTokenEntity($this->accessTokenEntity);

        return $this->getActivityTimeSeriesRequest->fetchData(
            GetActivityTimeSeriesRequest::FITBIT_ACTIVITY_STEPS,
            $startDateTime,
            $endDateTime
        );
    }

    public function fetchStepCountByTimeSeries(DateTime $startTime, ?DateTime $endDate = null): int
    {
        if ($this->retrieveStateOfAccessTokenRequest->fetchCurrentStatusOfToken($this->accessTokenEntity) === false) {
            $this->accessTokenEntity = $this->refreshAccessTokenRequest->refreshAccessToken($this->accessTokenEntity);
        }

        if ($endDate === null) {
            $endDate = new DateTime('today');
        }

        $this->getActivityTimeSeriesRequest->setAccessTokenEntity($this->accessTokenEntity);

        $data = $this->getActivityTimeSeriesRequest->fetchData(
            GetActivityTimeSeriesRequest::FITBIT_ACTIVITY_STEPS,
            $startTime,
            $endDate
        );

        return $this->count($data);
    }

    public function fetchAverage(DateTime $startDateTime, ?DateTime $endDateTime): float
    {
        if ($this->retrieveStateOfAccessTokenRequest->fetchCurrentStatusOfToken($this->accessTokenEntity) === false) {
            $this->accessTokenEntity = $this->refreshAccessTokenRequest->refreshAccessToken($this->accessTokenEntity);
        }

        if ($endDateTime === null) {
            $endDateTime = new DateTime('today');
        }

        $this->getActivityTimeSeriesRequest->setAccessTokenEntity($this->accessTokenEntity);

        $data = $this->getActivityTimeSeriesRequest->fetchData(
            GetActivityTimeSeriesRequest::FITBIT_ACTIVITY_STEPS,
            $startDateTime,
            $endDateTime
        );

        return $this->average($data);
    }

    public function setAccessTokenEntity(AccessTokenEntityInterface $accessTokenEntity): void
    {
        $this->accessTokenEntity = $accessTokenEntity;
    }

    private function count(array $dataSeries): int
    {
        $count = 0;

        foreach ($dataSeries[FitbitConstants::ACTIVITIES_STEPS] as $data) {
            $count += $data['value'];
        }

        return $count;
    }

    private function average(array $dataSeries): float
    {
        $count = 0;

        $dataSets = count($dataSeries[FitbitConstants::ACTIVITIES_STEPS]);

        foreach ($dataSeries[FitbitConstants::ACTIVITIES_STEPS] as $data) {
            $count += $data['value'];
        }

        return $count / $dataSets;
    }
}
