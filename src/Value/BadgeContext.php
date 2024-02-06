<?php

declare(strict_types=1);

namespace App\Value;

final class BadgeContext
{
    private string $caption;

    private string $color;

    private string $shape;

    private bool $hasBorder;

    private bool $hasFireworks;

    public function __construct(
        string $caption,
        string $color,
        string $shape,
        bool $hasBorder,
        bool $hasFireworks
    ) {
        $this->caption = $caption;
        $this->color = $color;
        $this->shape = $shape;
        $this->hasBorder = $hasBorder;
        $this->hasFireworks = $hasFireworks;
    }

    public function getCaption(): string
    {
        return $this->caption;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getShape(): string
    {
        return $this->shape;
    }

    public function hasBorder(): bool
    {
        return $this->hasBorder;
    }

    public function hasFireworks(): bool
    {
        return $this->hasFireworks;
    }
}
