<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2013
 * @package yii2-label-inplace
 * @version 1.0.0
 */

namespace kartik\label;

/**
 * LabelInPlace bundle for \kartik\label\LabelInPlace
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class LabelInPlaceAsset extends \kartik\widgets\AssetBundle
{

    public function init()
    {
        $this->setSourcePath(__DIR__ . '/../assets');
        $this->setupAssets('css', ['css/jquery.labelinplace']);
        $this->setupAssets('js', ['js/jquery.labelinplace']);
        parent::init();
    }

}