<?php

namespace App\Controllers;

use App\Models\userModel;
use App\Models\penjualModel;
use App\Models\permintaanModel;
use App\Models\hasilModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Penjual extends BaseController
{
    public function __construct()
    {
        $this->userModel = new userModel();
        $this->penjualModel = new penjualModel();
        $this->session = \Config\Services::session();
        $this->permintaanModel = new permintaanModel();
        $this->hasilModel = new hasilModel();
        $this->spreadsheet = new Spreadsheet();
        $this->reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $this->reader->setReadDataOnly(true);
        $this->writer = new Xlsx($this->spreadsheet);
    }

    public function index()
    {
        if ($this->session->get('id_user') == null) {
            return redirect()->to(base_url('Home/login'));
        }
        return view('User/Profile');
    }
    public function create()
    {
        if ($this->session->get('id_user') == null) {
            return redirect()->to(base_url('Home/login'));
        }
        $data['permintaan'] = $this->permintaanModel->getdatapenjual($this->session->get('id_penjual'));
        $data['harga'] = $this->penjualModel->hargapenjual($this->session->get('id_penjual'));
        $data['bulan'] = $this->permintaanModel->hitungbulan($this->session->get('id_penjual'));
        //dd($data);
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
        $data = $this->request->getPost();
        $file = $this->request->getFile('file_excel');
        if ($data['frekuensi'] == "") {
            $data['frekuensi'] = null;
        } else {
            $data['frekuensi'] = $data['frekuensi'];
        }

        if ($_FILES['file_excel']['tmp_name'] == "") {
            $_FILES['file_excel']['tmp_name'] = Null;
        } else {
            $_FILES['file_excel']['tmp_name'] = $_FILES['file_excel']['tmp_name'];
        }

        if ($data['frekuensi'] != null && $_FILES['file_excel']['tmp_name'] == Null) {
            $bulan[0]['bulan'] = $bulan[0]['bulan'] + 1;
            $this->permintaanModel->insert([
                'id_penjual' => $this->session->get('id_penjual'),
                'bulan' => $bulan[0]['bulan'],
                'frekuensi' => $data['frekuensi'],
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
            return redirect()->to('Penjual/create');
        } else if ($data['frekuensi'] == null && $_FILES['file_excel']['tmp_name'] != Null) {
            $ext = $file->getClientExtension();
            if ($ext == 'xls') {
                $this->reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $this->reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $this->spreadsheet = $this->reader->load($file);
            $dataexcel = $this->spreadsheet->getActiveSheet()->toArray();
            foreach ($dataexcel as $d => $excel) {
                //skip title row
                $bulan[0]['bulan'] = $bulan[0]['bulan'] + 1;
                if ($d == 0) {
                    continue;
                }
                $frekuensi = $excel[1];
                $this->permintaanModel->insert([
                    'id_penjual' => $this->session->get('id_penjual'),
                    'bulan' => $bulan[0]['bulan'],
                    'frekuensi' => $frekuensi,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
            session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
            return redirect()->to('Penjual/create');
        } else if ($data['frekuensi'] != null && $_FILES['file_excel']['tmp_name'] != Null) {
            $ext = $file->getClientExtension();
            if ($ext == 'xls') {
                $this->reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $this->reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $this->spreadsheet = $this->reader->load($file);
            $dataexcel = $this->spreadsheet->getActiveSheet()->toArray();
            $bulan[0]['bulan'] = $bulan[0]['bulan'] + 1;
            foreach ($dataexcel as $d => $excel) {
                //skip title row
                if ($d == 0) {
                    continue;
                }

                $frekuensi = $excel[1];
                $this->permintaanModel->insert([
                    'id_penjual' => $this->session->get('id_penjual'),
                    'bulan' => $bulan[0]['bulan'],
                    'frekuensi' => $frekuensi,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
                $bulan[0]['bulan'] = $bulan[0]['bulan'] + 1;
            }

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
        $data['permintaan'] = $this->permintaanModel->getdatapenjual($this->session->get('id_penjual'));
        return view('User/Probabilitas', $data);
    }
    public function tahap2()
    {
        $data['permintaan'] = $this->permintaanModel->getdatapenjual($this->session->get('id_penjual'));
        return view('User/ProbabilitasKumulatif', $data);
    }
    public function tahap3()
    {
        $data['permintaan'] = $this->permintaanModel->getdatapenjual($this->session->get('id_penjual'));
        return view('User/Interval', $data);
    }
    public function tahap4()
    {
        $data['permintaan'] = $this->permintaanModel->getdatapenjual($this->session->get('id_penjual'));
        return view('User/AngkaAcak', $data);
    }

    public function inputhasil()
    {
        $data = $this->request->getPost();
        $hasil = $this->hasilModel->datahasil($this->session->get('id_penjual'));
        if ($data) {
            if ($hasil != null) {
                $this->hasilModel->update($hasil[0]['id_hasil'], [
                    'total_permintaan' => $data['totalhasil'],
                    'rata_permintaan' => $data['ratahasil'],
                    'rata_pemasukan' => $data['ratapemasukan'],
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            } else {
                $this->hasilModel->insert([
                    'id_penjual' => $this->session->get('id_penjual'),
                    'total_permintaan' => $data['totalhasil'],
                    'rata_permintaan' => $data['ratahasil'],
                    'rata_pemasukan' => $data['ratapemasukan'],
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
            session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
            return redirect()->to('Penjual/tahap4');
        } else {
            session()->setFlashdata('error', 'Data Gagal Ditambahkan');
            return redirect()->back()->withInput();
        }
    }
}
