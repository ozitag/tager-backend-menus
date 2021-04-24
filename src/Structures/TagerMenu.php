<?php

namespace OZiTAG\Tager\Backend\Menus\Structures;

class TagerMenu
{
    protected bool $supportsTree = false;

    protected string $name;

    public function __construct(string $name, bool $supportsTree = true)
    {
        $this->name = $name;

        $this->supportsTree = $supportsTree;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function supportsTree(): bool
    {
        return $this->supportsTree;
    }
}
