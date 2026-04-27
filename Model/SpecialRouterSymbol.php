<?php

declare(strict_types = 1);

namespace MarkShust\SpecialRouter\Model;

enum SpecialRouterSymbol: string
{
    case Dash = '-';
    case Period = '.';
    case Tilda = '~';

    public function key(): string
    {
        return strtolower($this->name);
    }

    public function isPresentIn(string $routePath): bool
    {
        return str_contains($routePath, $this->value);
    }
}
