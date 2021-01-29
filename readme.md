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
