<?php

namespace SwagESBlog\Bundle\ESIndexingBundle;

use Doctrine\DBAL\Connection;
use SwagESBlog\Bundle\ESIndexingBundle\Struct\Blog;

class BlogProvider
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param int[] $ids
     * @return Blog[]
     */
    public function get($ids)
    {
        $query = $this->getQuery($ids);
        $data = $query->execute()->fetchAll(\PDO::FETCH_ASSOC);

        $result = [];
        foreach ($data as $row) {
            $blog = new Blog((int) $row['id'], $row['title']);
            $blog->setShortDescription($row['short_description']);
            $blog->setLongDescription($row['description']);
            $blog->setMetaTitle($row['meta_title']);
            $blog->setMetaKeywords($row['meta_keywords']);
            $blog->setMetaDescription($row['meta_description']);
            $result[$blog->getId()] = $blog;
        }

        return $result;
    }

    
}
