<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class FileController extends Controller
{
    const UPLOAD_DIR = 'files';

    public function show()
    {
        return view('file.upload-file-form');
    }

    public function store(Request $request)
    {
        $file = $request->file('file');

        if (!$file->isValid()) {
            throw new UnprocessableEntityHttpException('Something went wrong: ' . $file->getErrorMessage());
        }

        $storeFileName = time() . '_' . $file->getClientOriginalName();
        $path          = $file->storeAs(self::UPLOAD_DIR, $storeFileName, 'public');
        $url           = Storage::disk('public')->url($path);

        $file = new File([
            'file_name'       => $file->getClientOriginalName(),
            'store_path'      => storage_path() . '/' . self::UPLOAD_DIR,
            'store_file_name' => $storeFileName,
            'mime_type'       => $file->getMimeType(),
            'size'            => $file->getSize(),
            'disk'            => 'public',
            'url'             => $url,
            'is_public'       => true,
        ]);
        $file->save();

        return redirect('/');
    }

    public function list()
    {
        $files = File::query()->get();

        return view('file.list', [
            'files' => $files
        ]);
    }
}
