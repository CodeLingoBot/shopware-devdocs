<?php

namespace SwagProductListing;

use Doctrine\ORM\Tools\SchemaTool;
use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\ActivateContext;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Plugin\Context\UninstallContext;
use SwagProductListing\Models\Product;
use Shopware\Components\Model\ModelManager;

class SwagProductListing extends Plugin
{
    /**
     * {@inheritdoc}
     */
    public function install(InstallContext $installContext)
    {
        $this->createDatabase();

        $this->addDemoData();
    }

    /**
     * {@inheritdoc}
     */
    public function activate(ActivateContext $activateContext)
    {
        $activateContext->scheduleClearCache(InstallContext::CACHE_LIST_ALL);
    }

    /**
     * {@inheritdoc}
     */
    public function uninstall(UninstallContext $uninstallContext)
    {
        if (!$uninstallContext->keepUserData()) {
            $this->removeDatabase();
        }
    }

    

    

    /**
     * @param ModelManager $modelManager
     * @return array
     */
    

    
}