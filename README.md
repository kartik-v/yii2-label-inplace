yii2-label-inplace
=================

[![Latest Stable Version](https://poser.pugx.org/kartik-v/yii2-label-inplace/v/stable.svg)](https://packagist.org/packages/kartik-v/yii2-label-inplace)
[![License](https://poser.pugx.org/kartik-v/yii2-label-inplace/license.svg)](https://packagist.org/packages/kartik-v/yii2-label-inplace)
[![Total Downloads](https://poser.pugx.org/kartik-v/yii2-label-inplace/downloads.svg)](https://packagist.org/packages/kartik-v/yii2-label-inplace)
[![Monthly Downloads](https://poser.pugx.org/kartik-v/yii2-label-inplace/d/monthly.png)](https://packagist.org/packages/kartik-v/yii2-label-inplace)
[![Daily Downloads](https://poser.pugx.org/kartik-v/yii2-label-inplace/d/daily.png)](https://packagist.org/packages/kartik-v/yii2-label-inplace)

A form enhancement widget for Yii framework 2.0 allowing in-field label support. This widget is a wrapper for the 
[labelinplace plugin](https://github.com/andreapace/labelinplace) which is styled for Bootstrap 3. 

### Demo
You can see detailed [documentation](http://demos.krajee.com/label-inplace) on usage of the extension.

## Latest Release
The latest version of the module is v1.2.0 released on 25-Nov-2014. Refer the [CHANGE LOG](https://github.com/kartik-v/yii2-label-inplace/blob/master/CHANGE.md) for details.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

> Note: Check the [composer.json](https://github.com/kartik-v/yii2-label-inplace/blob/master/composer.json) for this extension's requirements and dependencies. 
Read this [web tip /wiki](http://webtips.krajee.com/setting-composer-minimum-stability-application/) on setting the `minimum-stability` settings for your application's composer.json.

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