<?php

namespace App\Containers\AppSection\Campaign\Tasks;


use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadKTPTask extends ParentTask
{
  public function run(UploadedFile $profilePic): array
  {
    $result = [];

    $path = 'storage';

    $profilePicFileName = 'ktp-' . time() . '.' . $profilePic->getClientOriginalExtension();


    if (Storage::disk('public_storage')->putFileAs($path, $profilePic, $profilePicFileName)) {
      $result = [
        'image' => $profilePicFileName,
        'fullPath' => $path . '/' . $profilePicFileName
      ];
    }

    return $result;
  }
}
