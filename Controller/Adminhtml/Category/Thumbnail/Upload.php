<?php
/**
 * Bitpolar Technologies
 *
 ********************************************************************
 *
 * @category   Bitpolar
 * @package    Bitpolar_CategoryImgWidget
 * @author     Stefan Euchenhofer (info@bitpolar.de)
 * @copyright  Copyright (c) 2019 Bitpolar Technologies (https://www.bitpolar.de)
 */

namespace Bitpolar\CategoryImgWidget\Controller\Adminhtml\Category\Thumbnail;

use Magento\Framework\Controller\ResultFactory;

/**
 * Class Upload
 */
class Upload extends \Magento\Catalog\Controller\Adminhtml\Category\Image\Upload
{
    /**
     * Upload file controller action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        try {
            $result = $this->imageUploader->saveFileToTmpDir('thumbnail');

            $result['cookie'] = [
                'name' => $this->_getSession()->getName(),
                'value' => $this->_getSession()->getSessionId(),
                'lifetime' => $this->_getSession()->getCookieLifetime(),
                'path' => $this->_getSession()->getCookiePath(),
                'domain' => $this->_getSession()->getCookieDomain(),
            ];
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }
}
