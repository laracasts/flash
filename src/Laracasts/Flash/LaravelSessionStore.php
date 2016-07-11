<?php namespace Laracasts\Flash;

use Illuminate\Session\Store;

class LaravelSessionStore implements SessionStore {

    /**
     * @var Store
     */
    private $session;

    /**
     * @param Store $session
     */
    function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Flash a message to the session.
     *
     * @param $name
     * @param $data
     */
    public function flash($name, $data)
    {
        $this->session->flash($name, $data);
    }	
	
    /**
     * Kills flash notification after displaying on page
     * Must be called from template like this {{ flash()->kill() }}
     * @return $this
     */
    public function kill()
    {
        $this->session->set('flash_notification', null);
    }
}