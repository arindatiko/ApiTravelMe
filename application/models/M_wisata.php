<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class m_wisata extends MY_Model{
    public $table = 'wisata'; // you MUST mention the table name
    public $primary_key = 'id_wisata'; // you MUST mention the primary key
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update

    public function __construct()
    {
        parent::__construct();
        // $this->has_one['id_user'] = array(
        //     'foreign_model' => 'M_user',
        //     'foreign_table' => 'user',
        //     'foreign_key' => 'id_user',
        //     'local_key' => 'author_event'
        // // );
        // $this->has_one['id_kategori'] = array(
        //     'foreign_model' => 'M_kategori',
        //     'foreign_table' => 'kategori',
        //     'foreign_key' => 'nama_kategori',
        //     'local_key' => 'category_event'
        // );

        /*$this->has_many['rekomendasi_wisata'] = array(
            'foreign_model' => 'M_rekomendasi',
            'foreign_table' => 'rekomendasi_wisata',
            'foreign_key' => 'id_tujuan',
            'local_key' => 'id_wisata'
        );*/

         $this->has_many['pesanan'] = array(
                'foreign_model' => 'M_pesanan',
                'foreign_table' => 'pesanan',
                'foreign_key' => 'id_customer',
                'local_key' => 'id_user'
        );        
    }
}