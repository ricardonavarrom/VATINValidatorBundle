<?php

namespace ricardonavarrom\VATINValidatorBundle\Validator\Constraints;

use ricardonavarrom\VATINValidator\Validator\VATINValidatorES;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class VATINEsConstraintValidator extends ConstraintValidator
{
    /** @var VATINValidatorES */
    private $validator;

    public function __construct(VATINValidatorES $validatorLocated)
    {
        $this->validator = $validatorLocated;
    }

    public function validate($value, Constraint $constraint)
    {
        /** @var VATINEsConstraint $constraint */
        if (!$constraint->validationModality) {
            $resultValidation = $this->validator->validate($value, $constraint->allowLowerCase);
            $validationModality = 'VATIN';
        } else {
            $validatorFunctionName = 'validate' . $constraint->validationModality;
            $resultValidation = $this->validator->$validatorFunctionName($value, $constraint->allowLowerCase);
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
