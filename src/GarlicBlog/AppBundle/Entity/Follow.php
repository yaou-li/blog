<?php

namespace GarlicBlog\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Follow
 *
 * @ORM\Table(name="follow", indexes={@ORM\Index(name="userid", columns={"userid"}), @ORM\Index(name="followerid", columns={"followerid"})})
 * @ORM\Entity
 */
class Follow
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
     * @var \GarlicBlog\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="GarlicBlog\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="followerid", referencedColumnName="id")
     * })
     */
    private $followerid;

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
     * Set followerid
     *
     * @param \GarlicBlog\UserBundle\Entity\User $followerid
     *
     * @return Follow
     */
    public function setFollowerid(\GarlicBlog\UserBundle\Entity\User $followerid = null)
    {
        $this->followerid = $followerid;

        return $this;
    }

    /**
     * Get followerid
     *
     * @return \GarlicBlog\UserBundle\Entity\User
     */
    public function getFollowerid()
    {
        return $this->followerid;
    }

    /**
     * Set userid
     *
     * @param \GarlicBlog\UserBundle\Entity\User $userid
     *
     * @return Follow
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
