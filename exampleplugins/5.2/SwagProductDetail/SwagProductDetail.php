<?php

namespace SwagProductDetail;

use Doctrine\ORM\Tools\SchemaTool;
use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\ActivateContext;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Plugin\Context\UninstallContext;
use Shopware\Components\Model\ModelManager;
use SwagProductDetail\Models\Product;

class SwagProductDetail extends Plugin
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

    public function uninstall(UninstallContext $uninstallContext)
    {
        if (!$uninstallContext->keepUserData()) {
            $this->removeDatabase();
        }
    }

    

    

    /**s
     * @param ModelManager $modelManager
     * @return array
     */
    

    
}