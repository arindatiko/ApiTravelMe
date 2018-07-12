<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class m_update extends MY_Model{
    public $table = 'update_harga'; // you MUST mention the table name
    public $primary_key = 'id_update'; // you MUST mention the primary key
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

        $this->has_many['kamar'] = array(
            'foreign_model' => 'M_kamar',
            'foreign_table' => 'kamar',
            'foreign_key' => 'id_kamar',
            'local_key' => 'kamar'
        );

        $this->has_many['menu'] = array(
            'foreign_model' => 'M_menu',
            'foreign_table' => 'menu',
            'foreign_key' => 'id_menu',
            'local_key' => 'menu'
        );

        $this->has_one['admin'] = array(
            'foreign_model' => 'M_user',
            'foreign_table' => 'user',
            'foreign_key' => 'id_user',
            'local_key' => 'admin'
        );
    }
}