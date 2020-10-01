<?php

namespace Laracasts\Flash;

use Illuminate\Support\Traits\Macroable;

class FlashNotifier
{
    use Macroable;

    /**
     * The session store.
     *
     * @var SessionStore
     */
    protected $session;

    /**
     * The messages collection.
     *
     * @var \Illuminate\Support\Collection
     */
    public $messages;

    /**
     * Create a new FlashNotifier instance.
     *
     * @param SessionStore $session
     */
    function __construct(SessionStore $session)
    {
        $this->session = $session;
        $this->messages = collect();
    }

    /**
     * Flash a success style message.
     *
     * @param  string|null $message
     * @return $this
     */
    public function success($message = null)
    {
        return $this->message($message, 'success');
    }

    /**
     * Flash a warning style message.
     *
     * @param  string|null $message
     * @return $this
     */
    public function warning($message = null)
    {
        return $this->message($message, 'warning');
    }

    /**
     * Flash a error style message.
     *
     * @param  string|null $message
     * @return $this
     */
    public function error($message = null)
    {
        return $this->message($message, 'danger');
    }

    /**
     * Flash a danger style message.
     *
     * @param  string|null $message
     * @return $this
     */
    public function danger($message = null)
    {
        return $this->message($message, 'danger');
    }

    /**
     * Flash a information style message.
     *
     * @param  string|null $message
     * @return $this
     */
    public function info($message = null)
    {
        return $this->message($message, 'info');
    }

    /**
     * Flash a primary style message.
     *
     * @param  string|null $message
     * @return $this
     */
    public function primary($message = null)
    {
        return $this->message($message, 'primary');
    }

    /**
     * Flash a secondary style message.
     *
     * @param  string|null $message
     * @return $this
     */
    public function secondary($message = null)
    {
        return $this->message($message, 'secondary');
    }

    /**
     * Flash an light style message.
     *
     * @param  string|null $message
     * @return $this
     */
    public function light($message = null)
    {
        return $this->message($message, 'light');
    }

    /**
     * Flash a dark style message.
     *
     * @param  string|null $message
     * @return $this
     */
    public function dark($message = null)
    {
        return $this->message($message, 'dark');
    }

    /**
     * Flash a general message.
     *
     * @param  string|null $message
     * @param  string|null $level
     * @return $this
     */
    public function message($message = null, $level = null)
    {
        // If no message was provided, we should update
        // the most recently added message.
        if (! $message) {
            return $this->updateLastMessage(compact('level'));
        }

        if (! $message instanceof Message) {
            $message = new Message(compact('message', 'level'));
        }

        $this->messages->push($message);

        return $this->flash();
    }

    /**
     * Modify the most recently added message.
     *
     * @param  array $overrides
     * @return $this
     */
    protected function updateLastMessage($overrides = [])
    {
        $this->messages->last()->update($overrides);

        return $this;
    }

    /**
     * Flash an overlay modal.
     *
     * @param  string|null $message
     * @param  string      $title
     * @return $this
     */
    public function overlay($message = null, $title = 'Notice')
    {
        if (! $message) {
            return $this->updateLastMessage(['title' => $title, 'overlay' => true]);
        }

        return $this->message(
            new OverlayMessage(compact('title', 'message'))
        );
    }

    /**
     * Add an "important" flash to the session.
     *
     * @return $this
     */
    public function important()
    {
        return $this->updateLastMessage(['important' => true]);
    }

    /**
     * Add an "dismissible" flash to the session.
     *
     * @return $this
     */
    public function dismissible()
    {
        return $this->updateLastMessage(['dismissible' => true]);
    }

    /**
     * Add an "fixed" flash to the session.
     *
     * @return $this
     */
    public function fixed()
    {
        return $this->updateLastMessage(['fixed' => true]);
    }

    /**
     * Clear all registered messages.
     *
     * @return $this
     */
    public function clear()
    {
        $this->messages = collect();

        return $this;
    }

    /**
     * Flash all messages to the session.
     */
    protected function flash()
    {
        $this->session->flash('flash_notification', $this->messages);

        return $this;
    }
}

