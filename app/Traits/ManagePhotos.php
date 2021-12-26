<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait ManagePhotos
{

    public function StorePhotoProfile($request): string
    {

        $file = $request->file('photo');
        $name = time() . "_" . $file->getClientOriginalName();
        Storage::disk('public')->put('photosProfile/' . $name, File::get($file));

        return $name;
    }

    public function UpdatePhotoProfile($request, $user): string
    {

        $file = $request->file('photo');
        $name = time()."_".$file->getClientOriginalName();
        File::delete(public_path('storage/photosProfile/'.$user->photo));
        Storage::disk('public')->put('photosProfile/'.$name, File::get($file));

        return $name;
    }
}
