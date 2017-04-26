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
    public function it_displays_default_flash_notifications()
    {
        $this->flash->message('Welcome Aboard');

        $this->assertCount(1, $this->flash->messages);

        $this->assertEquals([
            'title' => '',
            'message' => 'Welcome Aboard',
            'level' => 'info',
            'important' => false,
            'overlay' => false
        ], $this->flash->messages[0]);

        $this->assertSessionIsFlashed();
    }

    /** @test */
    public function it_displays_multiple_flash_notifications()
    {
        $this->flash->message('Welcome Aboard');
        $this->flash->message('Welcome Aboard Again');

        $this->assertCount(2, $this->flash->messages);

        $this->assertSessionIsFlashed();
    }

    /** @test */
    function it_displays_success_flash_notifications()
    {
        $this->flash->message('Welcome Aboard')->success();

        $this->assertEquals([
            'title' => '',
            'message' => 'Welcome Aboard',
            'level' => 'success',
            'important' => false,
            'overlay' => false
        ], $this->flash->messages[0]);

        $this->assertSessionIsFlashed();
    }

    /** @test */
    function it_displays_error_flash_notifications()
    {
        $this->flash->message('Uh Oh')->error();

        $this->assertEquals([
            'title' => '',
            'message' => 'Uh Oh',
            'level' => 'danger',
            'important' => false,
            'overlay' => false
        ], $this->flash->messages[0]);

        $this->assertSessionIsFlashed();
    }

    /** @test */
    function it_displays_warning_flash_notifications()
    {
        $this->flash->message('Warning Warning')->warning();

        $this->assertEquals([
            'title' => '',
            'message' => 'Warning Warning',
            'level' => 'warning',
            'important' => false,
            'overlay' => false
        ], $this->flash->messages[0]);

        $this->assertSessionIsFlashed();
    }

    /** @test */
    function it_displays_important_flash_notifications()
    {
        $this->flash->message('Welcome Aboard')->important();

        $this->assertEquals([
            'title' => '',
            'message' => 'Welcome Aboard',
            'level' => 'info',
            'important' => true,
            'overlay' => false
        ], $this->flash->messages[0]);

        $this->assertSessionIsFlashed();
    }

    /** @test */
    function it_builds_an_overlay_flash_notification()
    {
        $this->flash->message('Warning Warning')->overlay();

        $this->assertEquals([
            'title' => 'Notice',
            'message' => 'Warning Warning',
            'level' => 'info',
            'important' => false,
            'overlay' => true
        ], $this->flash->messages[0]);

        $this->flash->clear();

        $this->flash->overlay('Overlay message.', 'Overlay Title');

        $this->assertEquals([
            'title' => 'Overlay Title',
            'message' => 'Overlay message.',
            'level' => 'info',
            'important' => false,
            'overlay' => true
        ], $this->flash->messages[0]);

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

    protected function assertSessionIsFlashed()
    {
        $this->session
            ->shouldHaveReceived('flash')
            ->with('flash_notification', $this->flash->messages)
            ->once();
    }
}
