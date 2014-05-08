<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014
 * @package yii2-label-inplace
 * @version 1.0.0
 */

namespace kartik\label;

use Yii;
use kartik\widgets\InputWidget;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * A form enhancement widget for Yii framework 2.0 allowing in-field label support.
 * Based on labelinplace plugin by andreapace.
 *
 * @see https://github.com/andreapace/labelinplace
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class LabelInPlace extends InputWidget
{
    const PLUGIN_NAME = 'labelinplace';

    const TYPE_TEXT = 'textInput';
    const TYPE_TEXTAREA = 'textArea';
    const TYPE_HTML5 = 'input';

    /**
     * @var string the type of input to be rendered
     */
    public $type = self::TYPE_TEXT;

    /**
     * @var string|boolean the label content to be displayed. If set to `false` will not be parsed.
     */
    public $label;

    /**
     * @var boolean whether the label is to be HTML encoded
     */
    public $encodeLabel = true;

    /**
     * @var array the HTML attributes for the label
     */
    public $labelOptions = [];

    /**
     * @var boolean show default label direction indicators
     */
    public $defaultIndicators = true;

    /**
     * @var array allowed input types
     */
    private static $_allowedTypes = [
        self::TYPE_TEXT => 'textInput',
        self::TYPE_TEXTAREA => 'textArea',
        self::TYPE_HTML5 => 'input'
    ];

    /**
     * Initializes the widget
     *
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        if (!in_array($this->type, self::$_allowedTypes)) {
            $types = implode("', '", self::$_allowedTypes);
            throw new InvalidConfigException("Invalid 'type' entered. Must be one of: '{$types}'.");
        }
        parent::init();
        if (empty($this->options['class'])) {
            $this->options['class'] = 'form-control';
        }
        $this->initPluginOptions();
        if ($this->label !== false) {
            echo $this->getLabel();
        }
        if ($this->type == self::TYPE_HTML5) {
            $type = ArrayHelper::remove($this->options, 'type', 'text');
            $input = $this->hasModel() ?
                Html::activeInput($type, $this->model, $this->attribute, $this->options) :
                Html::input($type, $this->name, $this->value, $this->options);
        } else {
            $input = $this->getInput($this->type);
        }
        echo $input;
        $this->registerAssets();
    }

    /**
     * Initialize default plugin options
     */
    protected function initPluginOptions()
    {
        $this->pluginOptions += [
            'inputAttr' => 'id',
            'labelPosition' => 'up',
            'labelIconPosition' => 'after',
        ];
        if ($this->defaultIndicators) {
            $this->pluginOptions += [
                'labelArrowRight' => ' <i class="glyphicon glyphicon-expand"></i>',
                'labelArrowDown' => ' <i class="glyphicon glyphicon-collapse-down"></i>',
                'labelArrowUp' => ' <i class="glyphicon glyphicon-collapse-up"></i>',
            ];
        }
    }

    /**
     * Gets the label
     *
     * @return string
     */
    protected function getLabel()
    {
        if ($this->hasModel() && (!isset($this->label) || $this->label === true)) {
            return Html::activeLabel($this->model, $this->attribute, $this->labelOptions);
        } else {
            $label = $this->encodeLabel ? Html::encode($this->label) : $this->label;
            return Html::label($label, $this->options['id'], $this->labelOptions);
        }
    }

    /**
     * Registers widget assets
     */
    protected function registerAssets()
    {
        $view = $this->getView();
        LabelInplaceAsset::register($view);
        $this->registerPlugin(self::PLUGIN_NAME);
    }

}