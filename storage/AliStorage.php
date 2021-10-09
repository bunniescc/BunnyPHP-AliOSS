<?php

namespace Bunny\Storage;

use BunnyPHP\Storage;
use BunnyPHP\View;
use OSS\Core\OssException;
use OSS\OssClient;

/**
 * Class AliStorage
 * @package Bunny\Storage
 * @author IvanLu
 * @time 2018/8/4 22:12
 */
class AliStorage implements Storage
{
    protected OssClient $ossClient;
    protected $accessKeyId;
    protected $accessKeySecret;
    protected $endpoint;
    protected $bucket;
    protected $url;

    public function __construct($config)
    {
        $this->accessKeyId = $config['key'];
        $this->accessKeySecret = $config['secret'];
        $this->endpoint = $config['endpoint'];
        $this->bucket = $config['bucket'];
        $this->url = $config['url'];

        try {
            $this->ossClient = new OssClient($this->accessKeyId, $this->accessKeySecret, $this->endpoint);
        } catch (OssException $e) {
            View::error(['tp_error_msg' => $e->getMessage()]);
        }
    }

    public function read($filename)
    {
        return $this->ossClient->getObject($this->bucket, $filename);
    }

    public function write($filename, $content): string
    {
        $this->ossClient->putObject($this->bucket, $filename, $content);
        return $this->url . $filename;
    }

    public function upload(string $filename, string $path): string
    {
        try {
            $this->ossClient->uploadFile($this->bucket, $filename, $path);
            return $this->url . $filename;
        } catch (OssException $e) {
            View::error(['tp_error_msg' => $e->getMessage()]);
            return false;
        }
    }

    public function remove($filename): bool
    {
        if (strpos($filename, $this->url) === 0) {
            $filename = substr($filename, strlen($this->url));
        }
        $this->ossClient->deleteObject($this->bucket, $filename);
        return true;
    }
}