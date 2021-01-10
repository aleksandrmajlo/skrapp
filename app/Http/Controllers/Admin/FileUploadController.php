<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class FileUploadController extends Controller
{

    public function fileUploadExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx|max:10240',
        ]);

        /*
        $fileName = time().'.'.$request->file->extension();
        $request->file->move(public_path('uploads'), $fileName);
        return back()
            ->with('success','Файл загружен.')
            ->with('file',$fileName);
        */
    }

}
