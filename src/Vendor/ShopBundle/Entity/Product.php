<?php

namespace Vendor\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Vendor\ShopBundle\Translation\TranslationProxy;

/**
 * Product
 *
 * @ORM\Table("vendor_product")
 * @ORM\Entity()
 */
class Product
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
     * @ORM\Column()
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="ProductTranslation", mappedBy="product", cascade={"persist", "remove"})
     **/
    private $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->translations->set('fr', new ProductTranslation($this, 'fr'));
        $this->translations->set('en', new ProductTranslation($this, 'en'));
    }

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

    public function getDescription($locale = null)
    {
        $proxy = new TranslationProxy($this, $locale);

        return $proxy->getDescription();
    }

    public function setDescription($description, $locale = null)
    {
        $this->getTranslation($locale)->setDescription($description);

        return $this;
    }

    /**
     * @return ProductTranslation[] $translations
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * Returns a product translation according to a locale.
     *
     * @param string $locale
     * @return ProductTranslation $translation | InvalidArgumentException
     */
    public function getTranslation($locale)
    {
        foreach ($this->translations as $translation) {
            if ($locale === $translation->getLocale()) {
                return $translation;
            }
        }

        throw new \InvalidArgumentException(sprintf('No translation found for locale "%s".', $locale));
    }
}
