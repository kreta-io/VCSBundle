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

namespace Kreta\Bundle\VCSBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use Kreta\Component\Core\Annotation\ResourceIfAllowed as Issue;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CommitController.
 */
class CommitController extends Controller
{
    /**
     * Returns all commits of issue id given.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request The request
     * @param string                                    $issueId The issue id
     *
     * @ApiDoc(resource = true, statusCodes = {200, 403, 404})
     * @Get("/issues/{issueId}/vcs-commits")
     * @View(statusCode=200, serializerGroups={"commitList"})
     * @Issue()
     *
     * @return \Kreta\Component\VCS\Model\Interfaces\CommitInterface[]
     */
    public function getCommitsAction(Request $request, $issueId)
    {
        return $this->get('kreta_vcs.repository.commit')->findByIssue($request->get('issue'));
    }
}
