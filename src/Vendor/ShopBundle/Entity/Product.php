<?php

namespace Vendor\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
* @ORM\Entity()
* @ORM\Table(name="vendor_product")
*/
class Product
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column
     * @Assert\NotBlank(message="You must indicate a name to your product.")
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="You must indicate a price to your product.")
     * @Assert\Type(type="float", message="Amount must be a valid number.")
     */
    private $price;

    /**
     * @ORM\Column()
     * @Assert\NotBlank(message="You must upload a description with a PDF file.")
     * @Assert\File(mimeTypes={ "application/pdf" })
     */
    private $document;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    public function getDocument()
    {
        return $this->document;
    }

    public function setDocument($document)
    {
        $this->document = $document;
        return $this;
    }
}
