<?php namespace Laracasts\Flash;

class FlashNotifier
{

    /**
     * The session writer.
     *
     * @var SessionStore
     */
    private $session;

    /**
     * Create a new flash notifier instance.
     *
     * @param SessionStore $session
     */
    function __construct(SessionStore $session)
    {
        $this->session = $session;
    }

    /**
     * Flash an information message.
     *
     * @param string $message
     */
    public function info($message)
    {
        $this->message($message, 'info');
    }

    /**
     * Flash a success message.
     *
     * @param string $message
     */
    public function success($message)
    {
        $this->message($message, 'success');
    }

    /**
     * Flash an error message.
     *
     * @param string $message
     */
    public function error($message)
    {
        $this->message($message, 'danger');
    }

    /**
     * Flash a warning message.
     *
     * @param string $message
     */
    public function warning($message)
    {
        $this->message($message, 'warning');
    }

    /**
     * Flash an overlay modal.
     *
     * @param string $message
     * @param string $title
     */
    public function overlay($message, $title = 'Notice')
    {
        $this->message($message, 'info', $title);

        $this->session->flash('flash_notification.overlay', true);
        $this->session->flash('flash_notification.title', $title);
    }

    /**
     * Flash a general message.
     *
     * @param string $message
     * @param string $level
     */
    public function message($message, $level = 'info')
    {
        $this->session->flash('flash_notification.message', $message);
        $this->session->flash('flash_notification.level', $level);
    }

}
