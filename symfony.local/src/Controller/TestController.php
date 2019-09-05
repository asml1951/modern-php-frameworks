<?php


namespace App\Controller;


use App\Service\HelloService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController
{
    /**
     * @Route("/test/greeting/{name}", name = "test")
     *
     * @return Response
     */
    public function greeting($name, HelloService $helloService)
        {
        echo $helloService->hello($name);
        die();
    }

}