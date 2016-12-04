<?php declare(strict_types=1);

namespace WyriHaximus\Tests\Travis\Resource\Async;

use ApiClients\Tools\ResourceTestUtilities\AbstractResourceTest;
use WyriHaximus\Travis\ApiSettings;
use WyriHaximus\Travis\Resource\Cache;

class CacheTest extends AbstractResourceTest
{
    public function getSyncAsync() : string
    {
        return 'Async';
    }
    public function getClass() : string
    {
        return Cache::class;
    }
    public function getNamespace() : string
    {
        return Apisettings::NAMESPACE;
    }
}
