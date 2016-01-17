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

namespace spec\Kreta\Bundle\VCSBundle\DependencyInjection;

use PhpSpec\ObjectBehavior;

/**
 * Class KretaVCSExtensionSpec.
 */
class KretaVCSExtensionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kreta\Bundle\VCSBundle\DependencyInjection\KretaVCSExtension');
    }

    function it_extends_kreta_extension()
    {
        $this->shouldHaveType('Kreta\Bundle\CoreBundle\DependencyInjection\Extension');
    }
}
