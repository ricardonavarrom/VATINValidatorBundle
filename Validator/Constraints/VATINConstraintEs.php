<?php

namespace ricardonavarrom\VATINValidatorBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/** @Annotation */
class VATINConstraintEs extends Constraint
{
    public $message = 'The VATIN "%vatin%" is not a valid spanish VATIN.';
}