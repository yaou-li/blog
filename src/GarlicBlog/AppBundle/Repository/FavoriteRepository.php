<?php

namespace GarlicBlog\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class FavoriteRepository extends EntityRepository
{
    public function removeFormFavorite($articleId, $userId)
    {
        $query=$this->getEntityManager()
                    ->createQuery(
                        "DELETE FROM 
                            GarlicBlogAppBundle:Favorite g
                         WHERE 
                            g.userid = $userId
                         AND
                            g.articleid = $articleId"
                    );
                    
        $query->execute();
            
    }
    
    public function getFavoriteByUserId($userId) 
    {
        
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        
        $queryBuilder->select('IDENTITY (g.articleid)')
                     ->from('GarlicBlog\AppBundle\Entity\Favorite','g')
                     ->where('g.userid = ?1')
                     ->setParameter(1, $userId);
                     
        return $queryBuilder->getQuery()->getResult();
    }
    
}