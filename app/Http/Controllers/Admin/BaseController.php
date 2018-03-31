<?php

namespace App\Http\Controllers\Admin;

use App\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function imageUpload($file)
    {
        $image_name = time() . $file->getClientOriginalName();
        $file->move('images', $image_name);
        $image = Image::create(['path' => $image_name]);
        $image_id = $image->id;
        return $image_id;
    }
}
