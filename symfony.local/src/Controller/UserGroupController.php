<?php
/**
 * Created by : alex
 * Date: 13.10.2019
 * Time: 16:57
 */

namespace App\Controller;


use App\Entity\Group;
use App\Entity\User;
use App\Entity\UserGroup;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DoctrineExtensions\Query\Mysql\Cast;

/**
 * Class UserGroupManger
 * @package App\Controller
 */
class UserGroupController extends AbstractController
{
    /**
     * @Route("/add", name="addUserToGroup")
     * @param Request $request
     * @return Response
     */
    public function addUser( Request $request)
    {
        $userId = $request->query->get('uid');
        $groupId = $request->query->get('gid');
        $validBefore = str_replace("'", "", $request->query->get('validBefore'));

        if(isset($userId, $groupId, $validBefore)) {
            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)
                ->find($userId);
            if(!isset($user)){
                throw $this->createNotFoundException(
                    'No such user uid '.$userId
                );
            }
            $group = $entityManager->getRepository(Group::class)
                ->find($groupId);
            if(!isset($group)){
                throw $this->createNotFoundException(
                    'No such group gid '.$groupId
                );
            }

            $userGroup = new UserGroup();
            $userGroup->setUserId($user);
            $userGroup->setGroupId($group);
            $userGroup->setCreated(date_create(date('Y-m-d H:i:s')));
            $userGroup->setValidBefore(date_create_from_format('Y-m-d H:i:s',$validBefore));
            $entityManager->persist($userGroup);
            $entityManager->flush();
            return new Response('<h3>User was added to group!</h3>');


        } else {
            return new Response('<h3>Parametr missed!</h3>');

        }

    }

    /**
     * @Route("/delete", name="delete_expired_users")
     */
    public function deleteExpired()
    {
        return new Response( 'Number of deleted users is : '
                . $this->getDoctrine()
                    ->getRepository(UserGroup::class)
                    ->deleteExpiredUsers());

    }

}