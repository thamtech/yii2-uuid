Yii 2 UUID Helper
-----------------

UUID Helper and validator for Yii 2.

This library interfaces with [ramsey/uuid](https://github.com/ramsey/uuid) to
generate 
[universally unique identifiers](https://en.wikipedia.org/wiki/Universally_unique_identifier).

For license information check the [LICENSE](LICENSE.md)-file.

[![Latest Stable Version](https://img.shields.io/packagist/v/thamtech/yii2-uuid.svg)](https://packagist.org/packages/thamtech/yii2-uuid)
[![Build Status](https://img.shields.io/travis/thamtech/yii2-uuid.svg)](https://travis-ci.org/thamtech/yii2-uuid)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/thamtech/yii2-uuid.svg)](https://scrutinizer-ci.com/g/thamtech/yii2-uuid/)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/thamtech/yii2-uuid.svg)](https://scrutinizer-ci.com/g/thamtech/yii2-uuid/)


Installation
------------

The preferred way to install this extensions is through [composer](https://getcomposer.org/download/).

Either run
```
php composer.phar require --prefer-dist thamtech/yii2-uuid
```
or add
```
"thamtech/yii2-uuid": "*"
```
to the `require` section of your `composer.json` file.

Usage
-----

## New UUID

Generate a new UUID (version 4 by default):

```php
$uuid = \thamtech\uuid\helpers\UuidHelper::uuid();
```

## Ad-Hoc Validation

Validate that a string is formatted in the canonical format using
hexadecimal text with inserted hyphen characters (case insensitive):

```php
$uuid = 'de305d54-75b4-431b-adb2-eb6b9e546014';
$isValid = \thamtech\uuid\helpers\UuidHelper::isValid($uuid); // true

$uuid = 'not-a-uuid';
$isValid = \thamtech\uuid\helpers\UuidHelper::isValid($uuid); // false

// or using the Validator class directly
$validator = new \thamtech\uuid\validators\UuidValidator();
if ($validator->validate($uuid, $error)) {
    // valid
} else {
    // not valid
    echo $error
}
```

Or you can include the `use` lines, especially if you will be making multiple
uuid calls within a file:

```php
use thamtech\uuid\helpers\UuidHelper;
use thamtech\uuid\helpers\UuidValidator;

// ...

$uuid = 'de305d54-75b4-431b-adb2-eb6b9e546014';
$isValid = UuidHelper::isValid($uuid); // true

$uuid = 'not-a-uuid';
$isValid = UuidHelper::isValid($uuid); // false

// or using the Validator class directly
$validator = new UuidValidator();
if ($validator->validate($uuid, $error)) {
    // valid
} else {
    // not valid
    echo $error
}
```

## Field Validation

Incorporate this same validation into your model:

```php
public function rules()
{
    return [
        [['uuid'], 'thamtech\uuid\validators\UuidValidator'],
    ];
}
```

See Also
--------

* [ramsey/uuid](https://github.com/ramsey/uuid)

* [Universally unique identifiers](https://en.wikipedia.org/wiki/Universally_unique_identifier)
