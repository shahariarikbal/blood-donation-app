<?php


namespace App\Upload;


use Illuminate\Support\Str;

trait FileuploadTrait
{
    public function userAvatarUpload($query)
    {
        $image_name = time();
        $ext = strtolower($query->getClientOriginalExtension()); // File original extension
        $image_full_name = $image_name.'.'.$ext;
        $upload_path = 'avatar/';
        $image_url = $upload_path.$image_full_name;
        $success = $query->move($upload_path, $image_full_name);
        return $image_url;
    }
}
