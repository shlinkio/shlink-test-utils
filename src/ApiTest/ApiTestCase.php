<?php

declare(strict_types=1);

namespace Shlinkio\Shlink\TestUtils\ApiTest;

use Fig\Http\Message\RequestMethodInterface;
use Fig\Http\Message\StatusCodeInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use Shlinkio\Shlink\TestUtils\Exception\MissingDependencyException;
use Shlinkio\Shlink\TestUtils\Helper\SeededTestCase;

use function json_decode;
use function sprintf;
use function str_starts_with;

use const JSON_THROW_ON_ERROR;

abstract class ApiTestCase extends SeededTestCase implements StatusCodeInterface, RequestMethodInterface
{
    private const REST_PATH_PREFIX = '/rest/v2';

    private static ?ClientInterface $client = null;

    public static function setApiClient(ClientInterface $client): void
    {
        self::$client = $client;
    }

    final protected function callApi(string $method, string $uri, array $options = []): ResponseInterface
    {
        $uri = str_starts_with($uri, '/rest') ? $uri : sprintf('%s%s', self::REST_PATH_PREFIX, $uri);
        $options = $this->optionsWithHeader($options, 'X-Coverage-Id', static::class);
        return self::getClient()->request($method, $uri, $options);
    }

    final protected function callApiWithKey(
        string $method,
        string $uri,
        array $options = [],
        string $apiKey = 'valid_api_key',
    ): ResponseInterface {
        $options = $this->optionsWithHeader($options, 'X-Api-Key', $apiKey);
        return $this->callApi($method, $uri, $options);
    }

    final protected function getJsonResponsePayload(ResponseInterface $resp): array
    {
        $body = (string) $resp->getBody();
        return json_decode($body, true, 512, JSON_THROW_ON_ERROR);
    }

    final protected function callShortUrl(string $shortCode, ?string $userAgent = null): ResponseInterface
    {
        return self::getClient()->request(self::METHOD_GET, sprintf('/%s', $shortCode), [
            RequestOptions::ALLOW_REDIRECTS => false,
            RequestOptions::HEADERS => [
                'User-Agent' => $userAgent,
            ],
        ]);
    }

    private static function getClient(): ClientInterface
    {
        if (self::$client === null) {
            throw MissingDependencyException::forApiClient();
        }

        return self::$client;
    }

    private function optionsWithHeader(array $options, string $header, string $value): array
    {
        $headers = $options[RequestOptions::HEADERS] ?? [];
        $headers[$header] = $value;
        $options[RequestOptions::HEADERS] = $headers;

        return $options;
    }
}
