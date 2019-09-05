<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AdminController
{
    /**
     * @Route("/admin", name = "admin")
     */
    public function showPanel()
    {
        return new Response('<html><body><h1> Admin Panel.</h1></body></html>');
    }
}