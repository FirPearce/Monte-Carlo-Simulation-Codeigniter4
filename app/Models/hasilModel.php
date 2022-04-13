<?php

namespace App\Models;

use CodeIgniter\Model;

class hasilModel extends Model
{
    protected $table = 'tbl_hasil';
    protected $primaryKey = 'id_hasil';
    protected $useTimestamp = true;
    protected $allowedFields = ['id_penjual', 'total_permintaan', 'rata_permintaan', 'rata_pemasukan', 'created_at', 'updated_at'];

    public function datahasil($id)
    {
        $data = $this->select('*')
            ->where('tbl_hasil.id_penjual', $id)
            ->find();
        return $data;
    }
}
