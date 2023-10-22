<?php

namespace App\Containers\AppSection\Partai\UI\API\Transformers;

use App\Containers\AppSection\Partai\Models\Partai;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class PartaiTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(Partai $partai): array
    {
        $response = [
            'object' => $partai->getResourceKey(),
            'id' => $partai->getHashedKey(),
            'real_id' => $partai->id,
            'nomer_urut' => (int)$partai->nomer_urut,
            'name' => $partai->name,
            'simbol' => $partai->simbol,
            'slogan' => $partai->slogan,
            'alamat' => $partai->alamat,
            'email' => $partai->email,
            'warna' => $partai->warna,
            'is_client' => (int)$partai->is_client,
        ];

        return $this->ifAdmin([
            'created_at' => $partai->created_at,
            'updated_at' => $partai->updated_at,
            'readable_created_at' => $partai->created_at->diffForHumans(),
            'readable_updated_at' => $partai->updated_at->diffForHumans(),
            // 'deleted_at' => $partai->deleted_at,
        ], $response);
    }
}
