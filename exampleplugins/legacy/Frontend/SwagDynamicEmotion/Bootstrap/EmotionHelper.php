<?php

namespace Shopware\SwagDynamicEmotion\Bootstrap;

class EmotionHelper
{
    /**
     * @var \Shopware_Plugins_Frontend_SwagDynamicEmotion_Bootstrap
     */
    private $bootstrap;

    public function __construct(\Shopware_Plugins_Frontend_SwagDynamicEmotion_Bootstrap $bootstrap)
    {
        $this->bootstrap = $bootstrap;
    }

    public function create()
    {
        list($openInfoComponent, $mapComponent, $descriptionComponent) = $this->createMyEmotionComponent();
        $this->createStoreShoppingWorld($openInfoComponent, $mapComponent, $descriptionComponent);
    }

    


    
}
