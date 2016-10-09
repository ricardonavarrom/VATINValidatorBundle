<?php

namespace ricardonavarrom\VATINValidatorBundle\Tests\Validator\Constraints;

use ricardonavarrom\VATINValidatorBundle\Exception\VATINValidatorInvalidOptionValueException;
use ricardonavarrom\VATINValidatorBundle\Validator\Constraints\VATINPtConstraint;

class VATINConstraintPtTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function construct_whenNoOptionsSetted_setValidationModalityToNull()
    {
        $options = null;

        $constraint = new VATINPtConstraint($options);

        $this->assertNull($constraint->validationModality);
    }

    /** @test */
    public function construct_whenValidValidationModalitySetted_setValidationModalityWithThatOption()
    {
        $options = ['validationModality' => 'NIF'];

        $constraint = new VATINPtConstraint($options);

        $this->assertEquals($options['validationModality'], $constraint->validationModality);
    }

    /**
     * @test
     * @expectedException ricardonavarrom\VATINValidatorBundle\Exception\VATINValidatorInvalidOptionValueException
     * @expectedExceptionMessage The option validationModality must be one of these values: NIF,NIPC
     */
    public function construct_whenInvalidValidationModalitySetted_throwsException()
    {
        $options = ['validationModality' => 'invalid option'];

        try {
            new VATINPTConstraint($options);
        } catch (VATINValidatorInvalidOptionValueException $e) {
            $this->assertEquals('validationModality', $e->getOption());
            $this->assertEquals('invalid option', $e->getValue());

            throw $e;
        }
    }
}
