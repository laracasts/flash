# Easy Flash Messages for Your Laravel App

## Installation

First, pull in the package through Composer.

Run `composer require laracasts/flash`

And then, if using Laravel 5, include the service provider within `config/app.php`.

```php
'providers' => [
    Laracasts\Flash\FlashServiceProvider::class,
];
```

## Usage

Within your controllers, before you perform a redirect...

```php
public function store()
{
    flash('Welcome Aboard!');

    return home();
}
```

You may also do:

- `flash('Message', 'info')`
- `flash('Message', 'success')`
- `flash('Message', 'danger')`
- `flash('Message', 'warning')`
- `flash()->overlay('Modal Message', 'Modal Title')`
- `flash('Message')->important()`

Behind the scenes, this will set a few keys in the session:

- 'flash_notification.message' - The message you're flashing
- 'flash_notification.level' - A string that represents the type of notification (good for applying HTML class names)
- 'flash_notification.params' - An optional array of parameters used for localization

With this message flashed to the session, you may now display it in your view(s). Maybe something like:

```html
@if (session()->has('flash_notification.message'))
    <div class="alert alert-{{ session('flash_notification.level') }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        @lang( session('flash_notification.message'), session('flash_notification.params', [] )
    </div>
@endif
```

> Note that this package is optimized for use with Twitter Bootstrap.

Because flash messages and overlays are so common, if you want, you may use (or modify) the views that are included with this package. Simply append to your layout view:

```html
@include('flash::message')
```

## Example

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    @include('flash::message')

    <p>Welcome to my website...</p>
</div>

<!-- This is only necessary if you do Flash::overlay('...') -->
<script src="//code.jquery.com/jquery.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script>
    $('#flash-overlay-modal').modal();
</script>

</body>
</html>
```

If you need to modify the flash message partials, you can run:

```bash
php artisan vendor:publish
```

The two package views will now be located in the `app/views/packages/laracasts/flash/` directory.

```php
flash('Welcome Aboard!');

return home();
```

![https://dl.dropboxusercontent.com/u/774859/GitHub-Repos/flash/message.png](https://dl.dropboxusercontent.com/u/774859/GitHub-Repos/flash/message.png)

```php
flash('Sorry! Please try again.', 'danger');

return home();
```

![https://dl.dropboxusercontent.com/u/774859/GitHub-Repos/flash/error.png](https://dl.dropboxusercontent.com/u/774859/GitHub-Repos/flash/error.png)

```php
flash()->overlay('Notice', 'You are now a Laracasts member!');

return home();
```

![https://dl.dropboxusercontent.com/u/774859/GitHub-Repos/flash/overlay.png](https://dl.dropboxusercontent.com/u/774859/GitHub-Repos/flash/overlay.png)

> [Learn exactly how to build this very package on Laracasts!](https://laracasts.com/lessons/flexible-flash-messages)

##Localization Support
This package supports Laravel's localization system out of the box to flash messages in multiple languages. Translation Strings can be defined using either method described in the [Localization Documentation](https://laravel.com/docs/master/localization#defining-translation-strings).  
If no translation is defined for the passed message string in the current locale, the string itself is returned, as shown above.

To add localization parameters to your message, you can use:

```php
flash('messages.welcome')->parameters(['name' => 'Jeffrey']);
return home();
```
Assuming `/resources/lang/en/messages.php` returns the array element `'welcome' => "Hello, :name"` will produce:

![https://dl.dropboxusercontent.com/s/ib8yiajny6x1sg0/Screen%20Shot%202017-03-22%20at%208.08.18%20PM.png?dl=0](https://dl.dropboxusercontent.com/s/ib8yiajny6x1sg0/Screen%20Shot%202017-03-22%20at%208.08.18%20PM.png?dl=0)

*Note: As of Laravel 5.4, only the "Short Keys" method of translation definition (shown above) supports parameters.*

You can also override the close button text in your modal overlays by defining a `closeButton` short key inside `/resources/lang/vendor/flash/{locale}/flash.php` where `{locale}` is your supported language(s). 

## Hiding Flash Messages

A common desire is to display a flash message for a few seconds, and then hide it. To handle this, write a simple bit of JavaScript. For example, using jQuery, you might add the following snippet just before the closing `</body>` tag.

```
<script>
$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
```

This will find any alerts - excluding the important ones, which should remain until manually closed by the user - wait three seconds, and then fade them out.
