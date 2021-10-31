<?php

namespace Kutia\Larafirebase\Services;

use Illuminate\Support\Facades\Http;
use Kutia\Larafirebase\Exceptions\UnsupportedTokenFormat;

class Larafirebase
{
    const PRIORITY_NORMAL = 'normal';

    private $title;
    
    private $body;

    private $clickAction;

    private $image;

    private $icon;

    private $priority = self::PRIORITY_NORMAL;

    private $fromArray;

    private $fromRaw;

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

    public function withIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    public function withPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    public function fromArray($fromArray)
    {
        $this->fromArray = $fromArray;

        return $this;
    }

    public function fromRaw($fromRaw)
    {
        $this->fromRaw = $fromRaw;

        return $this;
    }

    public function sendNotification($tokens)
    {
        $fields = array(
            'registration_ids' => $this->validateToken($tokens),
            'notification' => ($this->fromArray) ? $this->fromArray : [
                'title' => $this->title,
                'body' => $this->body,
                'image' => $this->image,
                'icon' => $this->icon,
                'click_action' => $this->clickAction
            ],
            'priority' => $this->priority
        );

        return $this->callApi($fields);
    }

    public function sendMessage($tokens)
    {
        $fields = array(
            'registration_ids' => $this->validateToken($tokens),
            'data' => ($this->fromArray) ? $this->fromArray : [
                'title' => $this->title,
                'body' => $this->body,
                'image' => $this->image,
                'icon' => $this->icon
            ],
            'priority' => $this->priority
        );

        return $this->callApi($fields);
    }

    public function send()
    {
        return $this->callApi($this->fromRaw);
    }

    private function callApi($fields)
    {
        $response = Http::withHeaders([
            'Authorization' => 'key=' . config('larafirebase.authentication_key')
        ])->post(self::API_URI, $fields);

        return $response->body();
    }

    private function validateToken($tokens)
    {
        if (is_array($tokens)) {
            return $tokens;
        }

        if (is_string($tokens)) {
            return explode(',', $tokens);
        }

        throw new UnsupportedTokenFormat('Please pass tokens as array [token1, token2] or as string (use comma as separator if multiple passed).');
    }
}
