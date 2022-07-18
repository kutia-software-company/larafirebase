<?php

namespace Kutia\Larafirebase\Messages;

use Kutia\Larafirebase\Facades\Larafirebase;

class FirebaseMessage
{
    const PRIORITY_NORMAL = 'normal';

    private $title;

    private $body;

    private $clickAction;

    private $image;

    private $icon;

    private $sound;

    private $additionalData;

    private $priority = self::PRIORITY_NORMAL;

    private $fromArray;

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

    public function withSound($sound)
    {
        $this->sound = $sound;

        return $this;
    }

    public function withAdditionalData($additionalData)
    {
        $this->additionalData = $additionalData;

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

    public function asNotification($deviceTokens)
    {
        if ($this->fromArray) {
            return Larafirebase::fromArray($this->fromArray)->sendNotification($deviceTokens);
        }

        return Larafirebase::withTitle($this->title)
            ->withBody($this->body)
            ->withClickAction($this->clickAction)
            ->withImage($this->image)
            ->withIcon($this->icon)
            ->withSound($this->sound)
            ->withPriority($this->priority)
            ->withAdditionalData($this->additionalData)
            ->sendNotification($deviceTokens);
    }

    public function asMessage($deviceTokens)
    {
        if ($this->fromArray) {
            return Larafirebase::fromArray($this->fromArray)->sendMessage($deviceTokens);
        }

        return Larafirebase::withTitle($this->title)
            ->withBody($this->body)
            ->withAdditionalData($this->additionalData)
            ->sendMessage($deviceTokens);
    }
}
