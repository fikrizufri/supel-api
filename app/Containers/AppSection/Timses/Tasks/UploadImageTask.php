<?php

namespace App\Containers\AppSection\Timses\Tasks;


use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class UploadImageTask extends ParentTask
{
  public function run(UploadedFile $profilePic): array
  {

      $path = 'storage';

      $profilePicFileName = 'photo-card-' . time() . '.' . $profilePic->getClientOriginalExtension();

      $imageResize = Image::make($profilePic);
      $imageResize->orientate()
          ->fit(360, 600, function ($constraint) {
              $constraint->upsize();
          })
          ->save(public_path('/storage/' . $profilePicFileName));

      return  [
        'image' => $profilePicFileName,
        'fullPath' => $path . '/' . $profilePicFileName
      ];

  }
}
