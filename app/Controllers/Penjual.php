<?php

namespace App\Controllers;

use App\Models\userModel;
use App\Models\penjualModel;

class Penjual extends BaseController
{
    public function __construct()
    {
        $this->userModel = new userModel();
        $this->penjualModel = new penjualModel();
    }

    public function index()
    {
        return view('User/1');
    }
    public function create()
    {
        return view('User/2');
    }
    public function tahap1()
    {
        return view('User/3');
    }
    public function tahap2()
    {
        return view('User/4');
    }
    public function tahap3()
    {
        return view('User/5');
    }
    public function tahap4()
    {
        return view('User/6');
    }
}
