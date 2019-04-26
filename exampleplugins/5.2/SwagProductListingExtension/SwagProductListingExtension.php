<?php

namespace SwagProductListingExtension;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\Tools\SchemaTool;
use Shopware\Components\Model\ModelManager;
use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\ActivateContext;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Plugin\Context\UninstallContext;
use SwagProductListingExtension\Models\Attribute;
use SwagProductListingExtension\Models\Product;
use SwagProductListingExtension\Models\Variant;

class SwagProductListingExtension extends Plugin
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
        $activateContext->scheduleClearCache(ActivateContext::CACHE_LIST_DEFAULT);
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