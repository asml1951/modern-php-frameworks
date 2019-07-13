<?php


namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController
{
    /**
     * @Route("/", name="default")
     */

    public function index()
    {
        return new Response(
            '<html><body><h1> Welcome to Symfony! Modern PHP Framework.</h1></body></html>');
    }
}