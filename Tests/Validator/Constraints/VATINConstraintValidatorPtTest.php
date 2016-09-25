<?php

namespace ricardonavarrom\VATINValidatorBundle\Tests\Validator\Constraints;

use ricardonavarrom\VATINValidator\Validator\VATINValidatorPT;
use ricardonavarrom\VATINValidatorBundle\Validator\Constraints\VATINPtConstraint;
use ricardonavarrom\VATINValidatorBundle\Validator\Constraints\VATINPtConstraintValidator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Tests\Constraints\AbstractConstraintValidatorTest;
use Mockery as m;

class VATINConstraintValidatorPtTest extends AbstractConstraintValidatorTest
{
    /** @var VATINValidatorPT */
    private $validatorService;

    /** @var Constraint */
    private $constraintToTest;

    protected function createValidator()
    {
        $this->validatorService = m::mock(VATINValidatorPT::class);

        return new VATINPtConstraintValidator($this->validatorService);
    }

    /** @test */
    public function validate_whenNoValidationModalityAndValidVATIN_noViolation()
    {
        $this->constraintToTest = new VATINPtConstraint();
        $this->validatorService->shouldReceive('validate')->andReturn(true);

        $this->validator->validate('123456789', $this->constraintToTest);

        $this->assertNoViolation();
    }

    /** @test */
    public function validate_whenNoValidationModalityAndInvalidVATIN_buildViolation()
    {
        $this->constraintToTest = new VATINPtConstraint();
        $this->validatorService->shouldReceive('validate')->andReturn(false);

        $this->validator->validate('123456780', $this->constraintToTest);

        $this
            ->buildViolation($this->constraintToTest->message)
            ->setParameters(['%vatin%' => '123456780', '%validationModality%' => 'VATIN'])
            ->assertRaised();
    }

    /** @test */
    public function validate_whenNIFValidationModalityAndValidNIF_noViolation()
    {
        $this->constraintToTest = new VATINPtConstraint(['validationModality' => 'NIF']);
        $this->validatorService->shouldReceive('validateNIF')->andReturn(true);

        $this->validator->validate('123456780', $this->constraintToTest);

        $this->assertNoViolation();
    }

    /** @test */
    public function validate_whenNIFValidationModalityAndInvalidValidNIF_buildViolation()
    {
        $this->constraintToTest = new VATINPtConstraint(['validationModality' => 'NIF']);
        $this->validatorService->shouldReceive('validateNIF')->andReturn(false);

        $this->validator->validate('123456780', $this->constraintToTest);

        $this
            ->buildViolation($this->constraintToTest->message)
            ->setParameters(['%vatin%' => '123456780', '%validationModality%' => 'NIF'])
            ->assertRaised();
    }

    /** @test */
    public function validate_whenNIPCValidationModalityAndValidNIPC_noViolation()
    {
        $this->constraintToTest = new VATINPtConstraint(['validationModality' => 'NIPC']);
        $this->validatorService->shouldReceive('validateNIPC')->andReturn(true);

        $this->validator->validate('500105308', $this->constraintToTest);

        $this->assertNoViolation();
    }

    /** @test */
    public function validate_whenNIPCValidationModalityAndInvalidValidNIPC_buildViolation()
    {
        $this->constraintToTest = new VATINPtConstraint(['validationModality' => 'NIPC']);
        $this->validatorService->shouldReceive('validateNIPC')->andReturn(false);

        $this->validator->validate('500105305', $this->constraintToTest);

        $this
            ->buildViolation($this->constraintToTest->message)
            ->setParameters(['%vatin%' => '500105305', '%validationModality%' => 'NIPC'])
            ->assertRaised();
    }

    protected function tearDown()
    {
        parent::tearDown();

        m::close();
    }
}
