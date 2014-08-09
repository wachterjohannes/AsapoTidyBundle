<?php

namespace Asapo\Bundle\TidyBundle\Listener;

use Asapo\Bundle\TidyBundle\Wrapper\TidyWrapperInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

/**
 * Cleans all tidy response html content
 * @package Asapo\Bundle\TidyBundle\Listener
 */
class ResponseListener
{
    /**
     * @var TidyWrapperInterface
     */
    private $tidy;

    public function __construct(TidyWrapperInterface $tidy)
    {
        $this->tidy = $tidy;
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        $request = $event->getRequest();
        $response = $event->getResponse();

        if (
            // only do something when the requested format is 'html"
            $request->getRequestFormat() != 'html' ||
            // only do something when the client accepts 'text/html' as response format
            false === strpos($request->headers->get('Accept'), 'text/html') ||
            // only if the reponse is a tidy response
            false === ($response instanceof TidyResponse)
        ) {
            return;
        }

        // clean up content
        $content = $event->getResponse()->getContent();
        $event->getResponse()->setContent($this->tidy->cleanUp($content, $response->getAlias()));
    }
} 
