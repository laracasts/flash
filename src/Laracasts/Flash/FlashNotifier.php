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
     * @param $title
     */
    public function success($message)
    {
        $this->message($message, 'success');
    }

    /**
     * @param $message
     * @param $title
     */
    public function error($message)
    {
        $this->message($message, 'danger');
    }

    /**
     * @param $message
     * @param $title
     */
    public function warning($message)
    {
        $this->message($message, 'warning');
    }

    /**
     * @param $message
     * @param $title
     */
    public function overlay($message, $title = 'Notice')
    {
        $this->message($message, 'info', $title);
        $this->session->flash('flash_notification.overlay', true);
        $this->session->flash('flash_notification.title', $title);
    }

    /**
     * @param $message
     * @param string $level
     */
    public function message($message, $level = 'info', $title = 'Notice')
    {
        $this->session->flash('flash_notification.message', $message);
        $this->session->flash('flash_notification.level', $level);
    }

}