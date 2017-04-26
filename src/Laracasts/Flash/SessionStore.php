<?php

namespace Laracasts\Flash;

interface SessionStore
{
    /**
     * Flash a message to the session.
     *
     * @param string $name
     * @param mixed  $data
     */
    public function flash($name, $data);
}