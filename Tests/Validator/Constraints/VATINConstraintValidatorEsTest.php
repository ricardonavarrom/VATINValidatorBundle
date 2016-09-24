<?php

namespace ricardonavarrom\VATINValidatorBundle\Tests\Validator\Constraints;

use ricardonavarrom\VATINValidatorBundle\Validator\Constraints\VATINEsConstraint;
use ricardonavarrom\VATINValidatorBundle\Validator\Constraints\VATINEsConstraintValidator;
use ricardonavarrom\VATINValidatorBundle\Validator\VATINValidatorES;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Tests\Constraints\AbstractConstraintValidatorTest;
use Mockery as m;

class VATINConstraintValidatorEsTest extends AbstractConstraintValidatorTest
{
    /** @var VATINValidatorES */
    private $validatorService;

    /** @var Constraint */
    private $constraintToTest;

    protected function createValidator()
    {
        $this->validatorService = m::mock(VATINValidatorES::class);

        return new VATINEsConstraintValidator($this->validatorService);
    }

    /** @test */
    public function validate_whenNoValidationModalityAndValidVATIN_noViolation()
    {
        $this->constraintToTest = new VATINEsConstraint();
        $this->validatorService->shouldReceive('validate')->andReturn(true);

        $this->validator->validate('87754163D', $this->constraintToTest);

        $this->assertNoViolation();
    }

    /** @test */
    public function validate_whenNoValidationModalityAndInvalidVATIN_buildViolation()
    {
        $this->constraintToTest = new VATINEsConstraint();
        $this->validatorService->shouldReceive('validate')->andReturn(false);

        $this->validator->validate('87754163A', $this->constraintToTest);

        $this
            ->buildViolation($this->constraintToTest->message)
            ->setParameters(['%vatin%' =>'87754163A', '%validationModality%' => 'VATIN'])
            ->assertRaised();
    }

    /** @test */
    public function validate_whenNIFValidationModalityAndValidNIF_noViolation()
    {
        $this->constraintToTest = new VATINEsConstraint(['validationModality' => 'NIF']);
        $this->validatorService->shouldReceive('validateNIF')->andReturn(true);

        $this->validator->validate('64076115R', $this->constraintToTest);

        $this->assertNoViolation();
    }

    /** @test */
    public function validate_whenNIFValidationModalityAndInvalidValidNIF_buildViolation()
    {
        $this->constraintToTest = new VATINEsConstraint(['validationModality' => 'NIF']);
        $this->validatorService->shouldReceive('validateNIF')->andReturn(false);

        $this->validator->validate('64076115P', $this->constraintToTest);

        $this
            ->buildViolation($this->constraintToTest->message)
            ->setParameters(['%vatin%' =>'64076115P', '%validationModality%' => 'NIF'])
            ->assertRaised();
    }

    /** @test */
    public function validate_whenNIEValidationModalityAndValidNIE_noViolation()
    {
        $this->constraintToTest = new VATINEsConstraint(['validationModality' => 'NIE']);
        $this->validatorService->shouldReceive('validateNIE')->andReturn(true);

        $this->validator->validate('Y8658932K', $this->constraintToTest);

        $this->assertNoViolation();
    }

    /** @test */
    public function validate_whenNIEValidationModalityAndInvalidValidNIE_buildViolation()
    {
        $this->constraintToTest = new VATINEsConstraint(['validationModality' => 'NIE']);
        $this->validatorService->shouldReceive('validateNIE')->andReturn(false);

        $this->validator->validate('Y8658932P', $this->constraintToTest);

        $this
            ->buildViolation($this->constraintToTest->message)
            ->setParameters(['%vatin%' =>'Y8658932P', '%validationModality%' => 'NIE'])
            ->assertRaised();
    }

    /** @test */
    public function validate_whenCIFValidationModalityAndValidCIF_noViolation()
    {
        $this->constraintToTest = new VATINEsConstraint(['validationModality' => 'CIF']);
        $this->validatorService->shouldReceive('validateCIF')->andReturn(true);

        $this->validator->validate('B22733109', $this->constraintToTest);

        $this->assertNoViolation();
    }

    /** @test */
    public function validate_whenCIFValidationModalityAndInvalidValidCIF_buildViolation()
    {
        $this->constraintToTest = new VATINEsConstraint(['validationModality' => 'CIF']);
        $this->validatorService->shouldReceive('validateCIF')->andReturn(false);

        $this->validator->validate('B22733108', $this->constraintToTest);

        $this
            ->buildViolation($this->constraintToTest->message)
            ->setParameters(['%vatin%' =>'B22733108', '%validationModality%' => 'CIF'])
            ->assertRaised();
    }

    protected function tearDown()
    {
        parent::tearDown();

        m::close();
    }
}
