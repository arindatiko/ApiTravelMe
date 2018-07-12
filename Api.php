<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Api extends REST_Controller{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function admin_post(){
        $this->load->model('m_admin');
        $data_admin = array(
            'nama'      => $this->post('nama'),
            'uname'     => $this->post('uname'),
            'password'  => md5($this->post('password')),
            'alamat'    => $this->post('alamat'),
            'desa'      => $this->post('desa'),
            'kecamatan' => $this->post('kecamatan'),
            'jk'        => $this->post('jk'),
            'kriteria'  => $this->post('kriteria'),
            'no_telp'   => $this->post('no_telp'),
        );

        $this->load->library('form_validation');
        $this->form_validation->set_data($data_admin);
        $this->form_validation->set_rules('uname', '\'uname\'', 'required|is_unique[admin.uname]');


        if ($this->form_validation->run()==TRUE){
            if ($this->m_admin->insert($data_admin)){
                $this->response($data_admin);
            }
            else{
                $this->response('gagal');
            }
        }
        else{
            $this->response(
                $this->_response['message'] = strip_tags(validation_errors()));
        }
    }

    public function customer_post(){
        $this->load->model('m_customer');
        $data_customer = array(
            'nama_lengkap'  => $this->post('nama_lengkap'),
            'uname'         => $this->post('uname'),
            'password'      => md5($this->post('password')),
            'alamat'        => $this->post('alamat'),
            'desa'          => $this->post('desa'),
            'kecamatan'     => $this->post('kecamatan'),
            'no_telp'       => $this->post('no_telp'),
            'email'         => $this->post('email'),
            'posisi_lat'    => $this->post('posisi_lat'),
            'posisi_lng'    => $this->post('posisi_lng')
        );

        $this->load->library('form_validation');
        $this->form_validation->set_data($data_customer);
        $this->form_validation->set_rules('uname', '\'uname\'', 'required|is_unique[customer.uname]');


        if ($this->form_validation->run()==TRUE){
            if ($this->m_customer->insert($data_customer)){
                $this->response($data_customer);
            }
            else{
                $this->response('gagal');
            }
        }
        else{
            $this->response(
                $this->_response['message'] = strip_tags(validation_errors()));
        }
    }

    public function wisata_post(){
        $this->load->model('m_wisata');
        $data_wisata = array(
            'id_admin'              => $this->post('id_admin'),
            'nama'                  => $this->post('nama'),
            'desa'                  => $this->post('desa'),
            'kecamatan'             => $this->post('kecamatan'),
            'tiket_masuk_dewasa'    => $this->post('tiket_masuk_dewasa'),
            'tiket_masuk_anak'      => $this->post('tiket_masuk_anak'),
            'biaya_parkir_motor'    => $this->post('biaya_parkir_motor'),
            'biaya_parkir_mobil'    => $this->post('biaya_parkir_mobil'),
            'biaya_parkir_bus'      => $this->post('biaya_parkir_bus'),
            'foto'                  => $this->post('foto'),
            'deskripsi'             => $this->post('deskripsi'),
            'fasilitas'             => $this->post('fasilitas'),
            'posisi_lat'            => $this->post('posisi_lat'),
            'posisi_lng'            => $this->post('posisi_lng'),
            'akses'                 => $this->post('akses'),
            'zona'                  => $this->post('zona'),
            'jam_buka'              => $this->post('jam_buka'),
            'jam_tutup'             => $this->post('jam_tutup'),
            'jenis'                 => $this->post('jenis')
        );

        $this->load->library('form_validation');
        $this->form_validation->set_data($data_wisata);
        $this->form_validation->set_rules('id_admin', '\'id_admin\'', 'required');


        if ($this->form_validation->run()==TRUE){
            if ($this->m_wisata->insert($data_wisata)){
                $this->response($data_wisata);
            }
            else{
                $this->response('gagal');
            }
        }
        else{
            $this->response(
                $this->_response['message'] = strip_tags(validation_errors()));
        }
    }

    public function kuliner_post(){
        $this->load->model('m_kuliner');
        $data_kuliner = array(
            'id_admin'                  => $this->post('id_admin'),
            'nama'                      => $this->post('nama'),
            'alamat'                    => $this->post('alamat'),
            'no_telp'                   => $this->post('no_telp'),
            'posisi_lat'                => $this->post('posisi_lat'),
            'posisi_lng'                => $this->post('posisi_lng'),
            'harga_tiket_parkir_motor'  => $this->post('harga_tiket_parkir_motor'),
            'harga_tiket_parkir_mobil'  => $this->post('harga_tiket_parkir_mobil'),
            'harga_tiket_parkir_bus'    => $this->post('harga_tiket_parkir_bus'),
            'foto'                      => $this->post('foto'),
            'deskripsi'                 => $this->post('deskripsi'),
            'fasilitas'              => $this->post('fasilitas'),
            'jam_buka'                  => $this->post('jam_buka'),
            'jam_tutup'                 => $this->post('jam_tutup')
        );

        $this->load->library('form_validation');
        $this->form_validation->set_data($data_kuliner);
        $this->form_validation->set_rules('id_admin', '\'id_admin\'', 'required');

        if ($this->form_validation->run()==TRUE){
            if ($this->m_kuliner->insert($data_kuliner)){
                $this->response($data_kuliner);
            }
            else{
                $this->response('gagal');
            }
        }
        else{
            $this->response(
                $this->_response['message'] = strip_tags(validation_errors()));
        }
    }

    public function menu_post(){
        $this->load->model('m_menu');
        $data_menu = array(
            'id_kuliner'    => $this->post('id_kuliner'),
            'nama'          => $this->post('nama'),
            'harga'         => $this->post('harga'),
            'foto'          => $this->post('foto'),
            'deskripsi'     => $this->post('deskripsi')
        );

        $this->load->library('form_validation');
        $this->form_validation->set_data($data_menu);
        $this->form_validation->set_rules('id_kuliner', '\'id_kuliner\'', 'required');

        if ($this->form_validation->run()==TRUE){
            if ($this->m_menu->insert($data_menu)){
                $this->response($data_menu);
            }
            else{
                $this->response('gagal');
            }
        }
        else{
            $this->response(
                $this->_response['message'] = strip_tags(validation_errors()));
        }
    }

    public function penginapan_post(){
        $this->load->model('m_penginapan');
        $data_penginapan = array(
            'id_admin'                      => $this->post('id_admin'),
            'nama'                          => $this->post('nama'),
            'alamat'                        => $this->post('alamat'),
            'no_telp'                       => $this->post('no_telp'),
            'posisi_lat'                    => $this->post('posisi_lat'),
            'posisi_lng'                    => $this->post('posisi_lng'),
            'foto'                          => $this->post('foto'),
            'deskripsi'                     => $this->post('deskripsi'),
            'fasilitas'                  => $this->post('fasilitas')
        );

        $this->load->library('form_validation');
        $this->form_validation->set_data($data_penginapan);
        $this->form_validation->set_rules('id_admin', '\'id_admin\'', 'required');

        if ($this->form_validation->run()==TRUE){
            if ($this->m_penginapan->insert($data_penginapan)){
                $this->response($data_penginapan);
            }
            else{
                $this->response('gagal');
            }
        }
        else{
            $this->response(
                $this->_response['message'] = strip_tags(validation_errors()));
        }
    }

    public function kamar_post(){
        $this->load->model('m_kamar');
        $data_kamar = array(
            'id_penginapan' => $this->post('id_penginapan'),
            'nama'          => $this->post('nama'),
            'banyak_kamar'  => $this->post('banyak_kamar'),
            'kapasitas'     => $this->post('kapasitas'),
            'fasilitas'     => $this->post('fasilitas'),
            'harga'         => $this->post('harga')
        );

        $this->load->library('form_validation');
        $this->form_validation->set_data($data_kamar);
        $this->form_validation->set_rules('id_penginapan', '\'id_penginapan\'', 'required');

        if ($this->form_validation->run()==TRUE){
            if ($this->m_kamar->insert($data_kamar)){
                $this->response($data_kamar);
            }
            else{
                $this->response('gagal');
            }
        }
        else{
            $this->response(
                $this->_response['message'] = strip_tags(validation_errors()));
        }
    }

    public function recomendation_post(){

        // ex jenis_layanan = 'wisata'. hanya 1 !
        $jenis_layanan = $this->post('jenis_layanan');

        $budget_wisata = $this->post('budget_wisata');
        $budget_kamar = $this->post('budget_kamar');
        $budget_menu = $this->post('budget_menu');

        //default jumlah_xxxxx = 0
        $jumlah_motor = $this->post('jumlah_motor');
        $jumlah_mobil = $this->post('jumlah_mobil');
        $jumlah_bus = $this->post('jumlah_bus');

        // ex wisata_jenis = 'buatan,alam', default wisata_jenis = 'null'
        $wisata_jenis = $this->post('wisata_jenis');
        $wisata_jumlah_anak = $this->post('wisata_jumlah_anak');
        $wisata_jumlah_dewasa = $this->post('wisata_jumlah_dewasa');
        $wisata_waktu = $this->post('wisata_waktu');

        //default kamar_jumlah = 0
        $kamar_jumlah = $this->post('kamar_jumlah');
        $kamar_jumlah_hari = $this->post('kamar_jumlah_hari');

        //default menu_porsi = 0
        $menu_porsi = $this->post('menu_porsi');
        $menu_waktu = $this->post('menu_waktu');

        //berdasarkan budget wisata dibagi jumlah dewasa dan budget wisata dibagi anak2
        if($jenis_layanan=='wisata'){
            $this->load->model('m_wisata');

            $wisata_jenis_fix =array();
            if (strpos($wisata_jenis, 'alam')!== false) {
                array_push($wisata_jenis_fix, 'alam');
            }

            if (strpos($wisata_jenis, 'buatan')!== false) {
                array_push($wisata_jenis_fix, 'buatan');
            }
            if (strpos($wisata_jenis, 'sejaran')!== false) {
                array_push($wisata_jenis_fix, 'sejarah');
            }

            $budget_tiket_masuk_anak = $budget_wisata / $wisata_jumlah_anak;
            $budget_tiket_masuk_dewasa = $budget_wisata / $wisata_jumlah_dewasa;

            $data_recomendation = $this->m_wisata->
            where('jenis',$wisata_jenis_fix)->
            where('tiket_masuk_dewasa <= ',$budget_tiket_masuk_dewasa)->
            where('tiket_masuk_anak <=',$budget_tiket_masuk_anak)->get_all();

            $this->response($data_recomendation);
        }

        //berdasarkan jumlah kamar dan lama menginap
        if ($jenis_layanan=='kamar') {
            $this->load->model('m_kamar');

            $budget_kamar =  $budget_kamar / ($kamar_jumlah*$kamar_jumlah_hari);

            $data_recomendation = $this->m_kamar->
            where('harga <=',$budget_kamar)->get_all();

            $this->response($data_recomendation);
        }

        //berdasarkan porsi
        if ($jenis_layanan=='menu') {
            $this->load->model('m_menu');

            $budget_menu = $budget_menu / $menu_porsi;

            $data_recomendation = $this->m_menu->
            where('harga <=',$budget_menu)->get_all();

            $this->response($data_recomendation);
        }
    }


}

    