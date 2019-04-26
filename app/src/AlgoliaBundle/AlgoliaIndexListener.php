<?php
namespace Shopware\Devdocs\AlgoliaBundle;

use AlgoliaSearch\Client;
use AlgoliaSearch\Index;
use Sculpin\Core\Sculpin;
use Sculpin\Core\Event\SourceSetEvent;
use Sculpin\Core\Source\AbstractSource;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AlgoliaIndexListener implements EventSubscriberInterface
{
    /**
     * @var Index
     */
    private $index;

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
     * @param Client $client
     * @param string $indexName
     */
    public function __construct(Client $client, $indexName)
    {
        $this->index = $client->initIndex($indexName);
        $this->index->setSettings(array(
            "attributesToIndex" => array("title", "tags", "unordered(body)"),
            'attributesForFaceting' => array('tags')
        ));
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

        $this->index->clearIndex();
        $this->index->addObjects($documents);
    }

    /**
     * @param AbstractSource $source
     * @return array
     */
    
}
