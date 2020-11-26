<?php

namespace Imdhemy\Purchases\Tests\ServerNotifications;

use GuzzleHttp\Exception\GuzzleException;
use Imdhemy\GooglePlay\DeveloperNotifications\DeveloperNotification;
use Imdhemy\GooglePlay\DeveloperNotifications\SubscriptionNotification;
use Imdhemy\Purchases\Contracts\ServerNotificationContract;
use Imdhemy\Purchases\Contracts\SubscriptionContract;
use Imdhemy\Purchases\ServerNotifications\GoogleServerNotification;
use Imdhemy\Purchases\Tests\TestCase;

class GoogleServerNotificationTest extends TestCase
{
    /**
     * @var GoogleServerNotification
     */
    private $googleServerNotification;

    /**
     * @inheritDoc
     */
    public function setUp(): void
    {
        parent::setUp();
        $data = 'eyJ2ZXJzaW9uIjoiMS4wIiwicGFja2FnZU5hbWUiOiJjb20udHdpZ2Fuby5mYXNoaW9uIiwiZXZlbnRUaW1lTWlsbGlzIjoiMTYwNDAwMjg0MjMzMiIsInN1YnNjcmlwdGlvbk5vdGlmaWNhdGlvbiI6eyJ2ZXJzaW9uIjoiMS4wIiwibm90aWZpY2F0aW9uVHlwZSI6MTMsInB1cmNoYXNlVG9rZW4iOiJuYWRpZmJwZWtmZmRjYmNvZGdwa2NrYWMuQU8tSjFPekxnU0ZQSWFESmVKTVF4dnZIYnBMeTlLZ3dYbHVyQjk1UlBINHFZdGYxSmdzV1B3NHV4bmlkYUlmeGJreXVpTDVOZ3ZudVU3TEpvNzIzeHpfVVRhUEZXc0YyZEEiLCJzdWJzY3JpcHRpb25JZCI6Im1vbnRoX3ByZW1pdW0ifX0=';
        $developerNotification = DeveloperNotification::parse($data);
        $subscriptionNotification = $developerNotification->getSubscriptionNotification();
        $packageName = $developerNotification->getPackageName();
        $this->googleServerNotification = new GoogleServerNotification($subscriptionNotification, $packageName);
    }

    /**
     * @test
     */
    public function test_constructor()
    {
        $this->assertInstanceOf(ServerNotificationContract::class, $this->googleServerNotification);
    }

    /**
     * @test
     */
    public function test_get_type()
    {
        $this->assertEquals(
            SubscriptionNotification::SUBSCRIPTION_EXPIRED,
            $this->googleServerNotification->getType()
        );
    }

    /**
     * @test
     * @throws GuzzleException
     */
    public function test_get_subscription()
    {
        $this->assertInstanceOf(
            SubscriptionContract::class,
            $this->googleServerNotification->getSubscription()
        );
    }
}