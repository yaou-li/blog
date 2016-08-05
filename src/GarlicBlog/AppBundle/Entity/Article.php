<?php

namespace GarlicBlog\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article", indexes={@ORM\Index(name="article_title", columns={"title"}), @ORM\Index(name="authorid", columns={"authorid"})})
 * @ORM\Entity
 */
class Article
{
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    private $title;

    /**
     * @var integer
     *
     * @ORM\Column(name="authorid", type="integer", nullable=false)
     */
    private $authorid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="posttime", type="datetime", nullable=false)
     */
    private $posttime = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="categoryids", type="text", length=65535, nullable=false)
     */
    private $categoryids;

    /**
     * @var string
     *
     * @ORM\Column(name="intro", type="text", length=65535, nullable=true)
     */
    private $intro;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", length=65535, nullable=true)
     */
    private $content;

    /**
     * @var integer
     *
     * @ORM\Column(name="readnum", type="integer", nullable=true)
     */
    private $readnum = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="likenum", type="integer", nullable=true)
     */
    private $likenum = 0;
    
    /**
     * @var string
     *
     * @ORM\Column(name="privacy", type="string", length=10, nullable=false)
     */
    private $privacy;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set title
     *
     * @param string $title
     *
     * @return Article
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
     * Set authorid
     *
     * @param integer $authorid
     *
     * @return Article
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
     * Set posttime
     *
     * @param \DateTime $posttime
     *
     * @return Article
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
     * Set categoryids
     *
     * @param string $categoryids
     *
     * @return Article
     */
    public function setCategoryids($categoryids)
    {
        $this->categoryids = $categoryids;

        return $this;
    }

    /**
     * Get categoryids
     *
     * @return string
     */
    public function getCategoryids()
    {
        return $this->categoryids;
    }

    /**
     * Set intro
     *
     * @param string $intro
     *
     * @return Article
     */
    public function setIntro($intro)
    {
        $this->intro = $intro;

        return $this;
    }

    /**
     * Get intro
     *
     * @return string
     */
    public function getIntro()
    {
        return $this->intro;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Article
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
     * Set readnum
     *
     * @param integer $readnum
     *
     * @return Article
     */
    public function setReadnum($readnum)
    {
        $this->readnum = $readnum;

        return $this;
    }

    /**
     * Get readnum
     *
     * @return integer
     */
    public function getReadnum()
    {
        return $this->readnum;
    }

    /**
     * Set likenum
     *
     * @param integer $likenum
     *
     * @return Article
     */
    public function setLikenum($likenum)
    {
        $this->likenum = $likenum;

        return $this;
    }

    /**
     * Get likenum
     *
     * @return integer
     */
    public function getLikenum()
    {
        return $this->likenum;
    }
    
    /**
     * Set privacy
     *
     * @param integer $privacy
     *
     * @return Article
     */
    public function setPrivacy($privacy)
    {
        $this->privacy = $privacy;

        return $this;
    }

    /**
     * Get privacy
     *
     * @return string
     */
    public function getPrivacy()
    {
        return $this->privacy;
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
}
