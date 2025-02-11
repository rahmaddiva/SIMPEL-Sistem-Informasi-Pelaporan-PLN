<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tb_user';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['nama', 'password', 'username', 'hak', 'id_gi'];


    public function getUser()
    {
        $builder = $this->db->table('tb_user');
        $builder->select('tb_user.*, tb_gi.nama_gi, tb_gi.lokasi');
        $builder->join('tb_gi', 'tb_gi.id = tb_user.id_gi');
        return $builder->get()->getResultArray();
    }

}
