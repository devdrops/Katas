<?php

namespace Acme\KataBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Article
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="title", type="string", length=64)
     *
     * @Assert\NotBlank(message="Title should not be empty")
     */
    private $title;

    /**
     * @ORM\Column(name="author", type="string", length=64)
     *
     * @Assert\NotBlank(message="Author should not be empty")
     */
    private $author;

    /**
     * @ORM\Column(name="content", type="text")
     *
     * @Assert\NotBlank(message="Content should not be empty")
     * @Assert\Length(min="20", minMessage="Article description must be longer")
     */
    private $content;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", cascade={"persist"})
     */
    private $tags;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function addTag(Tag $tags)
    {
        $this->tags[] = $tags;
    }

    public function removeTag(Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    public function getTags()
    {
        return $this->tags;
    }
}
