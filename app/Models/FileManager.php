<?php

namespace App\Models;

use App\Jobs\removeArchiveAfterDownload;

class FileManager
{
    public function read(string $path = "C:/") {
        $dir = scandir($path);
        $result = [];
        foreach ($dir as $item) {
            $item_path = $path.'/'.$item;
            if ($item != ".." && $item != ".") {
                $file = null;
                if (is_dir($item_path)) {
                    $file = new Dir($item_path);
                } else {
                    $file = new File($item_path);
                }
                $result[] = $file;
            }
        }
        return json_encode($result);
    }

    public function move($path, $moveTo) {
        $file = new File($path);
        return $file->move($moveTo);
    }

    public function rename($path, $moveTo) {
        $file = new File($path);
        return $file->rename($moveTo);
    }

    public function copy($path, $moveTo) {
        $file = new File($path);
        return $file->copy($moveTo);
    }

    public function remove(string $path) {
        if (is_dir($path)) {
            $dir = new Dir($path);
            return $dir->remove();
        }
        $file = new File($path);
        return $file->remove();
    }

    public function archive($path, $compressTo) {
        if (is_dir($path)) {
            $dir = new Dir($path, true);
            $archive = $dir->pack($compressTo);
        } else {
            $file = new File($path);
            $archive = $file->pack($compressTo);
        }
        return $archive;
    }

    public function unarchive($path, $extTo) {
        $archive = new Archive($path);
        return $archive->unpack($extTo);
    }

    public function download(string $path) {
        if (is_dir($path)) {
            $dir = new Dir($path, true);
            return $dir->download();
        } else {
            $file = new File($path);
            return $file->download();
        }
    }

    public function mkdir(string $path) {
        return Dir::createNew($path);
    }

    public function mkfile(string $path) {
        return File::createNew($path);
    }

    public function upload($file, $path) {
        $file->move($path);
        return new File($path);
    }
}
