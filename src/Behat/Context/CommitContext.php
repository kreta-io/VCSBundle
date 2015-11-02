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
 * Class CommitContext.
 */
class CommitContext extends DefaultContext
{
    /**
     * Populates the database with commits.
     *
     * @param \Behat\Gherkin\Node\TableNode $commits The commits
     *
     *
     * @Given /^the following commits exist:$/
     */
    public function theFollowingCommitsExist(TableNode $commits)
    {
        foreach ($commits as $commitData) {
            $branch = $this->get('kreta_vcs.repository.branch')->findOneBy(['id' => $commitData['branch']], false);
            $issuesRelated = [];
            if (isset($commitData['issuesRelated'])) {
                foreach (explode(',', $commitData['issuesRelated']) as $issueRelated) {
                    $issuesRelated[] = $this->get('kreta_issue.repository.issue')->find($issueRelated);
                }
            }

            $commit = $this->get('kreta_vcs.factory.commit')->create(
                $commitData['sha'], $commitData['message'], $branch, $commitData['author'], $commitData['url']
            );
            $this->setField($commit, 'issuesRelated', $issuesRelated);
            $this->setId($commit, $commitData['id']);

            $this->get('kreta_vcs.repository.commit')->persist($commit);
        }
    }
}
