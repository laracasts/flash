<?php namespace Laracasts\Flash\Contracts;

use Laracasts\Flash\SessionStore;

/**
 * A contract that outlines the behaviors that must be implemented by any
 * Flash Notifier.
 * @package Laracasts\Flash\Contracts
 * @since 09.05.2015
 * @author Marcus T <marcust261@icloud.com>
 */
interface FlashNotifierContract
{

    /**
     * Create a new flash notifier instance.
     *
     * @param SessionStore $session
     */
    function __construct(SessionStore $session);

    /**
     * Flash an information message.
     *
     * @param string $message
     */
    public function info($message);

    /**
     * Flash a success message.
     *
     * @param  string $message
     * @return $this
     */
    public function success($message);

    /**
     * Flash an error message.
     *
     * @param  string $message
     * @return $this
     */
    public function error($message);

    /**
     * Flash a warning message.
     *
     * @param  string $message
     * @return $this
     */
    public function warning($message);

    /**
     * Flash an overlay modal.
     *
     * @param  string $message
     * @param  string $title
     * @return $this
     */
    public function overlay($message, $title = 'Notice');

    /**
     * Flash a general message.
     *
     * @param  string $message
     * @param  string $level
     * @return $this
     */
    public function message($message, $level = 'info');

    /**
     * Add an "important" flash to the session.
     *
     * @return $this
     */
    public function important();

}