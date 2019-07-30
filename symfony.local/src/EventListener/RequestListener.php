<?php
/**
 * Created by : alex
 * Date: 29.07.2019
 * Time: 12:23
 */

namespace App\EventListener;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class RequestListener
{
    public function onKernelRequest(RequestEvent $event)
    {
        $headers = $event->getRequest()->headers;

        if ($headers->has('x-username')
            && $headers->get('x-username') == 'admin') {

            if ($headers->has('x-password')
                && password_verify('123456', $headers->get('x-password'))) {

               return ;

            }
        }

         throw new UnauthorizedHttpException('','Not Authorised');

    }
}