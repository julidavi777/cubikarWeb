<?php
namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait SaveFile{

    protected function saveFile($file, $name_folder){
         $dt = Carbon::now();
 
         $hash = $file->hashName();
 
         $photo_url = $file->storeAs('public/files/'.$name_folder.'/'.$dt->toDateString(),'time_'.$dt->format('h_i_s').'_'.  $hash);
 
         $urls = array(
             "server_hash_name" => $photo_url,
             "original_name" => $file->getClientOriginalName()
         );
 
         return $urls;
     }

    protected function saveFileBase64($fileB64, $directory = "uploads"){
        $dt = Carbon::now();

        $base64_file = $fileB64;

        
        // Get the file extension
        $extension = '';
        if (strpos($base64_file, 'data:image/jpeg;base64') === 0) {
            $extension = 'jpg';
        } elseif (strpos($base64_file, 'data:image/png;base64') === 0) {
            $extension = 'png';
        } elseif (strpos($base64_file, 'data:image/gif;base64') === 0) {
            $extension = 'gif';
        } elseif (strpos($base64_file, 'data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64') === 0) {
            $extension = 'xlsx';
        } elseif (strpos($base64_file, 'data:application/pdf;base64') === 0) {
            $extension = 'pdf';
        } elseif (strpos($base64_file, 'data:image/jpeg;base64') === 0) {
            $extension = 'jpeg';
        } elseif (strpos($base64_file, 'data:application/vnd.openxmlformats-officedocument.wordprocessingml.document;base64') === 0) {
            $extension = 'docx';
        }

        $data = substr($base64_file, strpos($base64_file, ',') + 1);

        if($extension == ''){
            return response()->json([
                "error" => "invalid file extension"
            ], 422);
        }
        //Storage::disk('public')->put("myFile.".$extension, base64_decode($data));
        $fileId = Str::uuid()->toString();

        $fileName = "files/".$directory."/".$dt->toDateString()."/".$fileId.".".$extension;
        Storage::disk('public')->put($fileName, base64_decode($data));

        $dt = Carbon::now();

        $fileUrl = Storage::disk('public')->url("files/".$directory."/".$fileName.".".$extension);
        
        $host = parse_url($fileUrl, PHP_URL_HOST);
        $fileNameWithoutHost = Str::after($fileUrl, $host);
        $fileNameWithoutHost = str_replace("/storage", "public", $fileNameWithoutHost);
        
        
        $urls = array(
            "server_hash_name" => $fileNameWithoutHost
        );

        return $urls;
    }
}