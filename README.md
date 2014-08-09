AsapoTidyBundle
===============

PHP-Tidy wrapper Bundle for Symfony 2 Projects

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/wachterjohannes/AsapoTidyBundle/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/wachterjohannes/AsapoTidyBundle/?branch=develop)

## Why use this Bundle?

This Bundle uses [tidy-php](http://php.net/manual/de/book.tidy.php) to clean and repair responses automatically.

## What tidy is?

Tidy is a binding for the Tidy HTML clean and repair utility which allows you to not only clean and otherwise manipulate HTML documents, but also traverse the document tree.

[Source ...](http://php.net/manual/de/intro.tidy.php)

## Installation

````bash
php composer.phar require asapo/tidy-bundle:dev-develop
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
