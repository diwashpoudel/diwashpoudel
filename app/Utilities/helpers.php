<?php 
    use Illuminate\Support\Facades\File;
    use Intervention\Image\Facades\Image;


    function uploadImage($image,$path,$thumb=null)
    {
        $dir = public_path('uploads/'.$path);
        if(!File::exists($dir))
        {
            File::makeDirectory($dir,777,true,true);
        }
        $name =ucfirst(strtolower($path))."-".date('YmdHis').rand(0,999999).".".$image->getClientOriginalExtension();
        $status = $image->move($dir, $name);
        if($status)
        {
            if($thumb !== null)
            {
                list($width,$height)= explode('x',$thumb);
                Image::make($dir.'/'.$name)->resize($width,$height,function($constraint){

                            return $constraint->aspectRatio();
                })->save($dir.'/'.$name);
            }
                    return $name;
        }else {
            return null;
        }

    }


    function deleteImage($image_name, $dir)
    {
        $path = public_path('uploads/'.$dir);
        if($image_name != null && file_exists($path.'/'.$image_name))
        {
            unlink($path.'/'.$image_name);
        }

    }