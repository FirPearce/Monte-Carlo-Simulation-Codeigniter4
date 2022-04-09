<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'id_user';
    protected $useTimestamp = true;
    protected $allowedFields = ['username', 'password', 'created_at', 'updated_at'];
}
