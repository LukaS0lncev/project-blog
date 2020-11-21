<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function PostBlogImageUpload (Request $request) {
        $save_path = 'public/images/blog/';
        foreach ($request->file('image') as $file) {
            $name = $file->getClientOriginalName();
            $md5_name = mb_strimwidth(md5_file($file->getRealPath()), 0, 6);
            $md5_name_array = str_split($md5_name, 3);
            foreach ($md5_name_array as $path_name){
                if($path_name == end($md5_name_array)) {
                    $save_path .= $path_name;
                }
                else {
                    $save_path .= $path_name.'/';
                }
            }

            $url = Storage::url($file->storeAs($save_path , $name));


            $results[] = array(
                'url' => $url,
                'name' => $name,
                'md5_name' => $md5_name
            );
        }

        return json_encode($results);
    }

    public function PostBlogImageUploadPaste (Request $request) {
        $save_path = 'public/images/blog/';
        $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $md5_name = mb_strimwidth(md5_file($file->getRealPath()), 0, 6);
            $md5_name_array = str_split($md5_name, 3);
            foreach ($md5_name_array as $path_name){
                if($path_name == end($md5_name_array)) {
                    $save_path .= $path_name;
                }
                else {
                    $save_path .= $path_name.'/';
                }
            }

            $url = Storage::url($file->storeAs($save_path , $name));


            $results = array(
                'url' => $url,
                'name' => $name,
                'md5_name' => $md5_name
            );

        return json_encode($results);
    }
}
