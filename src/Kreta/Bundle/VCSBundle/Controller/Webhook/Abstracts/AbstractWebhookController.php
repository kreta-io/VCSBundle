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

namespace Kreta\Bundle\VCSBundle\Controller\Webhook\Abstracts;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Abstract class AbstractWebhookController.
 *
 * Responsible for exposing the entrance point for webhooks.
 * Each provider should have one controller with getWebhookStrategy() implemented.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
abstract class AbstractWebhookController extends Controller
{
    /**
     * Exposes the action that will be registered as a webhook in the VCS provider.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request The request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function webhookAction(Request $request)
    {
        $serializer = $this->getWebhookStrategy()->getSerializer($request);
        $entity = $serializer->deserialize($request->getContent());

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($entity);
        $manager->flush();

        return new Response();
    }

    /**
     * Gets webhook strategy to be used in this case. Each VCS should have one.
     *
     * @return \Kreta\Component\VCS\WebhookStrategy\Abstracts\AbstractWebhookStrategy
     */
    abstract protected function getWebhookStrategy();
}
