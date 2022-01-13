<?php


namespace App\Services;


use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class RoomUploadImages
{
    public function upload(Request $request): bool {
        try {
            $fileNameWithExt = $request->file('room_image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('room_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $request->file('room_image')->storeAs('public/image',$fileNameToStore);
            return true;
        } catch (FileException $exception) {
            return false;
        }
    }
}
