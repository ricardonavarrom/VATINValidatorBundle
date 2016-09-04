<?php

namespace ricardonavarrom\VATINValidatorBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Mockery as m;
use Symfony\Component\DependencyInjection\Definition;

class VATINValidatorLocatedPassTest extends \PHPUnit_Framework_TestCase
{
    /** @var CompilerPassInterface */
    private $pass;

    /** @var ContainerBuilder */
    private $container;

    /** @var Definition */
    private $definition;

    protected function setUp()
    {
        parent::setUp();

        $this->pass = new VATINValidatorLocatedPass();
        $this->container = m::mock(ContainerBuilder::class);
        $this->definition = m::mock(Definition::class);
    }

    /** @test */
    public function process_whenContainerHasNoMainService_addMethodCalledNever()
    {
        $this->container->shouldReceive('hasDefinition')->andReturn(null);
        $this->definition->shouldReceive('addMethodCall')->never();

        $this->pass->process($this->container);

        $this->definition->mockery_verify();
    }

    /** @test */
    public function process_whenContainerHasMainServiceAndNoHasTaggedServices_addMethodCallNever()
    {
        $this->container->shouldReceive('hasDefinition')->andReturn(true);
        $this->container->shouldReceive('getDefinition')->andReturn($this->definition);
        $this->container->shouldReceive('findTaggedServiceIds')->andReturn([]);
        $this->definition->shouldReceive('addMethodCall')->never();

        $this->pass->process($this->container);

        $this->definition->mockery_verify();
    }

    /** @test */
    public function process_whenContainerHasMainServiceAndTwoTaggedServices_addMethodCallTwice()
    {
        $this->container->shouldReceive('hasDefinition')->andReturn(true);
        $this->container->shouldReceive('getDefinition')->andReturn($this->definition);
        $this->container->shouldReceive('findTaggedServiceIds')->andReturn(
            [
                'ricardonavarrom.vatin_validator.es' => ['attributes' => ['locale' => 'es']],
                'ricardonavarrom.vatin_validator.pt' => ['attributes' => ['locale' => 'pt']],
            ]
        );
        $firstCallClosure = function ($method, $attributes) {
            return 'addVATINValidatorLocated' === $method && 'es' === $attributes[0];
        };
        $this->definition->shouldReceive('addMethodCall')->withArgs($firstCallClosure)->once();
        $secondCallClosure = function ($method, $attributes) {
            return 'addVATINValidatorLocated' === $method && 'pt' === $attributes[0];
        };
        $this->definition->shouldReceive('addMethodCall')->withArgs($secondCallClosure)->once();

        $this->pass->process($this->container);

        $this->definition->mockery_verify();
    }

    protected function tearDown()
    {
        parent::tearDown();

        m::close();
    }
}
