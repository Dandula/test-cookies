## Security Errors
1. Endpoints that require an authorized user should only be available to authorized users.  
   It is necessary to use the `auth` middleware:
```php
Route::get('/buy', function () {
    //
})->middleware('auth');
```
2. There is no check to pass a negative value in the `cookies` parameter.  
   Thus, it is possible to "charge" money to balance.
   It is solved by validation of input parameters of request.
```php
public function rules()
{
    return [
        'cookies' => 'required|integer|min:1',
    ];
}
```
3. You can pass a string in the `cookies` parameter. This causes a server error (500).
   It can be solved by validating request parameters. Example code in above paragraph.
4. There is no check if there is enough money on the balance of the user.
```php
if ($cookies > $user->wallet) {
    return new Response('There is not enough money on the balance', Response::HTTP_UNPROCESSABLE_ENTITY);
}
```
5. This endpoint is vulnerable to a CSRF attack.  
   It can be solved by embedding a CSRF token and using `FormRequest::class` for the request handling.
6. This section of code may cause non-obvious behavior: `Log:info(...);`.  
   It was probably meant to access the static method of the `Log` facade.
   However, `Log:` would be interpreted as a `Log` label and `info()` as a separate method.  
   Because of this, it will work in later versions of Laravel, since there is a `info()` helper there.
   But it won't work in earlier versions of Laravel, where this method is missing.
   The solution is to access the static method of the class correctly:
```php
Log::info('bla-bla-bla');
```

## Architecture Errors
1. The `POST` method should be used for this endpoint, since this request is not idempotent.
2. Since the `cookies` parameter is not a database record ID or slug, it should be passed as a request parameter,
   not as part of the URI.

## Code Style Errors
1. It is bad practice to describing an endpoint in a routing file. The description of the endpoint
   should be placed in the controller method.
2. Routes that are used in HTML forms and can be used for redirects (as in this case)
   it's better to create named routes.
3. According to [Laravel best practices](https://github.com/alexeymezenin/laravel-best-practices)
   naming variables is better to do in camelCase notation: `$newAmount` instead of `$new_amount`.

## UI Improvements
1. or messages to the user about a successful purchase, it is better to change the noun names
   depending on the number of cookies purchased:
```php
return 'Success, you have bought ' . $cookies . ' ' . Str::plural('cookie', $cookies) . '!';
```
