<?php

namespace Bunny\Storage;

use BunnyPHP\Storage;
use OSS\Core\OssException;
use OSS\OssClient;

class AliStorage implements Storage
{
    protected $ossClient;
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
            exit($e->getMessage());
        }
    }

    public function read($filename)
    {
        $content = $this->ossClient->getObject($this->bucket, $filename);
        return $content;
    }

    public function write($filename, $content)
    {
        $this->ossClient->putObject($this->bucket, $filename, $content);
    }

    public function upload($filename, $path)
    {
        try {
            $this->ossClient->uploadFile($this->bucket, $filename, $path);
            return $this->url . $filename;
        } catch (OssException $e) {
            exit($e->getMessage());
        }
    }

    public function remove($filename)
    {
        if (strpos($filename, $this->url) === 0) {
            $filename = substr($filename, strlen($this->url));
        }
        $this->ossClient->deleteObject($this->bucket, $filename);
    }
}