<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014
 * @package yii2-context-menu
 * @version 1.0.0
 */

namespace kartik\label;

use Yii;
use kartik\widgets\InputWidget;
use yii\bootstrap\Dropdown;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\web\View;

/**
 * A context menu extension for Bootstrap 3.0, which allows you to access
 * a context menu for a specific area on mouse right click.
 * Based on bootstrap-contextmenu jquery plugin by sydcanem.
 *
 * @see https://github.com/sydcanem/bootstrap-contextmenu
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class LabelInPlace extends InputWidget
{
    const PLUGIN_NAME = 'labelinplace';

    const TYPE_HTML5 = 'input';
    const TYPE_TEXTINPUT = 'textInput';
    const TYPE_TEXTAREA = 'textArea';

    /**
     * @var string the type of input to be rendered
     */
    public $type = self::INPUT_TEXTINPUT;

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
     * @var array allowed input types
     */
    private static $_allowedTypes = [
        self::TYPE_HTML5 => 'input',
        self::TYPE_TEXTINPUT => 'textInput',
        self::TYPE_TEXTAREA => 'textArea'
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
            throw new InvalidConfigException("Invalid 'type' entered. Must be one of: '{$types}';");
        }
        parent::init();
        $this->registerAssets();
        if ($this->label !== false) {
            echo $this->getLabel();
        }
        echo $this->getInput($this->type);
    }

    /**
     * Gets the label
     *
     * @return string
     */
    protected function getLabel()
    {
        if ($this->hasModel && !isset($this->label)) {
            return Html::activeLabel($this->model, $this->attribute, $this->labelOptions);
        } else {
            $label = $this->encodeLabel ? Html::encode($this->label) : $this->label
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