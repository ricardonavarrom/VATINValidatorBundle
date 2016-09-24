<?php

namespace ricardonavarrom\VATINValidatorBundle\Validator\Constraints;

use ricardonavarrom\VATINValidatorBundle\Validator\VATINValidatorPT;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class VATINPtConstraintValidator extends ConstraintValidator
{
    /** @var VATINValidatorPT */
    private $validator;

    public function __construct(VATINValidatorPT $validatorLocated)
    {
        $this->validator = $validatorLocated;
    }

    public function validate($value, Constraint $constraint)
    {
        /** @var VATINPtConstraint $constraint */
        if (!$constraint->validationModality) {
            $resultValidation = $this->validator->validate($value);
            $validationModality = 'VATIN';
        } else {
            $validatorFunctionName = 'validate' . $constraint->validationModality;
            $resultValidation = $this->validator->$validatorFunctionName($value);
            $validationModality = $constraint->validationModality;
        }

        if (!$resultValidation) {
            $this->context->buildViolation($constraint->message)
                ->setParameters([
                    '%vatin%' => $value,
                    '%validationModality%' => $validationModality
                ])
                ->addViolation();
        }
    }
}