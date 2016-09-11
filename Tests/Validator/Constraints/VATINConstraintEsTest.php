<?php

namespace ricardonavarrom\VATINValidatorBundle\Tests\Validator\Constraints;

use ricardonavarrom\VATINValidatorBundle\Validator\Constraints\VATINConstraintEs;

class VATINConstraintEsTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function construct_whenNoOptionsSetted_setAllowLowerCaseToTrueAndValidationModalityToNull()
    {
        $options = null;

        $constraint = new VATINConstraintEs($options);

        $this->assertTrue($constraint->allowLowerCase);
        $this->assertNull($constraint->validationModality);
    }

    /** @test */
    public function construct_whenValidAllowLowerCaseOptionSetted_setAllowLowerWithThatOption()
    {
        $options = ['allowLowerCase' => false];

        $constraint = new VATINConstraintEs($options);

        $this->assertEquals($options['allowLowerCase'], $constraint->allowLowerCase);
    }

    /**
     * @test
     * @expectedException ricardonavarrom\VATINValidatorBundle\Exception\VATINValidatorInvalidOptionValueException
     * @expectedExceptionMessage The option allowLowerCase must be one of these values: true or false
     */
    public function construct_whenInvalidAllowLowerCaseOptionSetted_throwsException()
    {
        $options = ['allowLowerCase' => 'invalid option'];

        new VATINConstraintEs($options);
    }

    /** @test */
    public function construct_whenValidValidationModalitySetted_setValidationModalityWithThatOption()
    {
        $options = ['validationModality' => 'NIE'];

        $constraint = new VATINConstraintEs($options);

        $this->assertEquals($options['validationModality'], $constraint->validationModality);
    }

    /**
     * @test
     * @expectedException ricardonavarrom\VATINValidatorBundle\Exception\VATINValidatorInvalidOptionValueException
     * @expectedExceptionMessage The option validationModality must be one of these values: NIF,NIE,CIF
     */
    public function construct_whenInvalidValidationModalitySetted_throwsException()
    {
        $options = ['validationModality' => 'invalid option'];

        new VATINConstraintEs($options);
    }
}
