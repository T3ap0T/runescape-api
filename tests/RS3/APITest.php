<?php

declare(strict_types=1);

namespace Tests\RS3;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use RuneStat\Exceptions\PlayerNotFound;
use RuneStat\HttpClient;
use RuneStat\RS3\API;

class APITest extends TestCase
{
    /** @test */
    public function it_should_fetch_a_players_profile(): void
    {
        $mock = $this->createMock(HttpClient::class);

        $mock
            ->expects($this->once())
            ->method('get')
            ->with('https://apps.runescape.com/runemetrics/profile/profile?user=iWader&activities=20')
            ->willReturn(new Response(200, [], file_get_contents(__DIR__ . '/profile.json')));

        API::setHttpClientResolver(function () use ($mock) {
            return $mock;
        });

        $api = new API();

        $api->getProfile('iWader');
    }

    /** @test */
    public function it_should_throw_a_player_not_found_exception_when_the_status_code_is_404(): void
    {
        $mock = $this->createMock(HttpClient::class);

        $mock
            ->expects($this->once())
            ->method('get')
            ->withAnyParameters()
            ->willThrowException(
                new ClientException(
                    '',
                    new Request(
                        'GET',
                        'https://apps.runescape.com/runemetrics/profile/profile?user=iWader&activities=20'
                    ),
                    new Response(404)
                )
            );

        API::setHttpClientResolver(function () use ($mock) {
            return $mock;
        });

        $this->expectException(PlayerNotFound::class);

        $api = new API();

        $api->getProfile('iWader');
    }
}
