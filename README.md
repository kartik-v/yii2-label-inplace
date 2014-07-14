yii2-label-inplace
=================

A form enhancement widget for Yii framework 2.0 allowing in-field label support. This widget is a wrapper for the 
[labelinplace plugin](https://github.com/andreapace/labelinplace) which is styled for Bootstrap 3. 

> NOTE: This extension depends on the [kartik-v/yii2-widgets](https://github.com/kartik-v/yii2-widgets) extension which in turn depends on the
[yiisoft/yii2-bootstrap](https://github.com/yiisoft/yii2/tree/master/extensions/bootstrap) extension. Check the 
[composer.json](https://github.com/kartik-v/yii2-label-inplace/blob/master/composer.json) for this extension's requirements and dependencies. 
Note: Yii 2 framework is still in active development, and until a fully stable Yii2 release, your core yii2-bootstrap packages (and its dependencies) 
may be updated when you install or update this extension. You may need to lock your composer package versions for your specific app, and test 
for extension break if you do not wish to auto update dependencies.

### Demo
You can see detailed [documentation](http://demos.krajee.com/label-inplace) on usage of the extension.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

> Note: You must set the `minimum-stability` to `dev` in the **composer.json** file in your application root folder before installation of this extension.

Either run

```
$ php composer.phar require kartik-v/yii2-label-inplace "dev-master"
```

or add

```
"kartik-v/yii2-label-inplace": "dev-master"
```

to the ```require``` section of your `composer.json` file.

## Usage

### LabelInPlace

```php
use kartik\label\LabelInPlace;
echo LabelInPlace::widget([
    'label' => 'Email Address'
]); 
```

## License

**yii2-label-inplace** is released under the BSD 3-Clause License. See the bundled `LICENSE.md` for details.