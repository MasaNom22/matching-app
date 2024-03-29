<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\UploadImage;
use App\User;
use App\Http\Requests\UploadImageRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UploadImageController extends Controller
{
    public function show()
    {
        $user=Auth::user();
        $image = UploadImage::where('user_id', $user->id);
        return view("upload_form", [
            "user" => $user,
            "image" => $image,
            ]);
    }
    
    public function upload(UploadImageRequest $request)
    {
        $upload_image = $request->file('image');        

        if ($upload_image) {
            //アップロードされた画像を保存する
            $path = $upload_image->store('uploads', "public");
            //画像の保存に成功したらDBに記録する
            if ($path) {
                // UploadImage::create([
                $request->user()->uploadimages()->create([
                    "file_name" => $upload_image->getClientOriginalName(),
                    "file_path" => $path
                ]);
            }
        }
        
        
        return redirect("/");
    }
    
    public function destroy($id)
    {
        $deletePictures = UploadImage::find($id);
        $deleteName = $deletePictures->file_path;
        
        DB::beginTransaction();
        $deletePictures->delete();
        try {
            Storage::delete('public/' . $deleteName);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
        }
        return redirect("/");
    }
}
