# BunnyPHP 阿里云OSS存储组件

BunnyPHP的阿里云OSS存储组件

[![Version](https://img.shields.io/packagist/v/ivanlulyf/bunnyphp-alioss.svg?color=orange&style=flat-square)](https://packagist.org/packages/ivanlulyf/bunnyphp-alioss)
[![Total Downloads](https://img.shields.io/packagist/dt/ivanlulyf/bunnyphp-alioss.svg?color=brightgreen&style=flat-square)](https://packagist.org/packages/ivanlulyf/bunnyphp-alioss)
![License](https://img.shields.io/packagist/l/ivanlulyf/bunnyphp-alioss.svg?color=blue&style=flat-square)

[English](README.md) | 中文

## 安装

```shell
composer require ivanlulyf/bunnyphp-alioss
```

## 配置

```php
"storage" => [
	"name" => "bunny.ali",
	"key" => "",            // 替换成你的oss key
	"secret" => "",         // 替换成你的oss secret
	"endpoint" => "",       // 替换成你的oss endpoint
	"bucket" => "",         // 替换成你的oss bucket
	"url" => ""             // 替换成你的外部访问地址
],
```