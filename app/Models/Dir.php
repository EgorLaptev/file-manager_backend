<?php

namespace App\Models;

use App\Jobs\removeArchiveAfterDownload;
use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZipArchive;

class Dir extends File
{
    public function __construct($path, $simplified = false)
    {
        parent::__construct($path, $simplified);
        $this->type = 'd';
    }

    public static function createNew($path): Dir {
        mkdir($path);
        return new Dir($path);
    }

    public function download()
    {
        $archive = $this->pack();
        dispatch(new removeArchiveAfterDownload($archive->path))->afterResponse();
        return $archive->path;
    }

    public function pack($name = false): Archive {
        $rootPath = realpath($this->path);

        $time = time();
        $zip = new ZipArchive();
        if (!$name) {
            $name = $this->path.'/'.$time."file.zip";
        }
        $zip->open($name, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($rootPath), RecursiveIteratorIterator::LEAVES_ONLY) as $name => $file)
        {
            if (!$file->isDir())
            {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);

                $zip->addFile($filePath, $relativePath);
            }
        }

        $zip->close();

        return new Archive($name);
    }

    protected function setSize() {
        $bytestotal = 0;
        foreach(new RecursiveDirectoryIterator($this->path, FilesystemIterator::SKIP_DOTS) as $object){
            $bytestotal += $object->getSize();
        }
        $this->size = round($bytestotal / 1024);
    }

    public function remove() {
        rmdir($this->path);
        return ["success" => "true"];
    }
}
