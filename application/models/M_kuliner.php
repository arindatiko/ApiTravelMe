<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class m_kuliner extends MY_Model{
    public $table = 'kuliner'; // you MUST mention the table name
    public $primary_key = 'id_kuliner'; // you MUST mention the primary key
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update

    public function __construct()
    {
        parent::__construct();
        $this->has_one['id_user'] = array(
            'foreign_model' => 'M_user',
            'foreign_table' => 'user',
            'foreign_key' => 'id_user',
            'local_key' => 'id_user'
        );
        $this->has_many['menu'] = array(
            'foreign_model' => 'M_menu',
            'foreign_table' => 'menu',
            'foreign_key' => 'id_kuliner',
            'local_key' => 'id_kuliner'
        );  

        // $this->has_many_pivot['posts'] = array(
        //     'foreign_model'=>'M_menu',
        //     'pivot_table'=>'menu',
        //     'local_key'=>'id_kuliner',
        //     'pivot_local_key'=>'id_kuliner',  this is the related key in the pivot table to the local key
        //         this is an optional key, but if your column name inside the pivot table
        //         doesn't respect the format of "singularlocaltable_primarykey", then you must set it. In the next title
        //         you will see how a pivot table should be set, if you want to  skip these keys 
        //     'pivot_foreign_key'=>'post_id', /* this is also optional, the same as above, but for foreign table's keys */
        //     'foreign_key'=>'id',
        //     'get_relate'=>FALSE /* another optional setting, which is explained below */
        // );
    }
}