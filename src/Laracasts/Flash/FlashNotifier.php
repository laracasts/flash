<?php

namespace Laracasts\Flash;

class FlashNotifier
{
    /**
     * The session writer.
     *
     * @var SessionStore
     */
    private $session;

    /**
     * The array of flash messages
     *
     * @var array
     */
    private $flashMessages = [];

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
     * @param  string $message
     * @return $this
     */
    public function info($message)
    {
        $this->message($message, 'info');

        return $this;
    }

    /**
     * Flash a success message.
     *
     * @param  string $message
     * @return $this
     */
    public function success($message)
    {
        $this->message($message, 'success');

        return $this;
    }

    /**
     * Flash an error message.
     *
     * @param  string $message
     * @return $this
     */
    public function error($message)
    {
        $this->message($message, 'danger');

        return $this;
    }

    /**
     * Flash a warning message.
     *
     * @param  string $message
     * @return $this
     */
    public function warning($message)
    {
        $this->message($message, 'warning');

        return $this;
    }

    /**
     * Flash an overlay modal.
     *
     * @param  string $message
     * @param  string $title
     * @param  string $level
     * @return $this
     */
    public function overlay($message, $title = 'Notice', $level = 'info')
    {
        $this->session->flash('flash_notification.overlay', [
            'title' => $title,
            'message' => $message,
            'level' => $level
        ]);

        return $this;
    }

    /**
     * Flash a general message.
     *
     * @param  string $message
     * @param  string $level
     * @return $this
     */
    public function message($message, $level = 'info')
    {
        $this->flashMessages[] = [
            'message' => $message,
            'level' => $level
        ];

        $this->flashMessages();

        return $this;
    }

    /**
     * Add an "important" to the last flash message.
     *
     * @return $this
     */
    public function important()
    {
        $this->flashMessages[count($this->flashMessages) - 1]['important'] = 'true';

        $this->flashMessages();

        return $this;
    }

    private function flashMessages()
    {
        $this->session->flash('flash_notification.message', $this->flashMessages);
    }

}

