# Request Payment (Code at [Yabacon/Laravel-Paystack-Sample](https://github.com/yabacon/laravel-paystack-sample))
A sample Laravel app that uses the [Mabiola\Paystack-PHP-Lib](https://packagist.org/packages/mabiola/paystack-php-lib) to send payment requests (entreaties) to customers.

## To run the sample
1. cd to the folder:
```bash
cd /path/to/request-payment
```
2. run composer install ... details on getting composer here > https://getcomposer.org/
```bash
$ composer install
```
3. Edit [.env](.env) providing your `PAYSTACK_SECRET_KEY`, database connection config and email sending config. Your paystack secret key can be gotten from > https://dashboard.paystack.co/#/settings/developer

5. On [https://dashboard.paystack.co/#/settings/developer](https://dashboard.paystack.co/#/settings/developer) set the callback url to the url to `http://localhost:8080/paystack-callback`

4. Perform migrations then start the development server.
```bash
$ php artisan migrate
$ php artisan serve --port=8080
```
6. Open http://localhost:8080 in the browser

## Files

* [donate-init.php](donate-init.php) includes code that show how to initialize a transaction
* [donate-conclude.php](donate-conclude.php) includes code that show how to verify a transaction


## Contributing

Please see [CONTRIBUTING](../CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email yabacon.valley@gmail.com instead of using the issue tracker.

