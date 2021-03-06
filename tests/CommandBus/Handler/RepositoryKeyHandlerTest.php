<?php declare(strict_types=1);

namespace ApiClients\Tests\Client\Travis\CommandBus\Handler;

use ApiClients\Client\Travis\CommandBus\Command\RepositoryKeyCommand;
use ApiClients\Client\Travis\CommandBus\Handler\RepositoryKeyHandler;
use ApiClients\Client\Travis\Resource\RepositoryKeyInterface;
use ApiClients\Tools\Services\Client\FetchAndHydrateService;
use ApiClients\Tools\TestUtilities\TestCase;
use React\EventLoop\Factory;
use function Clue\React\Block\await;
use function React\Promise\resolve;

final class RepositoryKeyHandlerTest extends TestCase
{
    public function testRepositoryKey()
    {
        $repositoryResource = $this->prophesize(RepositoryKeyInterface::class)->reveal();

        $repository = 'wyrihaximus/tactician-command-handler-mapper';
        $command = new RepositoryKeyCommand($repository);

        $service = $this->prophesize(FetchAndHydrateService::class);
        $service->fetch('repos/wyrihaximus/tactician-command-handler-mapper/key', '', RepositoryKeyInterface::HYDRATE_CLASS)->shouldBeCalled()->willReturn(resolve($repositoryResource));

        $handler = new RepositoryKeyHandler($service->reveal());

        self::assertSame($repositoryResource, await($handler->handle($command), Factory::create()));
    }
}
