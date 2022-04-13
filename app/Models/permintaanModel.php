<?php

namespace App\Models;

use CodeIgniter\Model;

class permintaanModel extends Model
{
    protected $table = 'tbl_permintaan';
    protected $primaryKey = 'id_permintaan';
    protected $useTimestamp = true;
    protected $allowedFields = ['id_penjual', 'bulan', 'frekuensi', 'created_at', 'updated_at'];

    public function getdatapenjual($id)
    {
        $data = $this->select('*')
            ->join('tbl_penjual', 'tbl_permintaan.id_penjual = tbl_penjual.id_penjual')
            ->where('tbl_permintaan.id_penjual', $id)
            ->findAll();
        return $data;
    }

    public function hitungbulan($id)
    {
        $data = $this->selectcount('bulan')
            ->where('tbl_permintaan.id_penjual', $id)
            ->findAll();
        return $data;
    }
}
