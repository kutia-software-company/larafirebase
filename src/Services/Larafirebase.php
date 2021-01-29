<?php

namespace Kutia\Larafirebase\Services;

use Illuminate\Support\Facades\Http;

class Larafirebase
{
    private $title;
    
    private $body;

    private $clickAction;

    private $image;

    private $fromArray;

    const API_URI = 'https://fcm.googleapis.com/fcm/send';

    public function withTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function withBody($body)
    {
        $this->body = $body;

        return $this;
    }

    public function withClickAction($clickAction)
    {
        $this->clickAction = $clickAction;

        return $this;
    }

    public function withImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function fromArray($fromArray)
    {
        $this->fromArray = $fromArray;

        return $this;
    }

    public function sendNotification($tokens)
    {
        $fields = array(
            'registration_ids' => $tokens,
            'notification' => ($this->fromArray) ? $this->fromArray : [
                'title' => $this->title,
                'body' => $this->body,
                'image' => $this->image,
                'click_action' => $this->clickAction
            ],
            'data' => ['Nick' => 'a']
        );
        
        return $this->callApi($fields);
    }

    public function sendMessage($tokens)
    {
        $fields = array(
            'registration_ids' => $tokens,
            'data' => ($this->fromArray) ? $this->fromArray : [
                'title' => $this->title,
                'body' => $this->body,
                'image' => $this->image
            ]
        );
        
        return $this->callApi($fields);
    }

    public function callApi($fields)
    {
        $response = Http::withHeaders([
            'Authorization' => 'key='. config('larafirebase.authentication_key')
        ])->post(self::API_URI, $fields);

        return $response->body();
    }
}
