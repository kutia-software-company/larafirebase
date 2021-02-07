### Introduction

**Larafirebase** is a package thats offers you to send push notifications or custom messages via Firebase in Laravel.

Firebase Cloud Messaging (FCM) is a cross-platform messaging solution that lets you reliably deliver messages at no cost.

For use cases such as instant messaging, a message can transfer a payload of up to 4KB to a client app.

### Installation

Follow the steps below to install the package.


**Composer**

```
composer require kutia-software-company/larafirebase
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

Example usage in **Controller/Service** or any class:

```php
use Kutia\Larafirebase\Facades\Larafirebase;

class MyController
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
        
        // Or
        return Larafirebase::fromArray(['title' => 'Test Title', 'body' => 'Test body'])->sendNotification($deviceTokens);
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
            
        // Or
        return Larafirebase::fromArray(['title' => 'Test Title', 'body' => 'Test body'])->sendMessage($deviceTokens);
    }
}
```

Example usage in **Notification** class:

```php
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;

class SendBirthdayReminder extends Notification
{
    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['firebase'];
    }

    /**
     * Get the firebase representation of the notification.
     */
    public function toFirebase($notifiable)
    {
        $deviceTokens = [
            '{TOKEN_1}',
            '{TOKEN_2}'
        ];
        
        return (new FirebaseMessage)
            ->withTitle('Hey, ', $notifiable->first_name)
            ->withBody('Happy Birthday!')
            ->asNotification($deviceTokens); // OR ->asMessage($deviceTokens);
    }
}
```

Check example how to receive messages or push notifications in a [JavaScript client](/javascript-client).

### Author
* Name: **Gentrit Abazi**
* Email: **gentritabazi01@gmail.com**
