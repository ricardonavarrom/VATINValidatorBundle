<?php

namespace ricardonavarrom\VATINValidatorBundle;

use ricardonavarrom\VATINValidatorBundle\DependencyInjection\Compiler\VATINValidatorLocatedPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class VATINValidatorBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new VATINValidatorLocatedPass());
    }
}
