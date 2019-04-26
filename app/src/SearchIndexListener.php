<?php
namespace Shopware\Devdocs;

use Sculpin\Core\Sculpin;
use Sculpin\Core\Event\SourceSetEvent;
use Sculpin\Core\Source\AbstractSource;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SearchIndexListener implements EventSubscriberInterface
{
    /**
     * @var string
     */
    private $outputDir;

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            Sculpin::EVENT_AFTER_RUN => 'afterRun',
        );
    }

    /**
     * @param string $outputDir
     */
    public function __construct($outputDir)
    {
        $this->outputDir = $outputDir;
    }

    /**
     * @param \Sculpin\Core\Event\SourceSetEvent $event
     */
    public function afterRun(SourceSetEvent $event)
    {
        $documents = array();
        /** @var AbstractSource $item */
        foreach ($event->allSources() as $item) {
            if ($item->data()->get('indexed')) {
                if ($item->isGenerated()) {
                    continue;
                }

                $documents[] = $this->parseSource($item);
            }
        }

        $output['entries'] = $documents;
        $json = json_encode($output, JSON_PRETTY_PRINT);

        file_put_contents($this->outputDir.'/index.json', $json);
    }

    /**
     * @param AbstractSource $source
     * @return array
     */
    
}
