<?php

namespace App\Containers\AppSection\Note\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Note\Actions\CreateNoteAction;
use App\Containers\AppSection\Note\Actions\DeleteNoteAction;
use App\Containers\AppSection\Note\Actions\FindNoteByIdAction;
use App\Containers\AppSection\Note\Actions\GetAllNotesAction;
use App\Containers\AppSection\Note\Actions\UpdateNoteAction;
use App\Containers\AppSection\Note\UI\API\Requests\CreateNoteRequest;
use App\Containers\AppSection\Note\UI\API\Requests\DeleteNoteRequest;
use App\Containers\AppSection\Note\UI\API\Requests\FindNoteByIdRequest;
use App\Containers\AppSection\Note\UI\API\Requests\GetAllNotesRequest;
use App\Containers\AppSection\Note\UI\API\Requests\UpdateNoteRequest;
use App\Containers\AppSection\Note\UI\API\Transformers\NoteTransformer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Prettus\Repository\Exceptions\RepositoryException;

class Controller extends ApiController
{
    /**
     * @param CreateNoteRequest $request
     * @return JsonResponse
     * @throws InvalidTransformerException
     * @throws CreateResourceFailedException
     */
    public function createNote(CreateNoteRequest $request): JsonResponse
    {
        $note = app(CreateNoteAction::class)->run($request);

        return $this->created($this->transform($note, NoteTransformer::class));
    }

    /**
     * @param FindNoteByIdRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws NotFoundException
     */
    public function findNoteById(FindNoteByIdRequest $request): array
    {
        $note = app(FindNoteByIdAction::class)->run($request);

        return $this->transform($note, NoteTransformer::class);
    }

    /**
     * @param GetAllNotesRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function getAllNotes(GetAllNotesRequest $request): array
    {
        $notes = app(GetAllNotesAction::class)->run($request);

        return $this->transform($notes, NoteTransformer::class);
    }

    /**
     * @param UpdateNoteRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws UpdateResourceFailedException
     */
    public function updateNote(UpdateNoteRequest $request): array
    {
        $note = app(UpdateNoteAction::class)->run($request);

        return $this->transform($note, NoteTransformer::class);
    }

    /**
     * @param DeleteNoteRequest $request
     * @return JsonResponse
     * @throws DeleteResourceFailedException
     */
    public function deleteNote(DeleteNoteRequest $request): JsonResponse
    {
        app(DeleteNoteAction::class)->run($request);

        return $this->noContent();
    }
}
