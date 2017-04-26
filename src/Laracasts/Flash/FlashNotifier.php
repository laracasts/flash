<?php

namespace Laracasts\Flash;

class FlashNotifier
{
    /**
     * The session writer.
     *
     * @var SessionStore
     */
    protected $session;

    /**
     * The message being flashed.
     *
     * @var string
     */
    public $messages = [];

    /**
     * Create a new FlashNotifier instance.
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
    public function success($message = null)
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
    public function error($message = null)
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
    public function warning($message = null)
    {
        $this->message($message, 'warning');

        return $this;
    }

    /**
     * Flash an overlay modal.
     *
     * @param  string|null $message
     * @param  string      $title
     * @param  string      $level
     * @return $this
     */
    public function overlay($message = null, $title = 'Notice', $level = 'info')
    {
        if ($message) {
            $this->message($message, $level);
        }

        $overlay = true;

        $this->updateLastMessage(compact('overlay', 'title', 'level'));

        return $this;
    }

    /**
     * Add an "important" flash to the session.
     *
     * @return $this
     */
    public function important()
    {
        $this->updateLastMessage(['important' => true]);

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
        if (!$message) {
            return $this->updateLastMessage(compact('level'));
        }

        return $this->addMessage(compact('message', 'level'));
    }

    /**
     * Flash a new message to the session.
     *
     * @param  array $message
     * @return $this
     */
    protected function addMessage($message = [])
    {
        $defaults = [
            'title' => '',
            'important' => false,
            'overlay' => false
        ];

        $this->messages[] = array_merge($defaults, $message);

        $this->flash();

        return $this;
    }

    /**
     * Modify the most recently added message.
     *
     * @param  array $overrides
     * @return $this
     */
    protected function updateLastMessage($overrides = [])
    {
        $message = array_merge(array_pop($this->messages), $overrides);

        $this->addMessage($message);

        return $this;
    }

    /**
     * Flash all messages to the session.
     */
    protected function flash()
    {
        $this->session->flash('flash_notification', $this->messages);
    }

    /**
     * Clear all registered messages.
     *
     * @return $this
     */
    public function clear()
    {
        $this->messages = [];

        return $this;
    }
}

