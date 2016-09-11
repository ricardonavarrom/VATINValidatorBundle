<?php

namespace ricardonavarrom\VATINValidatorBundle\Validator\Constraints;

use ricardonavarrom\VATINValidatorBundle\Exception\VATINValidatorInvalidOptionValueException;
use Symfony\Component\Validator\Constraint;

/** @Annotation */
class VATINEsConstraint extends Constraint
{
    const VALID_VALIDATION_MODALITIES = [
        'NIF', 'NIE', 'CIF'
    ];

    public $message = 'The VATIN "%vatin%" is not a valid "%validationModality%".';

    public $allowLowerCase = true;

    public $validationModality = null;


    public function __construct($options = null)
    {
        parent::__construct($options);

        if (!$options) {
            return;
        }

        if (array_key_exists('allowLowerCase', $options)) {
            if (is_bool($options['allowLowerCase'])) {
                $this->allowLowerCase = $options['allowLowerCase'];
            } else {
                throw new VATINValidatorInvalidOptionValueException(
                    'allowLowerCase',
                    $options['allowLowerCase'],
                    'The option allowLowerCase must be one of these values: true or false'
                );
            }
        }

        if (array_key_exists('validationModality', $options)) {
            if (in_array($options['validationModality'], self::VALID_VALIDATION_MODALITIES)) {
                $this->validationModality = $options['validationModality'];
            } else {
                throw new VATINValidatorInvalidOptionValueException(
                    'validationModality',
                    $options['validationModality'],
                    'The option validationModality must be one of these values: ' . implode(',', self::VALID_VALIDATION_MODALITIES)
                );
            }
        }
    }
}