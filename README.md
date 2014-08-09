AsapoTidyBundle
===============

PHP-Tidy wrapper Bundle for Symfony 2 Projects

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/wachterjohannes/AsapoTidyBundle/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/wachterjohannes/AsapoTidyBundle/?branch=develop)

## Why use this Bundle?

This Bundle uses [tidy-php](http://php.net/manual/de/book.tidy.php) to clean and repair responses automatically.

## What tidy is?

Tidy is a binding for the Tidy HTML clean and repair utility which allows you to clean, manipulate HTML documents and traverse the document tree.

[Source ...](http://php.net/manual/de/intro.tidy.php)

## Installation

__Development version__
````bash
php composer.phar require asapo/tidy-bundle:dev-develop
````

__Current Release__
````bash
php composer.phar require asapo/tidy-bundle:0.1.*
````

## Configuration

```yml
asapo_tidy:
    config:               []
    encoding:             utf8
    response_listener:    true
    data_collector:       true
```

* config: tidy-php configuration [see here ...](http://tidy.sourceforge.net/docs/quickref.html)
* encoding: change encoding of parser
* response_listener: enable or disable reponse listener (cleanup automatically reponses)
* data_collector: enable or disable data collector to see tidy warnings / errors in profiler

## Try it?

You have two possibilities to trigger tidy bundle.

### Service

````php
/** @var TidyWrapperInterface $asapoTidy */
$asapoTidy = $this->get('tidy');
$clean = $asapoTidy->cleanUp($dirty, 'your_alias');
````

### Automatically with reponse listener

```php
return $this->render('AcmeDemoBundle:Welcome:index.html.twig', array(), new TidyResponse('your_alias'));
```

or

```php
return new TidyResponse('your_alias', $dirty);
```

## Profiler

If the data collector is enabled error or warnings can be displayed over the symfony2 profiler.

### Toolbar

![image](https://cloud.githubusercontent.com/assets/1464615/3867790/88dffd28-2011-11e4-9d1c-004f2bfeecdc.png)

(green icon on the far right)

### Panel

![image](https://cloud.githubusercontent.com/assets/1464615/3867794/91f476be-2011-11e4-9620-972f6108162f.png)


