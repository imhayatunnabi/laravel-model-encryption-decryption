# Laravel Hashes

A Laravel package for automatic encryption and decryption of model attributes.

## Installation

You can install the package via composer:

```bash
composer require imhayatunnabi/laravel-hashes
```

The package will automatically register its service provider.

## Usage

1. Add the `HasEncryptedAttributes` trait to your model:

```php
use Imhayatunnabi\LaravelHashes\Traits\HasEncryptedAttributes;

class User extends Model
{
    use HasEncryptedAttributes;

    /**
     * The attributes that should be encrypted.
     *
     * @var array
     */
    protected $encryptable = [
        'email',
        'phone',
        // Add other attributes you want to encrypt
    ];
}
```

2. That's it! Now your model attributes will be automatically encrypted when saving to the database and decrypted when retrieving from the database.

## Example

```php
// Creating a new user
$user = User::create([
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'phone' => '1234567890'
]);

// The email and phone will be automatically encrypted in the database

// Retrieving the user
$user = User::find(1);
echo $user->email; // Will automatically decrypt and show 'john@example.com'
echo $user->phone; // Will automatically decrypt and show '1234567890'
```

## Security

The package uses Laravel's built-in encryption facilities, which means:

1. It uses the `APP_KEY` from your `.env` file for encryption
2. It uses AES-256-CBC encryption by default
3. All encrypted values are signed with a message authentication code (MAC) to detect any modifications

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information. 