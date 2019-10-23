<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\UserGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class UserGroupRepository
 * @package App\Repository
 */
class UserGroupRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserGroup::class);
    }

    /**
     *  Delete users which have expiration date less than current date
     * @return int|null
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteExpiredUsers(): int
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        return $qb->delete(UserGroup::class, 'u')
            ->where(
                $qb->expr()->lte('u.valid_before', ':now'))
            ->setParameters(['now' => new \DateTime()])
            ->getQuery()->getResult();

/* Если надо вернуть список имен "протухших пользователей" пользователей  */
/*      $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $expiredUsers = $qb->select('u')
                  ->from(UserGroup::class, 'u')
                  ->where(
                      $qb->expr()->lte('u.valid_before', ':now'))
                  ->setParameters(['now' => new \DateTime()])
                  ->getQuery()->getResult();
        if($expiredUsers !== null) {
            $expiredNumber = count($expiredUsers);
            foreach ($expiredUsers as $expiredUser) {
                $user = $em->find(User::class, $expiredUser->getUserId());
                $names[] = $user->getName();
                $em->remove($expiredUser);
            }
            $em->flush();
            return ['expNum' => $expiredNumber, 'deletedUsers' => $names,];
        }
        return null;  */

    }
}
