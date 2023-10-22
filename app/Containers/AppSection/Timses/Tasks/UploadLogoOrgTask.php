<?php

namespace App\Containers\AppSection\Timses\Tasks;


use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadLogoOrgTask extends ParentTask
{
  public function run(UploadedFile $profilePic): array
  {
    $result = [];

    $path = 'storage';

    $profilePicFileName = 'logo-org-' . time() . '.' . $profilePic->getClientOriginalExtension();

    if (Storage::disk('public_storage')->putFileAs($path, $profilePic, $profilePicFileName)) {
      $result = [
        'image' => $profilePicFileName,
        'fullPath' => $path . '/' . $profilePicFileName
      ];
    }

    return $result;
  }
}
