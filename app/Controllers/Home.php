<?php

namespace App\Controllers;

use App\Models\userModel;
use App\Models\penjualModel;

class Home extends BaseController
{
    public function __construct()
    {
        $this->userModel = new userModel();
        $this->penjualModel = new penjualModel();
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        return view('User/Home');
    }

    public function Register()
    {
        return view('login/register');
    }

    public function daftar()
    {
        $data = $this->request->getPost();
        if (!$this->validate([
            'username' => [
                'rules' => 'required|min_length[4]|max_length[20]|is_unique[tbl_user.username]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 20 Karakter',
                    'is_unique' => 'Username sudah digunakan sebelumnya'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[4]|max_length[50]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 50 Karakter',
                ]
            ],
            'nama' => [
                'rules' => 'required|min_length[4]|max_length[50]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 50 Karakter',
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $this->userModel->insert([
            'username' => $data['username'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT),
            'created_at' => date('Y-m-d H:i:s')
        ]);
        $id_user = $this->userModel->insertID();
        $this->penjualModel->insert([
            'id_user' => $id_user,
            'nama' => $data['nama'],
            'created_at' => date('Y-m-d H:i:s')
        ]);
        session()->setFlashdata('success', 'Berhasil Registrasi');
        return redirect()->to('Home/login');
    }

    public function login()
    {
        return view('login/login');
    }

    public function prosesLogin()
    {
        $data = $this->request->getPost();
        if (!$this->validate([
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi',
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi',
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $user = $this->userModel->join('tbl_penjual', 'tbl_penjual.id_user = tbl_user.id_user')->where('username', $data['username'])->first();
        if ($user) {
            if (password_verify($data['password'], $user['password'])) {
                session()->set('user', $user);
                session()->set('id_user', $user['id_user']);
                session()->set('id_penjual', $user['id_penjual']);
                session()->setFlashdata('success', 'Berhasil Login');
                return redirect()->to('Penjual');
            } else {
                session()->setFlashdata('error', 'Password Salah');
                return redirect()->back()->withInput();
            }
        } else {
            session()->setFlashdata('error', 'Username Tidak Terdaftar');
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('Home/login');
    }
}
