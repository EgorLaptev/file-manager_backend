<?php

namespace App\Http\Controllers;

use App\Http\Middleware\PreventRequestsDuringMaintenance;
use App\Models\Dir;
use App\Models\FileManager;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function readDir(Request $request) {
        if (array_key_exists("path", $request->all())) {
            return response()->json($this->manager->read($request->all()['path']));
        } else {
            return response()->json($this->manager->read());
        }
    }

    public function download(Request $request) {
        if (!array_key_exists('path', $request->all()) || !file_exists($request->all()['path'])) {
            abort(400);
        } else {
            return response()->download($this->manager->download($request->all()['path']));
        }
    }

    public function archive(Request $request) {
        if (!array_key_exists('path', $request->all()) || !array_key_exists('compressTo', $request->all()) || !file_exists($request->all()['path'])) {
            abort(400);
        } else {
            return response()->json($this->manager->archive($request->all()['path'], $request->all()['compressTo']));
        }
    }

    public function unacrhive(Request $request) {
        if (!array_key_exists('path', $request->all()) || !array_key_exists('extTo', $request->all()) || !file_exists($request->all()['path'])) {
            abort(400);
        } else {
            return response()->json($this->manager->unarchive($request->all()['path'], $request->all()['extTo']));
        }
    }

    public function remove(Request $request) {
        if (!array_key_exists('path', $request->all()) || !file_exists($request->all()['path'])) {
            abort(400);
        } else {
            return response()->json($this->manager->remove($request->all()['path']));
        }
    }

    public function move(Request $request) {
        if (!array_key_exists('path', $request->all()) || !array_key_exists('moveTo', $request->all()) || !file_exists($request->all()['path'])) {
            abort(400);
        } else {
            return response()->json($this->manager->move($request->all()['path'], $request->all()['moveTo']));
        }
    }

    public function rename(Request $request) {
        if (!array_key_exists('path', $request->all()) || !array_key_exists('renameTo', $request->all()) || !file_exists($request->all()['path'])) {
            abort(400);
        } else {
            return response()->json($this->manager->rename($request->all()['path'], $request->all()['renameTo']));
        }
    }

    public function copy(Request $request) {

        if (!array_key_exists('path', $request->all()) || !array_key_exists('copyTo', $request->all()) || !file_exists($request->all()['path'])) {
            abort(400);
        } else {
            return response()->json($this->manager->copy($request->all()['path'], $request->all()['copyTo']));
        }
    }

    public function mkdir(Request $request) {
        if (!array_key_exists('path', $request->all()) || file_exists($request->all()['path'])) {
            abort(400);
        } else {
            return response()->json($this->manager->mkdir($request->all()['path']));
        }
    }

    public function mkfile(Request $request) {
        if (!array_key_exists('path', $request->all()) || file_exists($request->all()['path'])) {
            abort(400);
        } else {
            return response()->json($this->manager->mkfile($request->all()['path']));
        }
    }

    public function upload(Request $request) {
        if ($request->hasFile('upload')) {
            return response()->json($this->manager->upload($request->file('upload'), $request->all()['path']));
        } else {
            abort(400);
        }
    }
}
