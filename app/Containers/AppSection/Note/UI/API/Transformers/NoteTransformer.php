<?php

namespace App\Containers\AppSection\Note\UI\API\Transformers;

use App\Containers\AppSection\Note\Models\Note;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class NoteTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(Note $note): array
    {
        $response = [
            'object' => $note->getResourceKey(),
            'id' => $note->getHashedKey(),
            'user_id' => $note->user_id,
            'proses' => $note->proses,
            'ket' => $note->ket
        ];

        return $this->ifAdmin([
            'real_id' => $note->id,
            'created_at' => $note->created_at,
            'updated_at' => $note->updated_at,
            'readable_created_at' => $note->created_at->diffForHumans(),
            'readable_updated_at' => $note->updated_at->diffForHumans(),
            // 'deleted_at' => $note->deleted_at,
        ], $response);
    }
}
