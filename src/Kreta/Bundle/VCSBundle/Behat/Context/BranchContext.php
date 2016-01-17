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

namespace Kreta\Bundle\VCSBundle\Behat\Context;

use Behat\Gherkin\Node\TableNode;
use Kreta\Bundle\CoreBundle\Behat\Context\DefaultContext;

/**
 * Class BranchContext.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class BranchContext extends DefaultContext
{
    /**
     * Populates the database with branches.
     *
     * @param \Behat\Gherkin\Node\TableNode $branches The branches
     *
     *
     * @Given /^the following branches exist:$/
     */
    public function theFollowingBranchesExist(TableNode $branches)
    {
        foreach ($branches as $branchData) {
            $repository = $this->get('kreta_vcs.repository.repository')
                ->findOneBy(['name' => $branchData['repository']], false);
            $issuesRelated = [];
            if (isset($branchData['issuesRelated'])) {
                foreach (explode(',', $branchData['issuesRelated']) as $issueRelated) {
                    $issuesRelated[] = $this->get('kreta_issue.repository.issue')->find($issueRelated);
                }
            }

            $branch = $this->get('kreta_vcs.factory.branch')->create();
            $branch
                ->setName($branchData['name'])
                ->setRepository($repository);

            $this->setField($branch, 'issuesRelated', $issuesRelated);
            $this->setId($branch, $branchData['id']);

            $this->get('kreta_vcs.repository.branch')->persist($branch);
        }
    }
}
