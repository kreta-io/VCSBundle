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

namespace spec\Kreta\Bundle\VCSBundle\Controller;

use Kreta\Component\Issue\Model\Interfaces\IssueInterface;
use Kreta\Component\VCS\Model\Interfaces\CommitInterface;
use Kreta\Component\VCS\Repository\CommitRepository;
use PhpSpec\ObjectBehavior;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CommitControllerSpec.
 */
class CommitControllerSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Kreta\Bundle\VCSBundle\Controller\CommitController');
    }

    function it_extends_rest_controller()
    {
        $this->shouldHaveType('Symfony\Bundle\FrameworkBundle\Controller\Controller');
    }

    function it_gets_commits(
        ContainerInterface $container,
        Request $request,
        CommitRepository $commitRepository,
        IssueInterface $issue,
        CommitInterface $commit
    ) {
        $container->get('kreta_vcs.repository.commit')->shouldBeCalled()->willReturn($commitRepository);
        $request->get('issue')->shouldBeCalled()->willReturn($issue);
        $commitRepository->findByIssue($issue)->shouldBeCalled()->willReturn([$commit]);

        $this->getCommitsAction($request, 'issue-id')->shouldReturn([$commit]);
    }
}
