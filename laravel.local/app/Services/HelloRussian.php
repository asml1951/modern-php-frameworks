<?php
/**
 * Created by : alex
 * Date: 23.09.2019
 * Time: 19:11
 */

namespace App\Services;


class HelloRussian implements HelloSeviceInterface
{
    public function hello(string $name): string
    {
        return 'Привет ' . $name;
    }

}
