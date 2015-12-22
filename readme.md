# Easy Flash Messages

## Installation

First, pull in the package through Composer.

Run `composer require laracasts/flash`

And then, if using Laravel 5, include the service provider within `config/app.php`.

```php
'providers' => [
    'Laracasts\Flash\FlashServiceProvider'
];
```

And, for convenience, add a facade alias to this same file at the bottom:

```php
'aliases' => [
    'Flash' => 'Laracasts\Flash\Flash'
];
```

## Usage

Within your controllers, before you perform a redirect...

```php
public function store()
{
    Flash::message('Welcome Aboard!');

    return Redirect::home();
}
```

You may also do:

- `Flash::info('Message')`
- `Flash::success('Message')`
- `Flash::error('Message')`
- `Flash::warning('Message')`
- `Flash::overlay('Modal Message', 'Modal Title')`

Again, if using Laravel, this will set a few keys in the session:

- 'flash_notification.message' - The message you're flashing
- 'flash_notification.level' - A string that represents the type of notification (good for applying HTML class names)

Alternatively, again, if you're using Laravel, you may reference the `flash()` helper function, instead of the facade. Here's an example:

```php
/**
 * Destroy the user's session (logout).
 *
 * @return Response
 */
public function destroy()
{
    Auth::logout();

    flash()->success('You have been logged out.');

    return home();
}
```

Or, for a general information flash, just do: `flash('Some message');`.

With this message flashed to the session, you may now display it in your view(s). Maybe something like:

```html
@if (Session::has('flash_notification.message'))
    <div class="alert alert-{{ Session::get('flash_notification.level') }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        {{ Session::get('flash_notification.message') }}
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

<script src="//code.jquery.com/jquery.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<!-- This is only necessary if you do Flash::overlay('...') -->
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
Flash::message('Welcome aboard!');

return Redirect::home();
```

![https://dl.dropboxusercontent.com/u/774859/GitHub-Repos/flash/message.png](https://dl.dropboxusercontent.com/u/774859/GitHub-Repos/flash/message.png)

```php
Flash::error('Sorry! Please try again.');

return Redirect::home();
```

![https://dl.dropboxusercontent.com/u/774859/GitHub-Repos/flash/error.png](https://dl.dropboxusercontent.com/u/774859/GitHub-Repos/flash/error.png)

```php
Flash::overlay('You are now a Laracasts member!');

return Redirect::home();
```

![https://dl.dropboxusercontent.com/u/774859/GitHub-Repos/flash/overlay.png](https://dl.dropboxusercontent.com/u/774859/GitHub-Repos/flash/overlay.png)

> [Learn exactly how to build this very package on Laracasts!](https://laracasts.com/lessons/flexible-flash-messages)
