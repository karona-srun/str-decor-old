<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function downloadFile(Request $request)
    {
        $replace = str_replace("%2F","/",$request->path);
        return Storage::download($replace);
        if (file_exists($replace)) {
            return Response::download($replace);
        }
    }

    public function deleteFile(Request $request)
    {
        $replace = str_replace("%2F","/",$request->path);
        Storage::delete($replace);
        return back();
    }
}
