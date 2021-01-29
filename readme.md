### Introduction

**Larafirebase** is a package thats offers you to send push notifications via Firebase in Laravel.

Firebase Cloud Messaging (FCM) is a cross-platform messaging solution that lets you reliably deliver messages at no cost.

For use cases such as instant messaging, a message can transfer a payload of up to 4KB to a client app.

### Installation

Follow the steps below to install the package.


**Composer**

```
composer require kutia-digital-agency/larafirebase
```

**Copy Config**

Run `php artisan vendor:publish --provider="Kutia\Larafirebase\Providers\LarafirebaseServiceProvider"` to publish the `larafirebase.php` config file.

**Get Athentication Key**

Get Authentication Key from https://console.firebase.google.com/

**Configure larafirebase.php as needed**

```
'authentication_key' => '{AUTHENTICATION_KEY}'
```

### Usage

Follow the steps below to find how to use the package.

```php
<?php

namespace {CONTROLLER_NAMESPACE};

use {BASE_CONTROLLER_NAMESPACE};
use Kutia\Larafirebase\Facades\Larafirebase;

class TestFirebase extends {BASE_CONTROLLER_NAMESPACE}
{
    public function sendNotification()
    {
        $deviceTokens = [
            '{TOKEN_1}',
            '{TOKEN_2}'
        ];
        
        return Larafirebase::withTitle('Test Title')
            ->withBody('Test body')
            ->withImage('https://firebase.google.com/images/social.png')
            ->withClickAction('admin/notifications')
            ->sendNotification($deviceTokens);
    }

    public function sendMessage()
    {
        $deviceTokens = [
            '{TOKEN_1}',
            '{TOKEN_2}'
        ];
        
        return Larafirebase::withTitle('Test Title')
            ->withBody('Test body')
            ->sendMessage($deviceTokens);
    }
}
```

### Author
* Name: **Gentrit Abazi**
* Email: **gentritabazi01@gmail.com**
