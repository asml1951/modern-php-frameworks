<?php

namespace App\Service;


class HelloService
{
    public function hello(string $name): string
    {
        return 'Hello ' . $name;
    }
}