# Easy Flash Messages for Your Laravel App

This composer package offers a Twitter Bootstrap optimized flash messaging setup for your Laravel applications.

> [Learn exactly how to build this very package on Laracasts!](https://laracasts.com/lessons/flexible-flash-messages)

## Installation

Begin by pulling in the package through Composer.

```bash
composer require laracasts/flash
```

Next, as noted above, the default CSS classes for your flash message are optimized for Twitter Bootstrap. As such, either pull in the Bootstrap's CSS within your HTML or layout file, or write your own CSS based on these classes:

```html
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous" />
```

(See https://getbootstrap.com/docs/ for the latest CSS version)

## Usage

Within your controllers, before you perform a redirect, make a call to the `flash()` function:

```php
public function store()
{
    flash('Welcome Aboard!');

    return home();
}
```

You may also append to the function with the following actions:

Flash Alert Themes:

- `flash('Message')->success()`: Set the flash theme to "success".
- `flash('Message')->warning()`: Set the flash theme to "warning".
- `flash('Message')->danger()` / `flash('Message')->error()`: Set the flash theme to "danger".
- `flash('Message')->info()`: Set the flash theme to "info".
- `flash('Message')->primary()`: Set the flash theme to "primary".
- `flash('Message')->secondary()`: Set the flash theme to "secondary".
- `flash('Message')->light()`: Set the flash theme to "light".
- `flash('Message')->dark()`: Set the flash theme to "dark".

Flash Alert Dismissible Options:

- `flash('Message')->dismissible()`: Add a close button to the flash message.
- `flash('Message')->important()`: Add a close button to the flash message and prevent auto hiding (if in combination with Javascript).
- `flash('Message')->fixed()`: Stops the flash message from ever being closed (Overrides `dismissible()` and `important()`).

Render as Overlay Modal:

- `flash('Message')->overlay()`: Render the message as an overlay modal.
- `flash()->overlay('Modal Message', 'Modal Title')`: Render the message as an overlay modal with a title.

**TIP** You can combine actions:

- `flash('Message')->error()->important()`: Render a "danger" flash message that must be dismissed.

With this message flashed to the session, you may now display it in your view(s). Because flash messages and overlays are so common, we provide a template out of the box to get you started. You're free to use and even modify this template how you see fit:

```html
@include('flash::message')
```

### Modal Alerts Javascript

For overlay modal alerts add the following Javascript:

```html
<script>
  $("#flash-overlay-modal").modal();
</script>
```

### Auto Hiding Flash Messages Javascript

For auto hiding flash messages you can write a simple bit of JavaScript. For example, using jQuery, you might add the following snippet just before the closing `</body>` tag:

```html
<script>
  $("div.alert").not(".alert-important").delay(3000).fadeOut(350);
</script>
```

This will find any alerts (excluding the `->important()` ones) which should remain visible until manually closed by the user, wait three seconds, and then fade out.

### Multiple Flash Messages

If you need to flash multiple alerts do the following:

```php
flash('Message 1')->warning();
flash('Message 2')->error()->important();
flash('Message 3')->info();

return redirect('somewhere');
```

## Example

```html
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Document</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
  </head>
  <body>
    <div class="container">
      @include('flash::message')

      <p>Welcome to my website...</p>
    </div>

    <!-- If using flash()->important() or flash()->overlay(), you'll need to pull in the JS for Twitter Bootstrap. -->
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script>
      $("#flash-overlay-modal").modal();
      $("div.alert").not(".alert-important").delay(3000).fadeOut(350);
    </script>
  </body>
</html>
```

## Modify Flash Message Partials

If you need to modify the flash message partials, you can run:

```bash
php artisan vendor:publish --provider="Laracasts\Flash\FlashServiceProvider"
```

The two package views will now be located in the `resources/views/vendor/flash/` directory.
