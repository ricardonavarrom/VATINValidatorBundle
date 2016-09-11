<?php

namespace ricardonavarrom\VATINValidatorBundle\Validator;

interface VATINValidatorLocatedInterface
{
    public function validate($vatin, $allowLowerCase = true);
}