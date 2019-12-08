# BunnyPHP AliOSS Storage Component

AliOSS Storage for BunnyPHP

[![Version](https://img.shields.io/packagist/v/ivanlulyf/bunnyphp-alioss.svg?color=orange&style=flat-square)](https://packagist.org/packages/ivanlulyf/bunnyphp-alioss)
[![Total Downloads](https://img.shields.io/packagist/dt/ivanlulyf/bunnyphp-alioss.svg?color=brightgreen&style=flat-square)](https://packagist.org/packages/ivanlulyf/bunnyphp-alioss)
![License](https://img.shields.io/packagist/l/ivanlulyf/bunnyphp-alioss.svg?color=blue&style=flat-square)

English | [中文](README_CN.md)

## Install

```shell
composer require ivanlulyf/bunnyphp-alioss
```

## Configure

```php
"storage" => [
	"name" => "bunny.ali",
	"key" => "",            // replace to your oss key
	"secret" => "",         // replace to your oss secret
	"endpoint" => "",       // replace to your oss endpoint
	"bucket" => "",         // replace to your oss bucket
	"url" => ""             // replace to your oss access url
],
```