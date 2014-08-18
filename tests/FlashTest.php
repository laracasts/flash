<?php

use Laracasts\Flash\FlashNotifier;
use Mockery as m;

class FlashTest extends PHPUnit_Framework_TestCase {

    protected $session;

    protected $flash;

	public function setUp()
	{
        $this->session = m::mock('Laracasts\Flash\SessionStore');
        $this->flash = new FlashNotifier($this->session);
	}

	/** @test */
	public function it_displays_default_flash_notifications()
	{
        $this->session->shouldReceive('flash')->with('flash_notification.message', 'Welcome Aboard');
        $this->session->shouldReceive('flash')->with('flash_notification.title', 'Notice');
        $this->session->shouldReceive('flash')->with('flash_notification.level', 'info');

        $this->flash->message('Welcome Aboard');
	}

    /** @test */
    public function it_displays_info_flash_notifications()
    {
        $this->session->shouldReceive('flash')->with('flash_notification.message', 'Welcome Aboard');
        $this->session->shouldReceive('flash')->with('flash_notification.title', 'Notice');
        $this->session->shouldReceive('flash')->with('flash_notification.level', 'info');

        $this->flash->info('Welcome Aboard');
    }

	/** @test */
	public function it_displays_success_flash_notifications()
	{
        $this->session->shouldReceive('flash')->with('flash_notification.message', 'Welcome Aboard');
        $this->session->shouldReceive('flash')->with('flash_notification.title', 'Notice');
        $this->session->shouldReceive('flash')->with('flash_notification.level', 'success');

		$this->flash->success('Welcome Aboard');
	}

	/** @test */
	public function it_displays_error_flash_notifications()
	{
        $this->session->shouldReceive('flash')->with('flash_notification.message', 'Uh Oh');
        $this->session->shouldReceive('flash')->with('flash_notification.title', 'Notice');
        $this->session->shouldReceive('flash')->with('flash_notification.level', 'danger');

        $this->flash->error('Uh Oh');
	}

    /** @test */
    public function it_displays_warning_flash_notifications()
    {
        $this->session->shouldReceive('flash')->with('flash_notification.message', 'Be careful!');
        $this->session->shouldReceive('flash')->with('flash_notification.title', 'Notice');
        $this->session->shouldReceive('flash')->with('flash_notification.level', 'warning');

        $this->flash->warning('Be careful!');
    }

    /** @test */
    public function it_displays_custom_message_titles()
    {
        $this->session->shouldReceive('flash')->with('flash_notification.message', 'You are now signed up.');
        $this->session->shouldReceive('flash')->with('flash_notification.title', 'Success Heading');
        $this->session->shouldReceive('flash')->with('flash_notification.level', 'success');

        $this->flash->success('You are now signed up.', 'Success Heading');
    }

	/** @test */
	public function it_displays_flash_overlay_notifications()
	{
        $this->session->shouldReceive('flash')->with('flash_notification.message', 'Overlay Message');
        $this->session->shouldReceive('flash')->with('flash_notification.title', 'Notice');
        $this->session->shouldReceive('flash')->with('flash_notification.level', 'info');
        $this->session->shouldReceive('flash')->with('flash_notification.overlay', true);

        $this->flash->overlay('Overlay Message');
	}

}
