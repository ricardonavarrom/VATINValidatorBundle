<?php

namespace ricardonavarrom\VATINValidatorBundle\Validator\Constraints;

use ricardonavarrom\VATINValidatorBundle\Validator\VATINValidatorLocatedInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class VATINConstraintValidatorEs extends ConstraintValidator
{
    /** @var VATINValidatorLocatedInterface */
    private $validator;

    public function __construct(VATINValidatorLocatedInterface $validatorLocated)
    {
        $this->validator = $validatorLocated;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$this->validator->validate($value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%vatin%', $value)
                ->addViolation();
        }
    }
}