<?php

namespace Asapo\Bundle\TidyBundle\Listener;

use Asapo\Bundle\TidyBundle\Wrapper\TidyWrapperInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

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

        // only do something when the requested format is 'html"
        if ($request->getRequestFormat() != 'html') {
            return;
        }

        // only do something when the client accepts 'text/html' as response format
        if (false === strpos($request->headers->get('Accept'), 'text/html')) {
            return;
        }

        // clean up content
        $content = $event->getResponse()->getContent();
        $event->getResponse()->setContent($this->tidy->cleanUp($content));

        $errors = $this->tidy->getLastErrorBuffer();
    }
} 
