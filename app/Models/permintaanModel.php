<?php

namespace App\Models;

use CodeIgniter\Model;
use LDAP\Result;

class permintaanModel extends Model
{
    protected $table = 'tbl_permintaan';
    protected $primaryKey = 'id_permintaan';
    protected $useTimestamp = true;
    protected $allowedFields = ['id_penjual', 'bulan', 'frekuensi', 'created_at', 'updated_at'];

    public function getdatapenjual($id)
    {
        $total_frekuensi = 0;
        $probabilitas_kumulatif = 0;
        $jumlahdata = array();
        $total_hasil_permintaan = 0;
        $rata_rata_hasil_permintaan = 0;
        $data = $this->select('tbl_permintaan.id_permintaan as permintaan')
            ->join('tbl_penjual', 'tbl_permintaan.id_penjual = tbl_penjual.id_penjual')
            ->where('tbl_permintaan.id_penjual', $id)
            ->groupBy('tbl_permintaan.bulan')
            ->findAll();
        foreach ($data as $d) {
            $result['datanya'][$d['permintaan']] = [
                'permintaan' => $d['permintaan'],
                'bulan' => 0,
                'frekuensi' => 0,
                'probabilitas' => 0,
                'probabilitas_kumulatif' => 0,
                'interval_bawah' => 0,
                'interval_atas' => 0,
            ];
        }

        //banyak bulan
        $data = $this->select('tbl_permintaan.id_permintaan as permintaan, tbl_permintaan.bulan as bulan')
            ->join('tbl_penjual', 'tbl_permintaan.id_penjual = tbl_penjual.id_penjual')
            ->where('tbl_permintaan.id_penjual', $id)
            ->groupBy('tbl_permintaan.bulan')
            ->findAll();
        foreach ($data as $d) {
            $result['datanya'][$d['permintaan']]['bulan'] = $d['bulan'];
        }

        //banyak frekuensi
        $data = $this->select('tbl_permintaan.id_permintaan as permintaan, tbl_permintaan.frekuensi as frekuensi')
            ->selectSum('tbl_permintaan.frekuensi')
            ->join('tbl_penjual', 'tbl_permintaan.id_penjual = tbl_penjual.id_penjual')
            ->where('tbl_permintaan.id_penjual', $id)
            ->groupBy('tbl_permintaan.bulan')
            ->findAll();
        foreach ($data as $d) {
            $result['datanya'][$d['permintaan']]['frekuensi'] = $d['frekuensi'];
            $total_frekuensi += $d['frekuensi'];
        }
        //banyak probabilitas
        $data = $this->select('tbl_permintaan.id_permintaan as permintaan, tbl_permintaan.bulan as bulan, tbl_permintaan.frekuensi as frekuensi')
            ->join('tbl_penjual', 'tbl_permintaan.id_penjual = tbl_penjual.id_penjual')
            ->where('tbl_permintaan.id_penjual', $id)
            ->groupBy('tbl_permintaan.bulan')
            ->findAll();
        foreach ($data as $d) {
            $result['datanya'][$d['permintaan']]['probabilitas'] = round($d['frekuensi'] / $total_frekuensi, 2);
        }

        //banyak probabilitas kumulatif
        $data = $this->select('tbl_permintaan.id_permintaan as permintaan, tbl_permintaan.bulan as bulan, tbl_permintaan.frekuensi as frekuensi')
            ->join('tbl_penjual', 'tbl_permintaan.id_penjual = tbl_penjual.id_penjual')
            ->where('tbl_permintaan.id_penjual', $id)
            ->groupBy('tbl_permintaan.bulan')
            ->findAll();

        foreach ($data as $d) {
            $probabilitas_kumulatif += $result['datanya'][$d['permintaan']]['probabilitas'];
            $result['datanya'][$d['permintaan']]['probabilitas_kumulatif'] = round($probabilitas_kumulatif, 2);
        }

        //interval bawah
        $data = $this->select('tbl_permintaan.id_permintaan as permintaan, tbl_permintaan.bulan as bulan, tbl_permintaan.frekuensi as frekuensi')
            ->join('tbl_penjual', 'tbl_permintaan.id_penjual = tbl_penjual.id_penjual')
            ->where('tbl_permintaan.id_penjual', $id)
            ->groupBy('tbl_permintaan.bulan')
            ->findAll();
        foreach ($data as $d) {
            $result['datanya'][$d['permintaan']]['interval_bawah'] = round($result['datanya'][$d['permintaan']]['probabilitas_kumulatif'] - $result['datanya'][$d['permintaan']]['probabilitas'], 2);
        }

        //interval atas
        $data = $this->select('tbl_permintaan.id_permintaan as permintaan, tbl_permintaan.bulan as bulan, tbl_permintaan.frekuensi as frekuensi')
            ->join('tbl_penjual', 'tbl_permintaan.id_penjual = tbl_penjual.id_penjual')
            ->where('tbl_permintaan.id_penjual', $id)
            ->groupBy('tbl_permintaan.bulan')
            ->findAll();
        foreach ($data as $d) {
            $result['datanya'][$d['permintaan']]['interval_atas'] = round($result['datanya'][$d['permintaan']]['probabilitas_kumulatif'], 2);
        }

        //membuat array jumlah datanya
        $data = $this->select('tbl_penjual.penaksiran')
            ->join('tbl_penjual', 'tbl_permintaan.id_penjual = tbl_penjual.id_penjual')
            ->where('tbl_permintaan.id_penjual', $id)
            ->groupBy('tbl_penjual.id_penjual')
            ->findAll();
        $jumlahdata = range(1, $data[0]['penaksiran']);
        foreach ($jumlahdata as $d) {
            $result['hasilnya'][$d] = [
                'penaksiran' => $d,
                'angka_acak' => 0,
                'hasil_permintaan' => 0,
            ];
        }
        //angka acaknyuak
        foreach ($jumlahdata as $d) {
            $result['hasilnya'][$d]['angka_acak'] = rand(0, 100) / 100;
        }

        //hasil permintaan
        foreach ($jumlahdata as $d) {
            foreach ($result['datanya'] as $datanya => $dalamnya) {
                if ($result['hasilnya'][$d]['angka_acak'] >= $dalamnya['interval_bawah'] && $result['hasilnya'][$d]['angka_acak'] < $dalamnya['interval_atas']) {
                    $result['hasilnya'][$d]['hasil_permintaan'] = $dalamnya['frekuensi'];
                }
            }
        }

        //hitung total hasil permintaan
        foreach ($jumlahdata as $d) {
            $total_hasil_permintaan += $result['hasilnya'][$d]['hasil_permintaan'];
        }
        $result['total_hasil_permintaan'] = $total_hasil_permintaan;

        //hitung rata-rata hasil permintaan
        foreach ($jumlahdata as $d) {
            $rata_rata_hasil_permintaan =  $result['total_hasil_permintaan'] / $d;
        }
        $result['rata_rata_hasil_permintaan'] = $rata_rata_hasil_permintaan;

        //hitung rata-rata pemasukan
        $data = $this->select('tbl_penjual.harga')
            ->join('tbl_penjual', 'tbl_permintaan.id_penjual = tbl_penjual.id_penjual')
            ->where('tbl_permintaan.id_penjual', $id)
            ->groupBy('tbl_penjual.id_penjual')
            ->findAll();
        $result['rata_rata_pemasukan'] = $result['rata_rata_hasil_permintaan'] * $data[0]['harga'];

        return $result;
    }

    public function hitungbulan($id)
    {
        $data = $this->selectcount('bulan')
            ->where('tbl_permintaan.id_penjual', $id)
            ->findAll();
        return $data;
    }
}
