<?php

if ( ! function_exists('flash')) {

    /**
     * Arrange for a flash message.
     *
     * @return \Laracasts\Flash\FlashNotifier
     */
    function flash()
    {
        return app('flash');
    }

}