<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class m_admin extends MY_Model{
    public $table = 'admin'; // you MUST mention the table name
    public $primary_key = 'id_admin'; // you MUST mention the primary key
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
    }
}