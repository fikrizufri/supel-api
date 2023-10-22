<?php

namespace App\Containers\AppSection\Voter\Tasks;

use App\Containers\AppSection\Voter\Data\Criterias\VoterAreaCriteria;
use App\Containers\AppSection\Voter\Data\Repositories\VoterRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;

class GetVotersAreaTask extends ParentTask
{
    public function __construct(
        protected VoterRepository $repository
    ) {
    }


    public function run($request): mixed
    {
        if ($request->group){

            if($request->for === 'wilayah') {
                $this->repository->pushCriteria(new VoterAreaCriteria());
            }
            return $this->repository->findWhere(array('kode' => $request->group));
        }
        return $this->repository->all();
    }
}
