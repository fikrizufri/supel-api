<?php

namespace App\Containers\AppSection\Capres\Tasks;


use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadImgCapresTask extends ParentTask
{
  public function run(UploadedFile $profilePic): array
  {
    $result = [];

    $path = 'storage';

    $profilePicFileName = 'capres' . time() . '.' . $profilePic->getClientOriginalExtension();


    if (Storage::disk('public_storage')->putFileAs($path, $profilePic, $profilePicFileName)) {
      $result = [
        'img' => $profilePicFileName,
        'fullPath' => $path . '/' . $profilePicFileName
      ];
    }

    return $result;
  }
}
