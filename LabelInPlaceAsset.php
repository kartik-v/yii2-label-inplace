<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2015
 * @package yii2-label-inplace
 * @version 1.2.1
 */

namespace kartik\label;

/**
 * LabelInPlace bundle for \kartik\label\LabelInPlace
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class LabelInPlaceAsset extends \kartik\base\AssetBundle
{
    public function init()
    {
        $this->setSourcePath(__DIR__ . '/assets');
        $this->setupAssets('css', ['css/jquery.labelinplace']);
        $this->setupAssets('js', ['js/jquery.labelinplace']);
        parent::init();
    }
}