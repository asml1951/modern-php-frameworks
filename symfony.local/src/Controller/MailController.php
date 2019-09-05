<?php
/**
 * Created by : alex
 * Date: 27.08.2019
 * Time: 15:45
 */

namespace App\Controller;


use Swift_Mailer;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MailController extends AbstractController
{
    /**
     * @Route("/mail/{name}", name="sendsmail")
     * @param $name
     * @param Swift_Mailer $mailer
     * @return Response
     */
    public function send($name, Swift_Mailer $mailer): Response
    {
        $message = (new Swift_Message('Hello Email'))
            ->setFrom('asmolin51@gmail.com')
            ->setTo('asmolin51@gmail.com')
            ->setBody("Symfony Mail $name"
            );
       $mailer->send($message);


        return new Response('Mail Send!');
    }
}