<?php

/*
 * This file is part of the Kreta package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Kreta\Bundle\VCSBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class RegisterSerializersPass.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class RegisterSerializersPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('kreta_vcs.registry.serializer')) {
            return;
        }
        $registry = $container->getDefinition('kreta_vcs.registry.serializer');
        foreach ($container->findTaggedServiceIds('kreta_vcs.serializer') as $id => $attributes) {
            if (!isset($attributes[0]['provider']) && !isset($attributes[0]['event'])) {
                throw new \InvalidArgumentException(
                    'Tagged serializers need to have `provider` and `event` attributes.'
                );
            }
            $registry->addMethodCall('registerSerializer', [
                $attributes[0]['provider'], $attributes[0]['event'], new Reference($id),
            ]);
        }
    }
}
