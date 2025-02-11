<?php

namespace App\Models;

use CodeIgniter\Model;

class KeluhanModel extends Model
{
    protected $table = 'tb_keluhan';
    protected $primaryKey = 'id_keluhan';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $protectFields = true;
    protected $allowedFields = ['nama_pengajuan', 'id_pegawai', 'id_perangkat', 'keterangan', 'id_gi', 'tanggal_mulai', 'tanggal_monitoring', 'tanggal_selesai', 'status', 'foto', 'progress', 'foto_progress'];


    // join antara tb_keluhan, tb_pegawai, tb_perangkat, tb_gi 
    public function getKeluhan()
    {

        $idGi = session()->get('id_gi');


        $builder = $this->db->table('tb_keluhan');
        $builder->select('tb_keluhan.*, tb_pegawai.nama_pegawai, tb_perangkat.nama, tb_gi.nama_gi');
        $builder->join('tb_pegawai', 'tb_pegawai.id = tb_keluhan.id_pegawai');
        $builder->join('tb_perangkat', 'tb_perangkat.id = tb_keluhan.id_perangkat');
        $builder->join('tb_gi', 'tb_gi.id = tb_keluhan.id_gi');
        // where status diajukan
        $builder->where('tb_keluhan.status', 'Belum Diajukan');

        $builder->where('tb_keluhan.id_gi', $idGi);


        return $builder->get()->getResultArray();
    }

    public function jumlah_keluhan()
    {
        $idGi = session()->get('id_gi');

        $builder = $this->db->table('tb_keluhan');
        $builder->select('COUNT(id_keluhan) as jumlah_keluhan');
        $builder->where('id_gi', $idGi);
        return $builder->get()->getResultArray();
    }

    public function getKeluhanById($id)
    {

        $idGi = session()->get('id_gi');


        $builder = $this->db->table('tb_keluhan');
        $builder->select('tb_keluhan.*, tb_pegawai.nama_pegawai, tb_perangkat.nama, tb_gi.nama_gi');
        $builder->join('tb_pegawai', 'tb_pegawai.id = tb_keluhan.id_pegawai');
        $builder->join('tb_perangkat', 'tb_perangkat.id = tb_keluhan.id_perangkat');
        $builder->join('tb_gi', 'tb_gi.id = tb_keluhan.id_gi');
        $builder->where('tb_keluhan.id_keluhan', $id);
        $builder->where('tb_keluhan.id_gi', $idGi);

        return $builder->get()->getRowArray();
    }

    public function getKeluhanHistory()
    {
        $idGi = session()->get('id_gi');

        $builder = $this->db->table('tb_keluhan');
        $builder->select('tb_keluhan.*, tb_pegawai.nama_pegawai, tb_perangkat.nama, tb_gi.nama_gi');
        $builder->join('tb_pegawai', 'tb_pegawai.id = tb_keluhan.id_pegawai');
        $builder->join('tb_perangkat', 'tb_perangkat.id = tb_keluhan.id_perangkat');
        $builder->join('tb_gi', 'tb_gi.id = tb_keluhan.id_gi');

        // Filter berdasarkan id_gi dari session dan status keluhan
        $builder->where('tb_keluhan.id_gi', $idGi);
        $builder->groupStart()
            ->where('tb_keluhan.status', 'On Process')
            ->orWhere('tb_keluhan.status', 'Diajukan')
            ->orWhere('tb_keluhan.status', 'Selesai')
            ->groupEnd();

        return $builder->get()->getResultArray();
    }


    public function getMonitoringKeluhan()
    {
        $builder = $this->db->table('tb_keluhan');
        $builder->select('tb_keluhan.*, tb_pegawai.nama_pegawai, tb_perangkat.nama, tb_gi.nama_gi');
        $builder->join('tb_pegawai', 'tb_pegawai.id = tb_keluhan.id_pegawai');
        $builder->join('tb_perangkat', 'tb_perangkat.id = tb_keluhan.id_perangkat');
        $builder->join('tb_gi', 'tb_gi.id = tb_keluhan.id_gi');
        // where status diajukan
        $builder->where('tb_keluhan.status', 'Diajukan');
        return $builder->get()->getResultArray();
    }

    public function getLihatMonitoring()
    {
        $builder = $this->db->table('tb_keluhan');
        $builder->select('tb_keluhan.*, tb_pegawai.nama_pegawai, tb_perangkat.nama, tb_gi.nama_gi');
        $builder->join('tb_pegawai', 'tb_pegawai.id = tb_keluhan.id_pegawai');
        $builder->join('tb_perangkat', 'tb_perangkat.id = tb_keluhan.id_perangkat');
        $builder->join('tb_gi', 'tb_gi.id = tb_keluhan.id_gi');
        // where status diajukan
        $builder->where('tb_keluhan.status', 'On Process');
        $builder->orWhere('tb_keluhan.status', 'Selesai');

        return $builder->get()->getResultArray();
    }

    public function getKeluhanStatusSelesai()
    {
        $builder = $this->db->table('tb_keluhan');
        $builder->select('tb_keluhan.*, tb_pegawai.nama_pegawai, tb_perangkat.nama, tb_gi.nama_gi');
        $builder->join('tb_pegawai', 'tb_pegawai.id = tb_keluhan.id_pegawai');
        $builder->join('tb_perangkat', 'tb_perangkat.id = tb_keluhan.id_perangkat');
        $builder->join('tb_gi', 'tb_gi.id = tb_keluhan.id_gi');
        // where status diajukan
        $builder->where('tb_keluhan.status', 'Selesai');
        return $builder->get()->getResultArray();
    }


}
