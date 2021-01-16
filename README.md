# Nova status matrix Field

Laravel Nova custom field for [Status Color Matrix](https://github.com/jankapusta/nova-status-matrix-field)

![Screenshot Index](screenshot-index.png)

![Screenshot Form](screenshot-form.png)

## Installation

You can install the package in to a Laravel app that uses [Nova](https://nova.laravel.com) via composer:

```bash
composer require jankapusta/nova-status-matrix-field
```

## Usage

Laravel migration example:

```php
$table->json('user_activity_matrix');
```


Laravel model example

```php
class User extends Model {
    protected $casts = [
        'user_activity_matrix' => 'array',
    ];
    // ....
}

User::create([
    'user_activity_matrix' => [4, 5, 10, 1, 0, 0, 4, 12],
]);

```

Then add a nef field into Nova Resource

```php
NovaStatusMatrixField::make('user_activity_matrix')
  // optional setup:
  ->colorRange('green', '#ee0000') // OR ->colorMap([1 => '#ccee34', 4 => 'blue', 20 => 'ff66a4'])
  ->widt(8), // in pixels
```

## TODO

- [ ] Allow different shapes (squares, circles, etc)
- [ ] Tests

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.