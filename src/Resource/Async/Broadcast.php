<?php declare(strict_types=1);

namespace ApiClients\Client\Travis\Resource\Async;

use ApiClients\Client\Travis\CommandBus\Command\BroadcastsCommand;
use ApiClients\Client\Travis\Resource\Broadcast as BaseBroadcast;
use ApiClients\Client\Travis\Resource\BroadcastInterface;
use React\Promise\PromiseInterface;
use Rx\React\Promise;
use function ApiClients\Tools\Rx\unwrapObservableFromPromise;

class Broadcast extends BaseBroadcast
{
    public function refresh(): PromiseInterface
    {
        return Promise::fromObservable(unwrapObservableFromPromise($this->handleCommand(
            new BroadcastsCommand()
        ))->filter(function (BroadcastInterface $broadcast) {
            return $this->id() === $broadcast->id();
        }));
    }
}
