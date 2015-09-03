<?php

/*
 * This file belongs to Kreta.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Kreta\Bundle\VCSBundle\Behat\Context;

use Behat\Gherkin\Node\TableNode;
use Kreta\Bundle\CoreBundle\Behat\Context\DefaultContext;
use Kreta\Component\VCS\Model\Repository;

/**
 * Class RepositoryContext.
 *
 * @package Kreta\Bundle\VCSBundle\Behat\Context
 */
class RepositoryContext extends DefaultContext
{
    /**
     * Populates the database with repositories.
     *
     * @param \Behat\Gherkin\Node\TableNode $repositories The repositories
     *
     * @return void
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