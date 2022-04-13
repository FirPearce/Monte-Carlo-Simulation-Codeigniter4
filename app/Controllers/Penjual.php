<?php

namespace App\Controllers;

use App\Models\userModel;
use App\Models\penjualModel;
use App\Models\permintaanModel;

class Penjual extends BaseController
{
    public function __construct()
    {
        $this->userModel = new userModel();
        $this->penjualModel = new penjualModel();
        $this->session = \Config\Services::session();
        $this->permintaanModel = new permintaanModel();
    }

    public function index()
    {
        return view('User/Profile');
    }
    public function create()
    {
        $data['permintaan'] = $this->permintaanModel->getdatapenjual($this->session->get('id_penjual'));
        $data['harga'] = $this->penjualModel->hargapenjual($this->session->get('id_penjual'));
        $data['bulan'] = $this->permintaanModel->hitungbulan($this->session->get('id_penjual'));
        return view('User/New', $data);
    }
    public function tambahbulanharga()
    {
        $data = $this->request->getPost();
        if ($data['bulan'] != 0 && $data['harga'] != 0) {
            $this->penjualModel->update($this->session->get('id_penjual'), [
                'penaksiran' => $data['bulan'],
                'harga' => $data['harga'],
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        } else if ($data['bulan'] != 0 && $data['harga'] == 0) {
            $this->penjualModel->update($this->session->get('id_penjual'), [
                'penaksiran' => $data['bulan'],
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        } else if ($data['bulan'] == 0 && $data['harga'] != 0) {
            $this->penjualModel->update($this->session->get('id_penjual'), [
                'harga' => $data['harga'],
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        } else {
            session()->setFlashdata('error', 'Tidak ada yang diubah');
        }
        return redirect()->to('Penjual/create');
    }
    public function tambahpermintaan()
    {
        $bulan = $this->permintaanModel->hitungbulan($this->session->get('id_penjual'));
        $bulan[0]['bulan'] = $bulan[0]['bulan'] + 1;
        $data = $this->request->getPost();
        if ($data) {
            $this->permintaanModel->insert([
                'id_penjual' => $this->session->get('id_penjual'),
                'bulan' => $bulan[0]['bulan'],
                'frekuensi' => $data['frekuensi'],
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
            return redirect()->to('Penjual/create');
        } else {
            session()->setFlashdata('error', 'Data Gagal Ditambahkan');
            return redirect()->back()->withInput();
        }
    }
    public function tahap1()
    {
        return view('User/Probabilitas');
    }
    public function tahap2()
    {
        return view('User/ProbabilitasKumulatif');
    }
    public function tahap3()
    {
        return view('User/Interval');
    }
    public function tahap4()
    {
        return view('User/AngkaAcak');
    }
}
