<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2018
 * @package yii2-label-inplace
 * @version 1.2.3
 */

namespace kartik\label;

use kartik\base\InputWidget;
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
    /**
     * @var string text input
     */
    const TYPE_TEXT = 'textInput';

    /**
     * @var string text area
     */
    const TYPE_TEXTAREA = 'textArea';

    /**
     * @var string HTML 5 input
     */
    const TYPE_HTML5 = 'input';

    /**
     * @inheritdoc
     */
    public $pluginName = 'labelinplace';

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
     * @var array the default list of icon indicator settings
     */
    protected static $_icons = [
        'labelArrowRight' => ['expand', 'caret-square-right'],
        'labelArrowDown' => ['collapse-down', 'caret-square-down'],
        'labelArrowUp' => ['collapse-up', 'caret-square-up'],
    ];

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
     * @throws InvalidConfigException
     * @throws \ReflectionException
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
            $isBs4 = $this->isBs4();
            $prefix = $this->getDefaultIconPrefix();
            $defaults = [];
            foreach (static::$_icons as $icon => $cfg) {
                $defaults[$icon] = ' ' . Html::tag('i', '', ['class' => $prefix . ($isBs4 ? $cfg[1] : $cfg[0])]);
            }
            $this->pluginOptions += $defaults;
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
        LabelInPlaceAsset::register($view);
        $this->registerPlugin($this->pluginName);
    }

}