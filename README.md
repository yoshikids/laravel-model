# Laravel-model
The Original Package is [Reliese Laravel](https://github.com/reliese/laravel).

Current Version is Beta.

Required Pecl Package:
- Memcached

This is Customized Package.
- for Multiple Primary Key
- Cached Object Instance(Like FuelPHP)
```
Model::fromPk(Pk);
Model::fromPk([multiplePK1, multiplePK2]);
```

## How does it work?

This package expects that you are using Laravel 5.1 or above.
You will need to import the `yoshikids/laravel-model` package via composer:

```shell
composer require yoshikids/laravel-model
```

### Configuration

Add the service provider to your `config/app.php` file within the `providers` key:

```php
// ...
'providers' => [
    /*
     * Package Service Providers...
     */
    \Yoshikids\Laravel\Providers\YoshikidsServiceProvider::class
],
// ...
```
### Configuration for local environment only

If you wish to enable generators only for your local environment, you should install it via composer using the --dev option like this:

```shell
composer require yoshikids/laravel-models --dev
```

Then you'll need to register the provider in `app/Providers/AppServiceProvider.php` file.

```php
public function register()
{
    if ($this->app->environment() == 'local') {
        $this->app->register(YoshikidsServiceProvider::class);
    }
}
```

## Models

Add the `models.php` configuration file to your `config` directory and clear the config cache:

```shell
php artisan vendor:publish --tag=yoshikids-models
php artisan config:clear
```

### Usage

Assuming you have already configured your database, you are now all set to go.

- Let's scaffold some of your models from your default connection.

```shell
php artisan yoshikids:models
```

- You can scaffold a specific table like this:

```shell
php artisan yoshikids:models --table=users
```

- You can also specify the connection:

```shell
php artisan yoshikids:models --connection=mysql
```

- If you are using a MySQL database, you can specify which schema you want to scaffold:

```shell
php artisan yoshikids:models --schema=shop
```

### Customizing Model Scaffolding

To change the scaffolding behaviour you can make `config/models.php` configuration file
fit your database needs. [Check it out](https://github.com/yoshikids/laravel-model/blob/master/config/models.php) ;-)

#### Support

For the time being, this package only supports MySQL databases.