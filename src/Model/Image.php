<?php

namespace ZendBricks\BricksCommon\Model;

use Zend\Captcha\Image;

class Image extends Image
{
    protected function generateImage($id, $word)
    {
        parent::generateImage($id, $word);
        $imgFile = $this->getImgDir() . $id . $this->getSuffix();
        chmod($imgFile, 0666);
    }
}
