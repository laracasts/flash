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
        $this->session->shouldReceive('flash')->with('flash_notification.level', 'info');

        $this->flash->message('Welcome Aboard');
	}

	///** @test */
	public function it_displays_success_flash_notifications()
	{
        $this->session->shouldReceive('flash')->with('flash_notification.message', 'Welcome Aboard');
        $this->session->shouldReceive('flash')->with('flash_notification.level', 'success');

		$this->flash->success('Welcome Aboard');
	}

	/** @test */
	public function it_displays_error_flash_notifications()
	{
        $this->session->shouldReceive('flash')->with('flash_notification.message', 'Uh Oh');
        $this->session->shouldReceive('flash')->with('flash_notification.level', 'danger');

        $this->flash->error('Uh Oh');
	}

	/** @test */
	public function it_displays_flash_overlay_notifications()
	{
        $this->session->shouldReceive('flash')->with('flash_notification.message', 'Overlay Message');
        $this->session->shouldReceive('flash')->with('flash_notification.level', 'info');
        $this->session->shouldReceive('flash')->with('flash_notification.overlay', true);

        $this->flash->overlay('Overlay Message');
	}

}
