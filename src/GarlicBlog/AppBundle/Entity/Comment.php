<?php

namespace GarlicBlog\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment", indexes={@ORM\Index(name="articleid", columns={"articleid"})})
 * @ORM\Entity
 */
class Comment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="authorid", type="integer", nullable=false)
     */
    private $authorid;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", length=65535, nullable=true)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="posttime", type="datetime", nullable=false)
     */
    private $posttime;

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
     * Set authorid
     *
     * @param integer $authorid
     *
     * @return Comment
     */
    public function setAuthorid($authorid)
    {
        $this->authorid = $authorid;

        return $this;
    }

    /**
     * Get authorid
     *
     * @return integer
     */
    public function getAuthorid()
    {
        return $this->authorid;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Comment
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set posttime
     *
     * @param \DateTime $posttime
     *
     * @return Comment
     */
    public function setPosttime($posttime)
    {
        $this->posttime = $posttime;

        return $this;
    }

    /**
     * Get posttime
     *
     * @return \DateTime
     */
    public function getPosttime()
    {
        return $this->posttime;
    }

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
     * @return Comment
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
}
