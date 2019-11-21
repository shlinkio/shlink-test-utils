<?php

declare(strict_types=1);

namespace Shlinkio\Shlink\TestUtils\ApiTest;

use Fig\Http\Message\RequestMethodInterface;
use Fig\Http\Message\StatusCodeInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Shlinkio\Shlink\TestUtils\Exception\JsonParsingException;

use function json_decode;
use function json_last_error;
use function json_last_error_msg;
use function sprintf;

use const JSON_ERROR_NONE;
use const PHP_EOL;

abstract class ApiTestCase extends TestCase implements StatusCodeInterface, RequestMethodInterface
{
    private const REST_PATH_PREFIX = '/rest/v1';

    /** @var ClientInterface */
    private static $client;
    /** @var callable|null */
    private static $seedFixtures;

    public static function setApiClient(ClientInterface $client): void
    {
        self::$client = $client;
    }

    public static function setSeedFixturesCallback(callable $seedFixtures): void
    {
        self::$seedFixtures = $seedFixtures;
    }

    public function setUp(): void
    {
        if (self::$seedFixtures !== null) {
            (self::$seedFixtures)();
        }
    }

    protected function callApi(string $method, string $uri, array $options = []): ResponseInterface
    {
        return self::$client->request($method, sprintf('%s%s', self::REST_PATH_PREFIX, $uri), $options);
    }

    protected function callApiWithKey(string $method, string $uri, array $options = []): ResponseInterface
    {
        $headers = $options[RequestOptions::HEADERS] ?? [];
        $headers['X-Api-Key'] = 'valid_api_key';
        $options[RequestOptions::HEADERS] = $headers;

        return $this->callApi($method, $uri, $options);
    }

    protected function getJsonResponsePayload(ResponseInterface $resp): array
    {
        $body = (string) $resp->getBody();
        $json = json_decode($body, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new JsonParsingException(sprintf(
                'It was not possible to parse body to json. Error: "%s". Provided body: %s%s',
                json_last_error_msg(),
                PHP_EOL,
                $body
            ));
        }

        return $json;
    }

    protected function callShortUrl(string $shortCode): ResponseInterface
    {
        return self::$client->request(self::METHOD_GET, sprintf('/%s', $shortCode), [
            RequestOptions::ALLOW_REDIRECTS => false,
        ]);
    }
}
