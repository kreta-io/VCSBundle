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

namespace Kreta\Bundle\VCSBundle\Controller\Webhook;

use Kreta\Bundle\VCSBundle\Controller\Webhook\Abstracts\AbstractWebhookController;

/**
 * Class GithubWebhookController.
 */
class GithubWebhookController extends AbstractWebhookController
{
    /**
     * {@inheritdoc}
     */
    protected function getWebhookStrategy()
    {
        return $this->get('kreta_vcs.webhook_strategy.github');
    }
}
