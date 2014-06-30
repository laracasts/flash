<?php namespace Laracasts\Flash;

class FlashNotifier {

    /**
     * @var SessionStore
     */
    private $session;

    /**
     * @param SessionStore $session
     */
    function __construct(SessionStore $session)
    {
        $this->session = $session;
    }

    /**
     * @param $message
     */
    public function success($message)
    {
        $this->message($message, 'success');
    }

    /**
     * @param $message
     */
    public function error($message)
    {
        $this->message($message, 'danger');
    }

    /**
     * @param $message
     */
    public function overlay($message)
    {
        $this->message($message);
        $this->session->flash('flash_notification.overlay', true);
    }

    /**
     * @param $message
     * @param string $level
     */
    public function message($message, $level = 'info')
    {
        $this->session->flash('flash_notification.message', $message);
        $this->session->flash('flash_notification.level', $level);
    }

}