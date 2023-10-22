<?php

namespace App\Containers\AppSection\Note\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Note\Models\Note;
use App\Containers\AppSection\Note\Tasks\CreateNoteTask;
use App\Containers\AppSection\Note\UI\API\Requests\CreateNoteRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class CreateNoteAction extends ParentAction
{
    /**
     * @param CreateNoteRequest $request
     * @return Note
     * @throws CreateResourceFailedException
     * @throws IncorrectIdException
     */
    public function run(CreateNoteRequest $request): Note
    {
       $data = $request->sanitizeInput([
            'user_id',
            'note',
            'proses',
            'ket',
            
        ]);

   
        return app(CreateNoteTask::class)->run($data);
    }
}
