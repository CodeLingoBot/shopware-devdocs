<?php

namespace SwagExtendCustomProducts\Decorators;

use SwagCustomProducts\Components\FileUpload\FileTypeWhitelist;
use SwagCustomProducts\Components\FileUpload\FileTypeWhitelistInterface;
use SwagCustomProducts\Components\Types\Types\FileUploadType;

class FileTypeWhiteListDecorator implements FileTypeWhitelistInterface
{
    /**
     * @var FileTypeWhitelistInterface
     */
    private $fileTypeWhitelist;

    /**
     * Inject the original FileTypeWhiteListDecorator
     *
     * @param FileTypeWhitelistInterface $fileTypeWhitelist
     */
    public function __construct(FileTypeWhitelistInterface $fileTypeWhitelist)
    {
        $this->fileTypeWhitelist = $fileTypeWhitelist;
    }

    /**
     * {@inheritdoc}
     */
    public function getMimeTypeWhitelist($type)
    {
        if ($type === FileUploadType::TYPE) {
            return $this->getMimeTypeWhitelistForFiles();
        }

        return $this->fileTypeWhitelist->getMimeTypeWhitelist($type);
    }

    /**
     * {@inheritdoc}
     */
    public function getExtensionWhitelist($type)
    {
        return $this->fileTypeWhitelist->getExtensionWhitelist($type);
    }

    /**
     * {@inheritdoc}
     */
    public function getMediaOverrideType($extension)
    {
        return $this->fileTypeWhitelist->getMediaOverrideType($extension);
    }

    /**
     * Add new mimeTypes to whiteList
     *
     * @return array
     */
    
}
