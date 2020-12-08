<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Tools\ImageLog;
use Illuminate\Http\Response;

class UploadController extends Controller
{

    public function index ()
    {
        dd('test');
    }

    public function PostBlogImageUpload (Request $request) {
        $save_path = 'public/images/blog/';
        foreach ($request->file('image') as $file) {
            $name = $file->getClientOriginalName();
            $name = str_replace(array('(',')','[',']'),'',$name);
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
            $image_log = new ImageLog();
            $image_log->url = $url;
            $image_log->name = $name;
            $image_log->md5_name = $md5_name;
            $image_log->save();
        }

        return json_encode($results);
    }

    public function PostBlogFileUpload (Request $request) {
        $save_path = 'public/files/blog/';

        foreach ($request->file('file') as $file) {
            $name = $file->getClientOriginalName();
            $name = str_replace(array('(',')','[',']'),'',$name);
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
            $image_log = new ImageLog();
            $image_log->url = $url;
            $image_log->name = $name;
            $image_log->md5_name = $md5_name;
            $image_log->save();

        return json_encode($results);
    }
}
