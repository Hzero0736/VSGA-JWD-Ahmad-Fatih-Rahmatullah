<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        echo view('layout/header');
        echo view('layout/navbar');
        echo view('public/beranda');
        echo view('layout/footer');
    }

    public function about()
    {
        echo view('layout/header');
        echo view('layout/navbar');
        echo view('public/about');
        echo view('layout/footer');
    }

    public function gallery()
    {
        echo view('layout/header');
        echo view('layout/navbar');
        echo view('public/gallery');
        echo view('layout/footer');
    }

    public function contact()
    {
        echo view('layout/header');
        echo view('layout/navbar');
        echo view('public/contact');
        echo view('layout/footer');
    }
}
