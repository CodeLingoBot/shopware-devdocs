<?php
namespace Shopware\Devdocs;

use Sculpin\Core\Event\SourceSetEvent;
use Sculpin\Core\Sculpin;
use Sculpin\Core\Source\SourceInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AnchorListener implements EventSubscriberInterface
{
    /**
     * @var string[]
     */
    private $usedAnchors = array();

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            Sculpin::EVENT_AFTER_FORMAT => 'afterFormat',
        );
    }

    public function afterFormat(SourceSetEvent $event)
    {
        foreach ($event->allSources() as $source) {
            $this->formatSource($source);
        }
    }

    

    /**
     * @param $elements
     */
    
}
