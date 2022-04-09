<?php

namespace App\Models;

use CodeIgniter\Model;

class penjualModel extends Model
{
    protected $table = 'tbl_penjual';
    protected $primaryKey = 'id_penjual';
    protected $useTimestamp = true;
    protected $allowedFields = ['id_user', 'nama', 'created_at', 'updated_at'];
}
