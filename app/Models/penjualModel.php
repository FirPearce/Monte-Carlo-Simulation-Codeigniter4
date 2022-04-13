<?php

namespace App\Models;

use CodeIgniter\Model;

class penjualModel extends Model
{
    protected $table = 'tbl_penjual';
    protected $primaryKey = 'id_penjual';
    protected $useTimestamp = true;
    protected $allowedFields = ['id_user', 'nama', 'penaksiran', 'harga', 'created_at', 'updated_at'];

    public function hargapenjual($id)
    {
        $data = $this->select('*')
            ->where('tbl_penjual.id_penjual', $id)
            ->find();
        return $data;
    }
}
