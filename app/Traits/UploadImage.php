<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait  UploadImage
{
    // one image

    public static function upload($request, $model, $file_name, $folder)
    {

        if ($request->file($file_name)) {
            $old_path = $model->$file_name;
            File::delete(public_path($old_path));
            $file = $request->file($file_name);
            $filename = Str::uuid().$file->getClientOriginalName();
            $file->move(public_path($folder), $filename);

            $path = $folder.'/'.$filename;
            $model->update([$file_name => $path]);

            $request->my_file->store('uploads');
        }

    }


}
