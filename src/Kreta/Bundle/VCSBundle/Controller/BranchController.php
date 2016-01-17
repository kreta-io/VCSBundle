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
 * Class BranchController.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class BranchController extends Controller
{
    /**
     * Returns all branches of issue id given.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request The request
     * @param string                                    $issueId The issue id
     *
     * @ApiDoc(resource = true, statusCodes = {200, 403, 403})
     * @Get("/issues/{issueId}/vcs-branches")
     * @View(statusCode=200, serializerGroups={"branchList"})
     * @Issue()
     *
     * @return \Kreta\Component\VCS\Model\Interfaces\BranchInterface[]
     */
    public function getBranchesAction(Request $request, $issueId)
    {
        return $this->get('kreta_vcs.repository.branch')->findByIssue($request->get('issue'));
    }
}
