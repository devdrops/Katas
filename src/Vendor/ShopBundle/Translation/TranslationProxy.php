<?php

namespace Vendor\ShopBundle\Translation;

/**
 * A proxy class to access an entity translations.
 */
class TranslationProxy
{
    /**
     * @var mixed
     */
    private $entity;

    /**
     * @var string normalized to 4 characters
     */
    private $locale;

    public function __construct($entity, $locale = null)
    {
        $this->entity = $entity;
        $this->locale = $locale;
    }

    public static function create($entity, $locale = null)
    {
        return new self($entity, $locale);
    }

    public function __call($method, $arguments)
    {
        $translation = $this->getTranslation();

        if (!method_exists($translation, $method)) {
            throw new \RuntimeException(sprintf('Call to undefined method "%s" on entity "%s".', $method, get_class($translation)));
        }

        return call_user_func_array(array($translation, $method), $arguments);
    }

    private function getTranslation()
    {
        $locale = null === $this->locale ? \Locale::getDefault() : $this->locale;

        if (strlen($locale) > 2) {
            $locale = substr($locale, 0, 2);
        }

        $translations = $this->entity->getTranslations();

        if (isset($translations[$locale])) {
            return $translations[$locale];
        }

        $translation = $this->entity->getTranslation($locale);

        return $translation;
    }
}
