<?php

use App\Containers\AppSection\Area\Tasks\FindAreaByIdTask;

function get_nama_wilayah($kode)
{
    $area = app(FindAreaByIdTask::class)->run($kode);
    if ($area) {
        return $area ? $area->nama : '';
    }
    return null;
}

function get_group_kandidat_name($id)
{
    $data = \App\Containers\AppSection\Group\Models\Group::find($id);
    return $data ? $data->group_name : '';
}

function get_group_name($id)
{
    $data = \App\Containers\AppSection\Campaign\Models\GroupCampaign::find($id);
    return $data ? $data->name : '';
}

function get_subgroup_name($id)
{
    $data = \App\Containers\AppSection\Campaign\Models\SubGroupCampaign::find($id);
    return $data ? $data->name : '';
}

function get_subgroup_kode($id)
{
    $data = \App\Containers\AppSection\Campaign\Models\SubGroupCampaign::find($id);
    return $data ? $data->kode : '';
}

function get_partai_name($id)
{
    $data = \App\Containers\AppSection\Partai\Models\Partai::find($id);
    return $data ? $data->name : '';
}

function get_dapil_name($id)
{
    $data = \App\Containers\AppSection\Campaign\Models\DapilCampaign::find($id);
    return $data ? $data->name : '';
}
