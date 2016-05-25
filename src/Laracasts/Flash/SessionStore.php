<?php namespace Laracasts\Flash;

interface SessionStore {

    /**
     * Flash a message to the session.
     *
     * @param $name
     * @param $data
     */
    public function flash($name, $data);
	
	/**
     * Kills flash notification after displaying on page
     * Must be called from template like this {{ flash()->kill() }}
     * @return $this
     */
    public function kill();
} 