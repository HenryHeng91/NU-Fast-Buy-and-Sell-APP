<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use OneSignal;
class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        OneSignal::sendNotificationToAll("Some Message");
        $this->assertTrue(true);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testOnesignalSendByTag()
    {
        OneSignal::sendNotificationUsingTags("Test send by tag", array(
            ["field" => "tag", "key" => "user_id", "relation" => "=", "value" => "1"],
            ["operator" => "OR"],
            ["field" => "tag", "key" => "user_id", "relation" => "=", "value" => "2"],
        ), $url = null, $data = null, $buttons = null, $schedule = null);
        $this->assertTrue(true);
    }
}
