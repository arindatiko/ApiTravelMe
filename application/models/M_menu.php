<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class m_menu extends MY_Model{
    public $table = 'menu'; // you MUST mention the table name
    public $primary_key = 'id_menu'; // you MUST mention the primary key
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
        // );
        $this->has_one['kuliner'] = array(
            'foreign_model' => 'M_kuliner',
            'foreign_table' => 'kuliner',
            'foreign_key' => 'id_kuliner',
            'local_key' => 'id_kuliner'
        );
        
        $this->has_many['rekomendasi_wisata'] = array(
            'foreign_model' => 'M_rekomendasi',
            'foreign_table' => 'rekomendasi_wisata',
            'foreign_key' => 'id_tujuan',
            'local_key' => 'id_menu'
        );
    }
}