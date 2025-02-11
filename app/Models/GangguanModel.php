<?php

namespace App\Models;

use CodeIgniter\Model;

class GangguanModel extends Model
{
    protected $table = 'tb_pengajuan';
    protected $primaryKey = 'id_gangguan';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['tanggal_mulai', 'tanggal_progress', 'tanggal_selesai', 'id_pegawai', 'id_perangkat', 'deskripsi', 'keterangan', 'id_gi', 'foto', 'lat', 'lng', 'status', 'progress', 'foto_progress', 'kategori_gangguan'];


    public function getGangguan()
    {

        // session id_gi

        $idGi = session()->get('id_gi');

        $builder = $this->db->table('tb_pengajuan');
        $builder->select('tb_pengajuan.*, tb_pegawai.nama_pegawai, tb_pegawai.nip, tb_gi.nama_gi, tb_perangkat.nama');
        $builder->join('tb_pegawai', 'tb_pengajuan.id_pegawai = tb_pegawai.id');
        $builder->join('tb_perangkat', 'tb_pengajuan.id_perangkat = tb_perangkat.id');
        $builder->join('tb_gi', 'tb_pengajuan.id_gi = tb_gi.id');
        // where status diajukan
        $builder->where('tb_pengajuan.status', 'Belum Diajukan');

        $builder->where('tb_pengajuan.id_gi', $idGi);

        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getJumlahGangguan()
    {
        $idGi = session()->get('id_gi');

        $builder = $this->db->table('tb_pengajuan');
        $builder->select('COUNT(id_gangguan) as jumlah_gangguan');
        $builder->where('id_gi', $idGi);
        return $builder->get()->getRowArray();
    }


    public function getHistoryGangguan()
    {
        $idGi = session()->get('id_gi');

        $builder = $this->db->table('tb_pengajuan');
        $builder->select('tb_pengajuan.*, tb_pegawai.nama_pegawai, tb_pegawai.nip, tb_gi.nama_gi, tb_perangkat.nama');
        $builder->join('tb_pegawai', 'tb_pengajuan.id_pegawai = tb_pegawai.id');
        $builder->join('tb_perangkat', 'tb_pengajuan.id_perangkat = tb_perangkat.id');
        $builder->join('tb_gi', 'tb_pengajuan.id_gi = tb_gi.id');


        $builder->where('tb_pengajuan.id_gi', $idGi);
        $builder->groupStart()
            ->where('tb_pengajuan.status', 'On Process')
            ->orWhere('tb_pengajuan.status', 'Diajukan')
            ->orWhere('tb_pengajuan.status', 'Selesai')
            ->groupEnd();

        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getGangguanById($id)
    {
        $idGi = session()->get('id_gi');

        $builder = $this->db->table('tb_pengajuan');
        $builder->select('tb_pengajuan.*, tb_pegawai.nama_pegawai, tb_perangkat.nama, tb_pegawai.nip, tb_perangkat.nama, tb_gi.nama_gi');
        $builder->join('tb_pegawai', 'tb_pengajuan.id_pegawai = tb_pegawai.id');
        $builder->join('tb_perangkat', 'tb_pengajuan.id_perangkat = tb_perangkat.id');
        $builder->join('tb_gi', 'tb_pengajuan.id_gi = tb_gi.id');
        $builder->where('tb_pengajuan.id_gangguan', $id);

        $builder->where('tb_pengajuan.id_gi', $idGi);

        return $builder->get()->getRowArray();
    }

    public function getMonitoringGangguan()
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->select('tb_pengajuan.*, tb_pegawai.nama_pegawai, tb_perangkat.nama, tb_pegawai.nip, tb_perangkat.nama, tb_gi.nama_gi');
        $builder->join('tb_pegawai', 'tb_pengajuan.id_pegawai = tb_pegawai.id');
        $builder->join('tb_perangkat', 'tb_pengajuan.id_perangkat = tb_perangkat.id');
        $builder->join('tb_gi', 'tb_pengajuan.id_gi = tb_gi.id');
        // where status diajukan
        $builder->where('tb_pengajuan.status', 'Diajukan');

        return $builder->get()->getResultArray();
    }

    public function getLihatMonitoring()
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->select('tb_pengajuan.*, tb_pegawai.nama_pegawai, tb_perangkat.nama, tb_gi.nama_gi');
        $builder->join('tb_pegawai', 'tb_pengajuan.id_pegawai = tb_pegawai.id');
        $builder->join('tb_perangkat', 'tb_pengajuan.id_perangkat = tb_perangkat.id');
        $builder->join('tb_gi', 'tb_pengajuan.id_gi = tb_gi.id');
        // where status diajukan
        $builder->where('tb_pengajuan.status', 'On Process');
        $builder->orWhere('tb_pengajuan.status', 'Selesai');

        return $builder->get()->getResultArray();
    }

    public function getGangguanStatusSelesai()
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->select('tb_pengajuan.*, tb_pegawai.nama_pegawai, tb_pegawai.nip, tb_perangkat.nama, tb_gi.nama_gi');
        $builder->join('tb_pegawai', 'tb_pengajuan.id_pegawai = tb_pegawai.id');
        $builder->join('tb_perangkat', 'tb_pengajuan.id_perangkat = tb_perangkat.id');
        $builder->join('tb_gi', 'tb_pengajuan.id_gi = tb_gi.id');
        // where status diajukan
        $builder->where('tb_pengajuan.status', 'Selesai');

        return $builder->get()->getResultArray();
    }

}
