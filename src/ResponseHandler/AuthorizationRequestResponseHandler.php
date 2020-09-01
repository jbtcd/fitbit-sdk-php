<?php declare(strict_types=1);

/**
 * (c) Jonah Böther <mail@jbtcd.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jbtcd\Fitbit\ResponseHandler;

use jbtcd\Fitbit\Exception\AuthorizationRequestErrorException;
use jbtcd\Fitbit\Exception\FitbitException;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Class AuthorizationRequestResponseHandler
 *
 * @author Jonah Böther <mail@jbtcd.me>
 */
class AuthorizationRequestResponseHandler
{
    public function handleResponse(ResponseInterface $response): void
    {
        if ($response->getStatusCode() === 200) {
            return;
        }

        $responseContent = json_decode($response->getContent(false), true);

        if (isset($responseContent['errors'][0])) {
            throw new AuthorizationRequestErrorException(sprintf(
                '[%s] %s',
                $responseContent['errors'][0]['errorType'],
                $responseContent['errors'][0]['message']
            ));
        }

        throw new FitbitException();
    }
}
