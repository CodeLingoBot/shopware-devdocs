<?php
namespace Shopware\Devdocs\GitHistoryBundle;

use Sculpin\Core\Event\SourceSetEvent;
use Sculpin\Core\Permalink\SourcePermalinkFactoryInterface;
use Sculpin\Core\Sculpin;
use Sculpin\Core\Source\SourceInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Process\Process;

class HistoryListener implements EventSubscriberInterface
{
    /**
     * @var string
     */
    private $projectDir;

    /**
     * @var SourcePermalinkFactoryInterface
     */
    private $permalinkFactory;

    /**
     * @var array
     */
    private static $blacklist = [
        'source/index.html'
    ];

    /**
     * Key is the site where the history data will be added as `docHistory`
     * The value may be a prefix to filter the history by path
     *
     * @var array
     */
    private $historyRoots = [
        '/source/index.html' => '',
        '/source/labs/index.html' => 'source/labs/'
    ];

    /**
     * @param string $projectDir
     * @param SourcePermalinkFactoryInterface $permalinkFactory
     */
    public function __construct($projectDir, SourcePermalinkFactoryInterface $permalinkFactory)
    {
        $this->projectDir = $projectDir;
        $this->permalinkFactory = $permalinkFactory;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            Sculpin::EVENT_BEFORE_RUN => 'dumpGitHistory',
        ];
    }

    /**
     * @param SourceSetEvent $event
     */
    public function dumpGitHistory(SourceSetEvent $event)
    {
        /** @var SourceInterface $source */
        foreach ($event->allSources() as $source) {
            foreach ($this->historyRoots as $page => $prefix) {
                if (!preg_match('#'.$page.'$#i', $source->file()->getPathname())) {
                    continue;
                }

                if ($source->data()->get('docHistory')) {
                    continue;
                }

                $this->addHistoryToSource($source, $event->allSources(), $prefix);
            }
        }
    }

    /**
     * @param SourceInterface $source
     * @param array $sources
     * @param string $prefix
     */
    

    /**
     * @param array $sources
     * @param string $article
     *
     * @return null|SourceInterface
     */
    

    /**
     * @param int $numOfCommits
     *
     * @return array
     */
    
}
