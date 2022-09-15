<?php

namespace App\Models;

use Symfony\Component\Translation\Extractor\PhpExtractor;

class Archive extends File
{
    public function __construct($path)
    {
        parent::__construct($path);
        if ($this->ext == 'gz') {
            $this->ext = "tar." . $this->ext;
        }
        $this->type = 'a';
    }

    public function unpack($to = "/home") {
        $extractor = new \PharData($this->path);
        $extractor->extractTo($to);
        return [
            'success' => true,
        ];
    }
}
