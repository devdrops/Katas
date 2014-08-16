<?php

namespace Vendor\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NotificationLink
 *
 * @ORM\Table("vendor_product_translation")
 * @ORM\Entity()
 */
class ProductTranslation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="locale", type="string", length=5)
     */
    private $locale;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="translations")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     **/
    private $product;

    public function __construct(Product $product, $locale)
    {
        $this->product = $product;
        $this->locale = $locale;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    public function getLocale()
    {
        return is_null($this->locale) ? 'en' : $this->locale;
    }

    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

}
