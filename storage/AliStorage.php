<?php
/**
 * Created by PhpStorm.
 * User: IvanLu
 * Date: 2018/8/4
 * Time: 22:12
 */

namespace Bunny\Storage;

use BunnyPHP\Storage;
use BunnyPHP\View;
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
            View::error(['tp_error_msg' => $e->getMessage()]);
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
        return $this->url . $filename;
    }

    public function upload($filename, $path)
    {
        try {
            $this->ossClient->uploadFile($this->bucket, $filename, $path);
            return $this->url . $filename;
        } catch (OssException $e) {
            View::error(['tp_error_msg' => $e->getMessage()]);
            return false;
        }
    }

    public function remove($filename)
    {
        if (strpos($filename, $this->url) === 0) {
            $filename = substr($filename, strlen($this->url));
        }
        $this->ossClient->deleteObject($this->bucket, $filename);
        return true;
    }
}