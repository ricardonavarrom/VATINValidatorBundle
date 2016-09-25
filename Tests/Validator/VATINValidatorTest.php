<?php

namespace ricardonavarrom\VATINValidatorBundle\Tests\Validator;

use ricardonavarrom\VATINValidator\Validator\VATINValidatorLocatedInterface;
use ricardonavarrom\VATINValidatorBundle\Validator\VATINValidator;
use ricardonavarrom\VATINValidatorBundle\Validator\VATINValidatorInterface;
use Mockery as m;

class VATINValidatorTest extends \PHPUnit_Framework_TestCase
{
    /** @var VATINValidatorInterface */
    private $validator;

    protected function setUp()
    {
        parent::setUp();

        $this->validator = new VATINValidator();
    }

    /** @test */
    public function addVATINValidatorLocated_withUpperLocale_addsValidator()
    {
        $locale = 'ES';
        $dummyValidatorLocated = m::mock(VATINValidatorLocatedInterface::class);

        $this->validator->addVATINValidatorLocated($locale, $dummyValidatorLocated);

        $this->assertInstanceOf(VATINValidatorLocatedInterface::class, $this->validator->getLocatedValidator($locale));
    }

    /** @test */
    public function addVATINValidatorLocated_withLowerLocale_addsValidator()
    {
        $locale = 'es';
        $dummyValidatorLocated = m::mock(VATINValidatorLocatedInterface::class);

        $this->validator->addVATINValidatorLocated($locale, $dummyValidatorLocated);

        $this->assertInstanceOf(VATINValidatorLocatedInterface::class, $this->validator->getLocatedValidator($locale));
    }

    /**
     * @test
     * @expectedException ricardonavarrom\VATINValidatorBundle\Exception\VATINValidatorLocatedNoExistsException
     * @expectedExceptionMessage There is no VATIN Validator for es locale
     */
    public function getLocatedValidator_withNonExistentLocale_throwsException()
    {
        $locale = 'es';

        $this->validator->getLocatedValidator($locale);
    }

    /**
     * @test
     * @expectedException ricardonavarrom\VATINValidatorBundle\Exception\VATINValidatorLocatedNoExistsException
     * @expectedExceptionMessage There is no VATIN Validator for es locale
     */
    public function validate_withNonExistentLocale_throwsException()
    {
        $vatin = '18018830D';
        $locale = 'es';

        $this->validator->validate($vatin, $locale);
    }

    /** @test */
    public function validate_withExistentLocale_callsOnceToValidatorLocatedMethod()
    {
        $vatin = '18018830D';
        $locale = 'es';
        $mockValidatorLocated = m::mock(VATINValidatorLocatedInterface::class);
        $this->validator->addVATINValidatorLocated($locale, $mockValidatorLocated);
        $mockValidatorLocated->shouldReceive('validate')->once();

        $this->validator->validate($vatin, $locale);

        $mockValidatorLocated->mockery_verify();
    }

    protected function tearDown()
    {
        parent::tearDown();

        m::close();
    }
}
