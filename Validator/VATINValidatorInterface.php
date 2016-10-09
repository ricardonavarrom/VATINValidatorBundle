<?php

namespace ricardonavarrom\VATINValidatorBundle\Validator;

use ricardonavarrom\VATINValidator\Validator\VATINValidatorLocatedInterface;

interface VATINValidatorInterface
{
    public function addVATINValidatorLocated($locale, VATINValidatorLocatedInterface $vatinValidatorLocated);

    public function getLocatedValidator($locale);

    public function validate($vatin, $locale, $allowLowerCase = true);
}
