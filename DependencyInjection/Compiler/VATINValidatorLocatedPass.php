<?php

namespace ricardonavarrom\VATINValidatorBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class VATINValidatorLocatedPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('ricardonavarrom.vatin_validator')) {
            return;
        }

        $definition = $container->getDefinition('ricardonavarrom.vatin_validator');
        $taggedServices = $container->findTaggedServiceIds('ricardonavarrom.vatin_validator_located');

        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $attributes) {
                $definition->addMethodCall('addVATINValidatorLocated', [
                    $attributes['locale'],
                    new Reference($id)
                ]);
            }
        }
    }
}
