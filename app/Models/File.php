<?php

namespace App\Models;

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZipArchive;

class File
{
    public $name;
    public $ext;
    public $size;
    public $path;
    public $type;
    public $uid;
    public $gid;
    public $modified;

    public function __construct($path, $simplified = false) {
        $this->path = $path;
        $this->type = 'f';
        $this->setName();
        if (!$simplified)
            $this->setSize();
        $this->setExt();
        $this->setStat();
    }

    public static function createNew($path): File
    {
        file_put_contents($path, "");
        return new File($path);
    }

    public function download() {
        return $this->path;
    }

    public function pack($name = false): Archive {
        $rootPath = realpath($this->path);

        $time = time();
        $zip = new ZipArchive();
        if (!$name) {
            $name = $this->path.'/'.$time."file.zip";
        }
        $zip->open($name, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $zip->addFile($this->path, $this->name);
        $zip->close();

        return new Archive($name);
    }

    public function remove() {
        unlink($this->path);
        return ["success" => "true"];
    }

    public function move($moveTo) {
        rename($this->path, $moveTo);
        return ["success" => "true"];
    }

    public function rename($moveTo) {
        rename($this->path, $moveTo);
        return ["success" => "true"];
    }

    public function copy($moveTo)
    {
        copy($this->path, $moveTo);
        return ["success" => "true"];
    }

    protected function setSize() {
        $this->size = round(filesize($this->path) / 1024);
    }

    protected function setExt() {
        if (count(explode('.', explode('/', $this->path)[count(explode('/',$this->path)) - 1])))
            $this->ext = explode('.', explode('/', $this->path)[count(explode('/',$this->path)) - 1])[count(explode('.', explode('/', $this->path)[count(explode('/',$this->path)) - 1])) - 1];
        else
            $this->ext = null;
    }

    protected function setName() {
        $this->name = explode('/', $this->path)[count(explode('/',$this->path)) - 1];
    }

    protected function setStat() {
        $stat = stat($this->path);
        $this->modified = $stat['mtime'];
        $this->uid = $stat['uid'];
        $this->gid = $stat['gid'];
    }
}
