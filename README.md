yii2-label-inplace
=================

A form enhancement widget for Yii framework 2.0 allowing in-field label support. This widget is a wrapper for the 
[labelinplace plugin](https://github.com/andreapace/labelinplace) which is styled for Bootstrap 3. 

### Demo
You can see detailed [documentation](http://demos.krajee.com/label-inplace) on usage of the extension.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

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