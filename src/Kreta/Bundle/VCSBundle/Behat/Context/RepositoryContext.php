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
use Kreta\Component\VCS\Model\Repository;

/**
 * Class RepositoryContext.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class RepositoryContext extends DefaultContext
{
    /**
     * Populates the database with repositories.
     *
     * @param \Behat\Gherkin\Node\TableNode $repositories The repositories
     *
     *
     * @Given /^the following repositories exist:$/
     */
    public function theFollowingRepositoriesExist(TableNode $repositories)
    {
        foreach ($repositories as $repoData) {
            $projects = [];
            if (isset($repoData['projects'])) {
                foreach (explode(',', $repoData['projects']) as $project) {
                    $projects[] = $this->get('kreta_project.repository.project')->find($project);
                }
            }

            $repository = new Repository();
            $repository
                ->setName($repoData['name'])
                ->setProvider($repoData['provider'])
                ->setUrl($repoData['url']);

            $this->setField($repository, 'projects', $projects);
            $this->setId($repository, $repoData['id']);

            $this->get('kreta_vcs.repository.repository')->persist($repository);
        }
    }
}
