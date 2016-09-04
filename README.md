VATINValidatorBundle
====================
[![Build Status](https://travis-ci.org/ricardonavarrom/VATINValidatorBundle.svg?branch=master)](https://travis-ci.org/ricardonavarrom/VATINValidatorBundle)
[![Coverage Status](https://coveralls.io/repos/github/ricardonavarrom/VATINValidatorBundle/badge.svg?branch=master)](https://coveralls.io/github/ricardonavarrom/VATINValidatorBundle?branch=master)
[![Total Downloads](https://poser.pugx.org/ricardonavarrom/vatin-validator-bundle/downloads)](https://packagist.org/packages/ricardonavarrom/vatin-validator-bundle)

A Symfony bundle for for validating VAT identification numbers (VATINs).


Installation
------------
This bundle is available on [Packagist](https://packagist.org/packages/ricardonavarrom/vatin-validator-bundle).

You can install this bundle using composer

```bash
$ composer require ricardonavarrom/vatin-validator-bundle:dev-master
```
or add the package to your composer.json file directly.

After you have installed the package, you just need to add the bundle to your AppKernel.php file:

```bash
// in AppKernel::registerBundles()
$bundles = array(
    // ...
    new ricardonavarrom\VATINValidatorBundle\VATINValidatorBundle(),
    // ...
);
```


Configuration
-------------
VATINValidatorBundle requires no initial configuration to get you started.


Basic usage
-----------
The configured serializer is available as **_ricardonavarrom.vatin_validator_** service. You must assign a valid locale (view availables locales section).

```bash
$locale = 'es';
$vatin = '56475114V';
$validator = $container->get('ricardonavarrom.vatin_validator');
$vatinIsValid = $validator->validate($vatin, $locale);
```

Another option is to use a located validator service as **_ricardonavarrom.vatin_validator.es_** (view availables locales section).

```bash
$vatin = '56475114V';
$locatedValidator = $container->get('ricardonavarrom.vatin_validator.es');
$vatinIsValid = $locatedValidator->validate($vatin);
```


Availables locales
------------------

ES

(Under construction)