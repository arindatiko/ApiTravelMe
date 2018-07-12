<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class m_rekomendasi extends MY_Model{
    public $table = 'rekomendasi_wisata';
    //public $table = 'customer'; // you MUST mention the table name
    public $primary_key = 'id_rekomendasi';
    //public $primary_key = 'id_customer'; // you MUST mention the primary key
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update

    public function __construct()
    {
        parent::__construct();

        $this->has_many['wisata'] = array(
                'foreign_model' => 'M_wisata',
                'foreign_table' => 'wisata',
                'foreign_key' => 'id_wisata',
                'local_key' => 'id_tujuan'
        );

        $this->has_many['kamar'] = array(
                'foreign_model' => 'M_kamar',
                'foreign_table' => 'kamar',
                'foreign_key' => 'id_kamar',
                'local_key' => 'id_tujuan'
        );

        $this->has_many['menu'] = array(
                'foreign_model' => 'M_menu',
                'foreign_table' => 'menu',
                'foreign_key' => 'id_menu',
                'local_key' => 'id_tujuan'
        );

        /*$this->has_one['pesanan'] = array(
                'foreign_model' => 'M_pesanan',
                'foreign_table' => 'pesanan',
                'foreign_key' => 'id_customer',
                'local_key' => 'id_user'
        );*/  

        $this->has_one['user'] = array(
            'foreign_model' => 'M_user',
            'foreign_table' => 'user',
            'foreign_key' => 'id_user',
            'local_key' => 'id_user'
        );      
    }
}