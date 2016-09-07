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
        $this->session->shouldReceive('flash')->with('flash_notification.message', [[
            'message' => 'Welcome Aboard',
            'level' => 'info'
        ]]);

        $this->flash->message('Welcome Aboard');
	}

    /** @test */
    public function it_displays_info_flash_notifications()
    {
        $this->session->shouldReceive('flash')->with('flash_notification.message', [[
            'message' => 'Welcome Aboard',
            'level' => 'info'
        ]]);

        $this->flash->info('Welcome Aboard');
    }

	/** @test */
	public function it_displays_success_flash_notifications()
	{
        $this->session->shouldReceive('flash')->with('flash_notification.message', [[
            'message' => 'Welcome Aboard',
            'level' => 'success'
        ]]);

		$this->flash->success('Welcome Aboard');
	}

	/** @test */
	public function it_displays_error_flash_notifications()
	{
        $this->session->shouldReceive('flash')->with('flash_notification.message', [[
            'message' => 'Uh Oh',
            'level' => 'danger'
        ]]);

        $this->flash->error('Uh Oh');
	}

    /** @test */
    public function it_displays_warning_flash_notifications()
    {
        $this->session->shouldReceive('flash')->with('flash_notification.message', [[
            'message' => 'Be careful!',
            'level' => 'warning'
        ]]);

        $this->flash->warning('Be careful!');
    }

    /** @test */
    public function it_displays_custom_message_titles()
    {
        $this->session->shouldReceive('flash')->with('flash_notification.message', [[
            'message' => 'You are now signed up.',
            'level' => 'success',
            //'title' => 'Success Heading'
        ]]);

        $this->flash->success('You are now signed up.', 'Success Heading');
    }

	/** @test */
	public function it_displays_flash_overlay_notifications()
	{
        $this->session->shouldReceive('flash')->with('flash_notification.overlay', [
            'message' => 'Overlay Message',
            'level' => 'info',
            'title' => 'Notice'
        ]);

        $this->flash->overlay('Overlay Message');
	}

    /** @test */
    public function it_displays_flash_overlay_notifications_with_custom_level()
    {
        $this->session->shouldReceive('flash')->with('flash_notification.overlay',[
            'message' => 'Overlay Message',
            'level' => 'danger',
            'title' => 'Custom Title'
        ]);

        $this->flash->overlay('Overlay Message','Custom Title','danger');
    }
}
