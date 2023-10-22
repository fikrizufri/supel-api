<?php

namespace App\Containers\AppSection\Voter\Data\Criterias;

use App\Containers\AppSection\Area\Models\Area;
use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class SelectCriteria extends Criteria
{
    protected $request;
    public function __construct($request)
    {
        $this->request = $request;
    }
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        $request = $this->request;

        if ($request->get('nkk') != null) {
            $model = $model->where('nkk', $request->get('nkk'));
        }
        if ($request->get('nik') != null) {
            $model = $model->orWhere('nik', $request->get('nik'));
        }
        if ($request->get('name') != null) {
            $model = $model->orWhere('name', $request->get('name'));
        }
        if ($request->get('tempat_lahir') != null) {
            $model = $model->orWhere('tempat_lahir', $request->get('tempat_lahir'));
        }
        if ($request->get('tanggal_lahir') != null) {
            $model = $model->orWhere('tanggal_lahir', $request->get('tanggal_lahir'));
        }
        if ($request->get('kawin') != null) {
            $model = $model->orWhere('kawin', $request->get('kawin'));
        }
        if ($request->get('alamat') != null) {
            $model = $model->orWhere('alamat', $request->get('alamat'));
        }
        if ($request->get('jenis_kelamin') != null) {
            $model = $model->orWhere('jenis_kelamin', $request->get('jenis_kelamin'));
        }
        if ($request->get('rt') != null) {
            $model = $model->orWhere('rt', $request->get('rt'));
        }
        if ($request->get('rw') != null) {
            $model = $model->orWhere('rw', $request->get('rw'));
        }
        if ($request->get('difabel') != null) {
            $model = $model->orWhere('difabel', $request->get('difabel'));
        }
        if ($request->get('tps') != null) {
            $model = $model->where('tps', $request->get('tps'));
        }
        if ($request->get('group_id') != null) {
            $model = $model->orWhere('group_id', $request->get('group_id'));
        }
        if ($request->get('kode_provinsi') != null) {
            $model = $model->orWhere('kode_provinsi', $request->get('kode_provinsi'));
        }
        if ($request->get('nama_provinsi') != null) {
            $nama_provinsi = $request->get('nama_provinsi');
            $wilayah = Area::where('nama', 'like', '%' . $nama_provinsi . "%")->pluck('kode');

            $model = $model->where(function ($query) use ($wilayah) {
                $query->whereIn('kode_provinsi', $wilayah);
            });
        }
        if ($request->get('kode_kabupaten') != null) {
            $model = $model->orWhere('kode_kabupaten', $request->get('kode_kabupaten'));
        }
        if ($request->get('nama_kabupaten') != null) {
            $nama_kabupaten = $request->get('nama_kabupaten');
            $wilayah = Area::where('nama', 'like', '%' . $nama_kabupaten . "%")->pluck('kode');

            $model = $model->where(function ($query) use ($wilayah) {
                $query->whereIn('kode_kabupaten', $wilayah);
            });
        }

        if ($request->get('kode_kecamatan') != null) {
            $model = $model->orWhere('kode_kecamatan', $request->get('kode_kecamatan'));
        }
        if ($request->get('nama_kecamatan') != null) {
            $nama_kecamatan = $request->get('nama_kecamatan');
            $wilayah = Area::where('nama', 'like', '%' . $nama_kecamatan . "%")->pluck('kode');

            $model = $model->where(function ($query) use ($wilayah) {
                $query->whereIn('kode_kecamatan', $wilayah);
            });
        }

        if ($request->get('kode_desa') != null) {
            $model = $model->orWhere('kode_desa', $request->get('kode_desa'));
        }
        if ($request->get('nama_desa') != null) {
            $nama_desa = $request->get('nama_desa');
            $wilayah = Area::where('nama', 'like', '%' . $nama_desa . "%")->pluck('kode');

            $model = $model->where(function ($query) use ($wilayah) {
                $query->whereIn('kode_desa', $wilayah);
            });
        }
        if ($request->get('umur') != null) {
            $model = $model->orWhere('umur', $request->get('umur'));
        }

        if ($request->get('awal_umur') && $request->get('akhir_umur')) {
            $awal_umur = $request->get('awal_umur');
            $akhir_umur = $request->get('akhir_umur');
            $model = $model->orWhere(function ($query) use ($awal_umur, $akhir_umur) {
                $query->whereRaw('CAST(`umur` AS SIGNED) BETWEEN ? AND ?', [(int) $awal_umur, (int) $akhir_umur]);
            });
        }

        if ($request->cari != null) {
            $model = $model->orWhere('name', "like", "%" . $request->get('cari') . "%")
                ->orWhere('nkk', "like", "%" . $request->get('cari') . "%")
                ->orWhere('nik', "like", "%" . $request->get('cari') . "%")
                ->orWhere('tempat_lahir', "like", "%" . $request->get('cari') . "%")
                ->orWhere('tanggal_lahir', "like", "%" . $request->get('cari') . "%")
                ->orWhere('kawin', "like", "%" . $request->get('cari') . "%")
                ->orWhere('alamat', "like", "%" . $request->get('cari') . "%")
                ->orWhere('rt', "like", "%" . $request->get('cari') . "%")
                ->orWhere('rw', "like", "%" . $request->get('cari') . "%")
                ->orWhere('difabel', "like", "%" . $request->get('cari') . "%")
                ->orWhere('group_id', "like", "%" . $request->get('cari') . "%")
                ->orWhere('tps', "like", "%" . $request->get('cari') . "%")
                ->orWhere('kode_provinsi', "like", "%" . $request->get('cari') . "%")
                ->orWhere('kode_kabupaten', "like", "%" . $request->get('cari') . "%")
                ->orWhere('kode_kecamatan', "like", "%" . $request->get('cari') . "%")
                ->orWhere('kode_desa', "like", "%" . $request->get('cari') . "%")
            ;
        }

        // dd($model->toSql());
        return $model;

    }
}