<?php
namespace Asi\ClinicaBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class CacheListener
{
    public function onKernelResponse(FilterResponseEvent $event)
    {
        $response = $event->getResponse();

        $response->headers->addCacheControlDirective('public', true);
        $response->headers->addCacheControlDirective('max-age', 3600);
        $response->headers->addCacheControlDirective('must-revalidate', true);
        // $response->headers->addCacheControlDirective('no-store', true);
    }
}