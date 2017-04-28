<?php

use Laracasts\Flash\FlashNotifier;
use PHPUnit\Framework\TestCase;

class FlashTest extends TestCase
{
    protected $session;

    protected $flash;

    public function setUp()
    {
        $this->session = Mockery::spy('Laracasts\Flash\SessionStore');

        $this->flash = new FlashNotifier($this->session);
    }

    /** @test */
    function it_can_interact_with_a_message_as_an_array()
    {
        $this->flash->message('Welcome Aboard', 'one', 'two');

        $this->assertEquals('Welcome Aboard', $this->flash->messages[0]['message']);

    }

    /** @test */
    public function it_displays_default_flash_notifications()
    {
        $this->flash->message('Welcome Aboard');

        $this->assertCount(1, $this->flash->messages);

        $message = $this->flash->messages[0];

        $this->assertEquals('', $message->title);
        $this->assertEquals('Welcome Aboard', $message->message);
        $this->assertEquals('info', $message->level);
        $this->assertEquals(false, $message->important);
        $this->assertEquals(false, $message->overlay);

        $this->assertSessionIsFlashed();
    }

    /** @test */
    public function it_displays_multiple_flash_notifications()
    {
        $this->flash->message('Welcome Aboard');
        $this->flash->message('Welcome Aboard Again');

        $this->assertCount(2, $this->flash->messages);

        $this->assertSessionIsFlashed(2);
    }

    /** @test */
    function it_displays_success_flash_notifications()
    {
        $this->flash->message('Welcome Aboard')->success();

        $message = $this->flash->messages[0];

        $this->assertEquals('', $message->title);
        $this->assertEquals('Welcome Aboard', $message->message);
        $this->assertEquals('success', $message->level);
        $this->assertEquals(false, $message->important);
        $this->assertEquals(false, $message->overlay);

        $this->assertSessionIsFlashed();
    }

    /** @test */
    function it_displays_error_flash_notifications()
    {
        $this->flash->message('Uh Oh')->error();

        $message = $this->flash->messages[0];

        $this->assertEquals('', $message->title);
        $this->assertEquals('Uh Oh', $message->message);
        $this->assertEquals('danger', $message->level);
        $this->assertEquals(false, $message->important);
        $this->assertEquals(false, $message->overlay);

        $this->assertSessionIsFlashed();
    }

    /** @test */
    function it_displays_warning_flash_notifications()
    {
        $this->flash->message('Warning Warning')->warning();

        $message = $this->flash->messages[0];

        $this->assertEquals('', $message->title);
        $this->assertEquals('Warning Warning', $message->message);
        $this->assertEquals('warning', $message->level);
        $this->assertEquals(false, $message->important);
        $this->assertEquals(false, $message->overlay);

        $this->assertSessionIsFlashed();
    }

    /** @test */
    function it_displays_important_flash_notifications()
    {
        $this->flash->message('Welcome Aboard')->important();

        $message = $this->flash->messages[0];

        $this->assertEquals('', $message->title);
        $this->assertEquals('Welcome Aboard', $message->message);
        $this->assertEquals('info', $message->level);
        $this->assertEquals(true, $message->important);
        $this->assertEquals(false, $message->overlay);

        $this->assertSessionIsFlashed();
    }

    /** @test */
    function it_builds_an_overlay_flash_notification()
    {
        $this->flash->message('Thank You')->overlay();

        $message = $this->flash->messages[0];

        $this->assertEquals('Notice', $message->title);
        $this->assertEquals('Thank You', $message->message);
        $this->assertEquals('info', $message->level);
        $this->assertEquals(false, $message->important);
        $this->assertEquals(true, $message->overlay);

        $this->flash->clear();

        $this->flash->overlay('Overlay message.', 'Overlay Title');

        $message = $this->flash->messages[0];

        $this->assertEquals('Overlay Title', $message->title);
        $this->assertEquals('Overlay message.', $message->message);
        $this->assertEquals('info', $message->level);
        $this->assertEquals(false, $message->important);
        $this->assertEquals(true, $message->overlay);

        $this->assertSessionIsFlashed();
    }

    /** @test */
    function it_clears_all_messages()
    {
        $this->flash->message('Welcome Aboard');

        $this->assertCount(1, $this->flash->messages);

        $this->flash->clear();

        $this->assertCount(0, $this->flash->messages);
    }

    protected function assertSessionIsFlashed($times = 1)
    {
        $this->session
            ->shouldHaveReceived('flash')
            ->with('flash_notification', $this->flash->messages)
            ->times($times);
    }
}
