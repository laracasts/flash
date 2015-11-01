<?php namespace Laracasts\Flash;

use Illuminate\Session\Store;

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
<<<<<<< HEAD
        $messages = \Session::get('flash_notification.message', []);

        if(is_string($messages)) $messages = [$messages];
        
        $messages[] = $message;
=======
        $messages = $this->push($message);
>>>>>>> 3965290a35abf5153098dcf6639c6cac82058303

        $this->message($messages, 'info');

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
<<<<<<< HEAD
        $messages = \Session::get('flash_notification.message', []);

        if(is_string($messages)) $messages = [$messages];
        
        $messages[] = $message;
=======
        $messages = $this->push($message);
>>>>>>> 3965290a35abf5153098dcf6639c6cac82058303

        $this->message($messages, 'success');

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
<<<<<<< HEAD
        $messages = \Session::get('flash_notification.message', []);

        if(is_string($messages)) $messages = [$messages];
        
        $messages[] = $message;
=======
        $messages = $this->push($message);
>>>>>>> 3965290a35abf5153098dcf6639c6cac82058303

        $this->message($messages, 'danger');

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

        //http://stackoverflow.com/questions/19777837/is-it-possible-to-store-an-array-as-flash-data-in-laravel
<<<<<<< HEAD
        $messages = \Session::get('flash_notification.message', []);

        if(is_string($messages)) $messages = [$messages];
        
        $messages[] = $message;
=======
        $messages = $this->push($message);
>>>>>>> 3965290a35abf5153098dcf6639c6cac82058303

        $this->message($messages, 'warning');

        return $this;
    }

    /**
     * Flash an overlay modal.
     *
     * @param  string $message
     * @param  string $title
     * @return $this
     */
    public function overlay($message, $title = 'Notice')
    {
        $this->message($message, 'info', $title);

        $this->session->flash('flash_notification.overlay', true);
        $this->session->flash('flash_notification.title', $title);

        return $this;
    }

    /**
     * Flash general message(s).
     *
     * @param  array $messages
     * @param  string $level
     * @return $this
     */
    public function message($messages, $level = 'info')
    {

        $levels = \Session::get('flash_notification.level', []);
<<<<<<< HEAD
=======

        if(is_string($levels)) $levels = [$levels];


>>>>>>> 3965290a35abf5153098dcf6639c6cac82058303
        $levels[] = $level;

        $this->session->flash('flash_notification.message', $messages);
        $this->session->flash('flash_notification.level', $levels);

        return $this;
    }

    /**
     * Add an "important" flash to the session.
     *
     * @return $this
     */
    public function important()
    {
        $this->session->flash('flash_notification.important', true);

        return $this;
    }

    public function push($message){

      //http://stackoverflow.com/questions/19777837/is-it-possible-to-store-an-array-as-flash-data-in-laravel
      $messages = \Session::get('flash_notification.message');
      //$this->session->flash('flash_notification.message');
      //dd(\Session::all());

      if(is_string($messages)) $messages = [$messages];

      $messages[] = $message;

      //dd($messages);

      $messages = array_values(array_unique($messages));

      return $messages;
    }

}
