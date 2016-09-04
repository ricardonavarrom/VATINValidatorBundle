<?php

namespace ricardonavarrom\VATINValidatorBundle\Validator;

interface VATINValidatorInterface
{
    public function addVATINValidatorLocated($locale, VATINValidatorLocatedInterface $vatinValidatorLocated);

    public function getLocatedValidator($locale);

    public function validate($vatin, $locale, $allowLowerCase = true);
}