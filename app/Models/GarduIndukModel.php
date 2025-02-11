<?php

namespace App\Models;

use CodeIgniter\Model;

class GarduIndukModel extends Model
{
    protected $table = 'tb_gi';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $protectFields = true;
    protected $allowedFields = ['nama_gi', 'lokasi', 'lat', 'lng'];


    public function getGarduInduk()
    {
        return $this->findAll();
    }
}
