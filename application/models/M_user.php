<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class m_user extends MY_Model{
    public $table = 'user';
    //public $table = 'customer'; // you MUST mention the table name
    public $primary_key = 'id_user';
    //public $primary_key = 'id_customer'; // you MUST mention the primary key
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update

    public function __construct()
    {
        parent::__construct();
        
        $this->has_one['id_penginapan'] = array(
            'foreign_model' => 'M_penginapan',
            'foreign_table' => 'penginapan',
            'foreign_key' => 'id_penginapan',
            'local_key' => 'penginapan'
        );

        $this->has_one['id_wisata'] = array(
            'foreign_model' => 'M_wisata',
            'foreign_table' => 'wisata',
            'foreign_key' => 'id_wisata',
            'local_key' => 'wisata'
        );

        $this->has_one['id_kuliner'] = array(
            'foreign_model' => 'M_kuliner',
            'foreign_table' => 'kuliner',
            'foreign_key' => 'id_kuliner',
            'local_key' => 'kuliner'
        );

        $this->has_many['rekomendasi_wisata'] = array(
            'foreign_model' => 'M_rekomendasi',
            'foreign_table' => 'rekomendasi_wisata',
            'foreign_key' => 'id_user',
            'local_key' => 'id_user'
        );

        $this->has_one['pesanan'] = array(
            'foreign_model' => 'M_pesanan',
            'foreign_table' => 'pesanan',
            'foreign_key' => 'id_customer',
            'local_key' => 'id_user'
        );
    }
}