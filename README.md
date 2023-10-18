# katzen48\SSO

```bash
composer require katzen48/socialite-sso
```

### Add configuration to `config/services.php`

```php
'sso' => [    
  'client_id' => env('SSO_CLIENT_ID'),  
  'client_secret' => env('SSO_CLIENT_SECRET'),  
  'redirect' => env('SSO_REDIRECT_URI') 
],
```

### Add provider event listener

Configure the package's listener to listen for `SocialiteWasCalled` events.

Add the event to your `listen[]` array in `app/Providers/EventServiceProvider`. See the [Base Installation Guide](https://socialiteproviders.com/usage/) for detailed instructions.

```php
protected $listen = [
    \Katzen48\Socialite\SSO\SocialiteWasCalled::class => [
        // ... other providers
        \Katzen48\Socialite\SSO\SSOExtendSocialite::class.'@handle',
    ],
];
```

### Usage

You should now be able to use the provider like you would regularly use Socialite (assuming you have the facade installed):

```php
return Socialite::driver('sso')->redirect();
```