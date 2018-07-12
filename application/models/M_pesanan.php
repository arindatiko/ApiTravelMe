<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class m_pesanan extends MY_Model{
    public $table = 'pesanan';// you MUST mention the table name
    public $primary_key = 'id_pesanan';// you MUST mention the primary key
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update

    public function __construct()
    {
        parent::__construct();
       /* $this->has_many['rekomendasi_wisata'] = array(
            'foreign_model' => 'M_rekomendasi',
            'foreign_table' => 'rekomendasi_wisata',
            'foreign_key' => 'id_user',
            'local_key' => 'id_customer'
        );*/

        $this->has_one['user'] = array(
            'foreign_model' => 'M_user',
            'foreign_table' => 'user',
            'foreign_key' => 'id_user',
            'local_key' => 'id_customer'
        );

        $this->has_one['user'] = array(
            'foreign_model' => 'M_user',
            'foreign_table' => 'user',
            'foreign_key' => 'id_user',
            'local_key' => 'id_driver'
        );
    }
}