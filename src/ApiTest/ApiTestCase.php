<?php

declare(strict_types=1);

namespace Shlinkio\Shlink\TestUtils\ApiTest;

use Closure;
use Fig\Http\Message\RequestMethodInterface;
use Fig\Http\Message\StatusCodeInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Shlinkio\Shlink\TestUtils\Exception\MissingDependencyException;

use function json_decode;
use function sprintf;

use const JSON_THROW_ON_ERROR;

abstract class ApiTestCase extends TestCase implements StatusCodeInterface, RequestMethodInterface
{
    private const REST_PATH_PREFIX = '/rest/v2';

    private static ?ClientInterface $client = null;
    private static ?Closure $seedFixtures = null;

    public static function setApiClient(ClientInterface $client): void
    {
        self::$client = $client;
    }

    /**
     * @param callable(): void $seedFixtures
     */
    public static function setSeedFixturesCallback(callable $seedFixtures): void
    {
        self::$seedFixtures = Closure::fromCallable($seedFixtures);
    }

    public function setUp(): void
    {
        if (self::$seedFixtures !== null) {
            (self::$seedFixtures)();
        }
    }

    protected function callApi(string $method, string $uri, array $options = []): ResponseInterface
    {
        return self::getClient()->request($method, sprintf('%s%s', self::REST_PATH_PREFIX, $uri), $options);
    }

    protected function callApiWithKey(
        string $method,
        string $uri,
        array $options = [],
        string $apiKey = 'valid_api_key'
    ): ResponseInterface {
        $headers = $options[RequestOptions::HEADERS] ?? [];
        $headers['X-Api-Key'] = $apiKey;
        $options[RequestOptions::HEADERS] = $headers;

        return $this->callApi($method, $uri, $options);
    }

    protected function getJsonResponsePayload(ResponseInterface $resp): array
    {
        $body = (string) $resp->getBody();
        return json_decode($body, true, 512, JSON_THROW_ON_ERROR);
    }

    protected function callShortUrl(string $shortCode): ResponseInterface
    {
        return self::getClient()->request(self::METHOD_GET, sprintf('/%s', $shortCode), [
            RequestOptions::ALLOW_REDIRECTS => false,
        ]);
    }

    private static function getClient(): ClientInterface
    {
        if (self::$client === null) {
            throw MissingDependencyException::forApiClient();
        }

        return self::$client;
    }
}
