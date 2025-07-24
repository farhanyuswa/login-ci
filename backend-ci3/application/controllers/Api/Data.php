<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    }

    public function eksporimpor()
    {
        $data = [
            ['bulan' => 'Januari', 'ekspor' => 120, 'impor' => 80],
            ['bulan' => 'Februari', 'ekspor' => 150, 'impor' => 90],
            ['bulan' => 'Maret', 'ekspor' => 170, 'impor' => 95],
            ['bulan' => 'April', 'ekspor' => 140, 'impor' => 85],
            ['bulan' => 'Mei', 'ekspor' => 180, 'impor' => 110],
            ['bulan' => 'Juni', 'ekspor' => 160, 'impor' => 100],
        ];

        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
