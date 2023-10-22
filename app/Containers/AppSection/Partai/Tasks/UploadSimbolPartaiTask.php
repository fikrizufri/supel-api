<?php

namespace App\Containers\AppSection\Partai\Tasks;


use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadSimbolPartaiTask extends ParentTask
{
  public function run(UploadedFile $profilePic): array
  {
    $result = [];

    $path = 'storage';

    $profilePicFileName = 'partai' . time() . '.' . $profilePic->getClientOriginalExtension();


    if (Storage::disk('public_storage')->putFileAs($path, $profilePic, $profilePicFileName)) {
      $result = [
        'simbol' => $profilePicFileName,
        'fullPath' => $path . '/' . $profilePicFileName
      ];
    }

    return $result;
  }
}
