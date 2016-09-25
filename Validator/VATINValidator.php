<?php

namespace ricardonavarrom\VATINValidatorBundle\Validator;

use ricardonavarrom\VATINValidator\Validator\VATINValidatorLocatedInterface;
use ricardonavarrom\VATINValidatorBundle\Exception\VATINValidatorLocatedNoExistsException;

class VATINValidator implements VATINValidatorInterface
{
    private $vatinValidatorsLocated;

    public function __construct()
    {
        $this->vatinValidatorsLocated = [];
    }

    public function addVATINValidatorLocated($locale, VATINValidatorLocatedInterface $vatinValidatorLocated)
    {
        $this->vatinValidatorsLocated[strtolower($locale)] = $vatinValidatorLocated;
    }

    public function getLocatedValidator($locale)
    {
        $locale = strtolower($locale);
        if (!array_key_exists($locale, $this->vatinValidatorsLocated)) {
            throw new VATINValidatorLocatedNoExistsException(
                $locale,
                sprintf('There is no VATIN Validator for %s locale', $locale)
            );
        }

        return $this->vatinValidatorsLocated[$locale];
    }

    public function validate($vatin, $locale, $allowLowerCase = true)
    {
        /** @var VATINValidatorInterface $validator */
        $validator = $this->getLocatedValidator($locale);

        return $validator->validate($vatin, $allowLowerCase);
    }
}