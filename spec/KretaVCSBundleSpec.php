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

namespace spec\Kreta\Bundle\VCSBundle;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class KretaVCSBundleSpec.
 */
class KretaVCSBundleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kreta\Bundle\VCSBundle\KretaVCSBundle');
    }

    function it_extends_bundle()
    {
        $this->shouldHaveType('Symfony\Component\HttpKernel\Bundle\Bundle');
    }

    function it_builds_extension(ContainerBuilder $container)
    {
        $container->addCompilerPass(
            Argument::type('\Kreta\Bundle\VCSBundle\DependencyInjection\Compiler\RegisterSerializersPass')
        )->shouldBeCalled();

        $this->build($container);
    }
}
