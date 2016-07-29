<?php

namespace GarlicBlog\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Favorite
 *
 * @ORM\Table(name="favorite", indexes={@ORM\Index(name="userid", columns={"userid"}), @ORM\Index(name="articleid", columns={"articleid"})})
 * @ORM\Entity
 */
class Favorite
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \GarlicBlog\AppBundle\Entity\Article
     *
     * @ORM\ManyToOne(targetEntity="GarlicBlog\AppBundle\Entity\Article")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="articleid", referencedColumnName="id")
     * })
     */
    private $articleid;

    /**
     * @var \GarlicBlog\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="GarlicBlog\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="userid", referencedColumnName="id")
     * })
     */
    private $userid;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set articleid
     *
     * @param \GarlicBlog\AppBundle\Entity\Article $articleid
     *
     * @return Favorite
     */
    public function setArticleid(\GarlicBlog\AppBundle\Entity\Article $articleid = null)
    {
        $this->articleid = $articleid;

        return $this;
    }

    /**
     * Get articleid
     *
     * @return \GarlicBlog\AppBundle\Entity\Article
     */
    public function getArticleid()
    {
        return $this->articleid;
    }

    /**
     * Set userid
     *
     * @param \GarlicBlog\UserBundle\Entity\User $userid
     *
     * @return Favorite
     */
    public function setUserid(\GarlicBlog\UserBundle\Entity\User $userid = null)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get userid
     *
     * @return \GarlicBlog\UserBundle\Entity\User
     */
    public function getUserid()
    {
        return $this->userid;
    }
}
