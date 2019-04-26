<?php

namespace SwagESBlog\Bundle\SearchBundleES;

use Elasticsearch\Client;
use ONGR\ElasticsearchDSL\Query\MultiMatchQuery;
use ONGR\ElasticsearchDSL\Search;
use Shopware\Bundle\ESIndexingBundle\IndexFactoryInterface;
use Shopware\Bundle\SearchBundle\Condition\SearchTermCondition;
use Shopware\Bundle\SearchBundle\Criteria;
use Shopware\Bundle\SearchBundle\ProductSearchInterface;
use Shopware\Bundle\StoreFrontBundle\Struct;
use SwagESBlog\Bundle\ESIndexingBundle\Struct\Blog;

class BlogSearch implements ProductSearchInterface
{
    /**
     * @var ProductSearchInterface
     */
    private $coreService;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var IndexFactoryInterface
     */
    private $indexFactory;

    /**
     * @param Client $client
     * @param ProductSearchInterface $coreService
     * @param IndexFactoryInterface $indexFactory
     */
    public function __construct(
        Client $client,
        ProductSearchInterface $coreService,
        IndexFactoryInterface $indexFactory
    ) {
        $this->coreService = $coreService;
        $this->client = $client;
        $this->indexFactory = $indexFactory;
    }

    public function search(Criteria $criteria, Struct\ProductContextInterface $context)
    {
        $result = $this->coreService->search($criteria, $context);

        if ($criteria->hasCondition('search')) {
            $blog = $this->searchBlog($criteria, $context);

            $result->addAttribute(
                'swag_elastic_search',
                new Struct\Attribute(['blog' => $blog])
            );
        }

        return $result;
    }

    

    /**
     * @param SearchTermCondition $condition
     * @return MultiMatchQuery
     */
    

    /**
     * @param $raw
     * @return array
     */
    
}
