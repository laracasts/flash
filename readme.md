# Easy Flash Messages

## Installation

First, pull in the package through Composer.

```js
"require": {
    "laracasts/flash": "~1.0"
}
```

And then include the service provider within `app/config/app.php`.

```php
'providers' => [
    'Laracasts\Flash\FlashServiceProvider
];
```

Also, for convenience, add a facade alias to this same file at the bottom:

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

That's it! Without that message flashed to the session, you may now display it in your view(s).

You can also do:

- `Flash::success('Message')`
- `Flash::error('Message')`
- `Flash::overlay('Message')`


