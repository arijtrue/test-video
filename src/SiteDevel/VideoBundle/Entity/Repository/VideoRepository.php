<?php

namespace SiteDevel\VideoBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use SiteDevel\UserBundle\Entity\User;
use SiteDevel\VideoBundle\Entity\Video;

class VideoRepository extends EntityRepository
{
    /**
     * @param User $user
     *
     * @return Video[]
     */
    public function getNotFavouritedByUser(User $user)
    {
        $qb = $this->createQueryBuilder('v');
        $qb
            ->leftJoin('v.favoritedBy', 'u')
            ->where(
                $qb->expr()->orX(
                    $qb->expr()->isNull('u.id'),
                    $qb->expr()->notIn('u.id', [$user->getId()])
                )
            )
        ;

        return $qb->getQuery()->execute();
    }
}
