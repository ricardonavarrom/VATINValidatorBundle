<?php

namespace ricardonavarrom\VATINValidatorBundle\Tests\Validator\Constraints;

use ricardonavarrom\VATINValidatorBundle\Validator\Constraints\VATINConstraintEs;
use ricardonavarrom\VATINValidatorBundle\Validator\Constraints\VATINConstraintValidatorEs;
use ricardonavarrom\VATINValidatorBundle\Validator\VATINValidatorLocatedInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Tests\Constraints\AbstractConstraintValidatorTest;
use Mockery as m;

class VATINConstraintValidatorEsTest extends AbstractConstraintValidatorTest
{
    /** @var VATINValidatorLocatedInterface  */
    private $validatorService;

    /** @var Constraint */
    private $constraintToTest;

    protected function createValidator()
    {
        $this->validatorService = m::mock(VATINValidatorLocatedInterface::class);

        return new VATINConstraintValidatorEs($this->validatorService);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->constraintToTest = new VATINConstraintEs();
    }

    /** @test */
    public function validate_whenValidVATIN_noViolation()
    {
        $this->validatorService->shouldReceive('validate')->andReturn(true);

        $this->validator->validate('87754163D', $this->constraintToTest);

        $this->assertNoViolation();
    }

    /** @test */
    public function validate_whenInvalidVATIN_buildViolation()
    {
        $this->validatorService->shouldReceive('validate')->andReturn(false);

        $this->validator->validate('87754163A', $this->constraintToTest);

        $this->buildViolation($this->constraintToTest->message)->setParameter('%vatin%', '87754163A')->assertRaised();
    }

    protected function tearDown()
    {
        parent::tearDown();

        m::close();
    }
}
