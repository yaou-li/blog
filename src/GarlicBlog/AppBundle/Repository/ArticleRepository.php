<?php

namespace GarlicBlog\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{
    public function orderByTime()
    {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT 
                    a.id, a.title, a.authorid, u.username,u.nickname, a.posttime, a.categoryids, a.intro, a.content, a.readnum, a.likenum, a.privacy
                 FROM 
                    GarlicBlogAppBundle:Article a 
                 LEFT JOIN 
                    GarlicBlogUserBundle:User u 
                 WHERE 
                    a.authorid = u.id
                 ORDER BY 
                    a.posttime DESC"
            )
            ->getResult();
    }
}