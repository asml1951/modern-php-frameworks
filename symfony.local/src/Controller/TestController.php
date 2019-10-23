<?php


namespace App\Controller;
use Doctrine\ORM\Mapping\AnsiQuoteStrategy;
use Doctrine\ORM;
use App\Entity\User;
use App\Service\HelloService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TestController extends AbstractController
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

    /**
     * @Route("/test/show/{id}", name = "showUser")
     * @param $id
     */
    public function showUser(User $user)
    {
    /*   $entityManager = $this->getDoctrine()->getManager();
       $user = $entityManager->getRepository(User::class)
            ->find($id);  */
      //  var_dump($user);
        $groups = $user->getUserGroups();

        foreach ($groups as $group) {
            $group_name = $group->getGroupId()->getName();
            echo $group_name, '<br>';
        }
        die();
    }

}