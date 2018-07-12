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

    public function login_post(){
        $this->load->model('m_user');
        $data_customer = array(
            'password'      => $this->post('password'),
            'no_telp'       => $this->post('no_telp')/*,
            'user_type'     => $this->post('user_type')*/
        );
        $data=$this->m_user->where($data_customer)->get();

        if($data){
            $this->response($data);
        }else{
            $this->response('error');
        }
    }

    public function register_post(){
        $this->load->model('m_user');
        $data_user = array(
            'username'      => $this->post('username'),
            'password'      => $this->post('password'),
            //'nama_lengkap'  => $this->post('nama_lengkap'),
            //'alamat'        => $this->post('alamat'),
            'no_telp'       => $this->post('no_telp'),
            //'email'         => $this->post('email'),
            'user_type'     => $this->post('user_type')
        );
        //$data = $this->m_user->insert($data_user);

        $this->load->library('form_validation');
        $this->form_validation->set_data($data_user);
        $this->form_validation->set_rules('no_telp', '\'no_telp\'', 'required|is_unique[customer.uname]');

        if ($this->form_validation->run()==TRUE){
            if ($this->m_user->insert($data_user)){
                $this->response($data_user);
            }
            else{
                $this->response('Server bermasalah');
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

    public function wisata_update_post(){
        $this->load->model('m_wisata');
        $data_wisata = array(
            'nama'                  => $this->post('nama'),
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
            'jam_buka'              => $this->post('jam_buka'),
            'jam_tutup'             => $this->post('jam_tutup'),
            'jenis'                 => $this->post('jenis')
        );

        //$id_kamar = $this->post('id_kamar');
        $this->m_wisata->update($data_wisata, $this->post('id_wisata'));

        $this->response($data_wisata);
    }

    public function detail_wisata_post(){
        $this->load->model('m_wisata');
        $id_wisata = $this->post('id_wisata');
        $data_detail_wisata = $this->m_wisata->where_id_wisata($id_wisata)->with_menu()->get();
        $this->response($data_detail_wisata);
    }

    public function detail_wisata_admin_post(){
        $this->load->model('m_wisata');
        $id_user = $this->post('id_user');
        $this->response($this->m_wisata->where('id_user', $id_user)->with_menu()->get());
    }

    public function all_wisata_post(){
        $this->load->model('m_wisata');

        $data_all_wisata = $this->m_wisata->get_all();

        $this->response($data_all_wisata);
    }

    public function kuliner_post(){
        $this->load->model('m_kuliner');
        $data_kuliner = array(
            'id_user'                  => $this->post('id_user'),
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
            'fasilitas'                 => $this->post('fasilitas'),
            'jam_buka'                  => $this->post('jam_buka'),
            'jam_tutup'                 => $this->post('jam_tutup')
        );

        $this->load->library('form_validation');
        $this->form_validation->set_data($data_kuliner);
        $this->form_validation->set_rules('id_user', '\'id_user\'', 'required');

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

    public function kuliner_update_post(){
        $this->load->model('m_kuliner');
        $data_kuliner = array(
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
            'fasilitas'                 => $this->post('fasilitas'),
            'akses'                     => $this->post('akses'),
            'jam_buka'                  => $this->post('jam_buka'),
            'jam_tutup'                 => $this->post('jam_tutup')
        );

        //$id_kamar = $this->post('id_kamar');
        $this->m_kuliner->update($data_kuliner, $this->post('id_kuliner'));

        $this->response($data_kuliner);
    }

    public function all_kuliner_post(){
        $this->load->model('m_kuliner');

        $data_all_kuliner = $this->m_kuliner->get_all();

        $this->response($data_all_kuliner);
    }

    public function detail_kuliner_post(){
        $this->load->model('m_kuliner');
        $id_kuliner = $this->post('id_kuliner');
        $data_detail_kuliner = $this->m_kuliner->where_id_kuliner($id_kuliner)->with_menu()->get();
        $this->response($data_detail_kuliner);
    }

    public function detail_kuliner_admin_post(){
        $this->load->model('m_kuliner');
        $id_user = $this->post('id_user');
        $data_detail_kuliner = $this->m_kuliner->where('id_user', $id_user)->with_menu()->get();
        $this->response($data_detail_kuliner);
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

    public function menu_update_post(){
        $this->load->model('m_menu');
        $data_menu = array(
            'id_kuliner'    => $this->post('id_kuliner'),
            'nama'          => $this->post('nama'),
            'harga'         => $this->post('harga'),
            'foto'          => $this->post('foto'),
            'deskripsi'     => $this->post('deskripsi')
        );

        //$id_kamar = $this->post('id_kamar');
        $this->m_menu->update($data_menu, $this->post('id_menu'));

        $this->response($data_menu);
    }

    public function penginapan_post(){
        $this->load->model('m_penginapan');
        $data_penginapan = array(
            'id_admin'      => $this->post('id_admin'),
            'nama'          => $this->post('nama'),
            'alamat'        => $this->post('alamat'),
            'no_telp'       => $this->post('no_telp'),
            'posisi_lat'    => $this->post('posisi_lat'),
            'posisi_lng'    => $this->post('posisi_lng'),
            'foto'          => $this->post('foto'),
            'deskripsi'     => $this->post('deskripsi'),
            'fasilitas'     => $this->post('fasilitas'),
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

    public function penginapan_update_post(){
        $this->load->model('m_penginapan');
        $data_penginapan = array(
            'nama'          => $this->post('nama'),
            'alamat'        => $this->post('alamat'),
            'no_telp'       => $this->post('no_telp'),
            'posisi_lat'    => $this->post('posisi_lat'),
            'posisi_lng'    => $this->post('posisi_lng'),
            'foto'          => $this->post('foto'),
            'deskripsi'     => $this->post('deskripsi'),
            'fasilitas'     => $this->post('fasilitas'),
        );

        //$id_kamar = $this->post('id_kamar');
        $this->m_penginapan->update($data_penginapan, $this->post('id_penginapan'));

        $this->response($data_penginapan);
    }

    public function all_penginapan_post(){
        $this->load->model('m_penginapan');

        $data_all_penginapan = $this->m_penginapan->get_all();

        $this->response($data_all_penginapan);
    }

    public function detail_penginapan_post(){
        $this->load->model('m_penginapan');
        $id_penginapan = $this->post('id_penginapan');
        $data_detail_penginapan = $this->m_penginapan->where_id_penginapan($id_penginapan)->with_kamar()->get();
        $this->response($data_detail_penginapan);
    }

    public function detail_penginapan_admin_post(){
        $this->load->model('m_penginapan');
        $id_user = $this->post('id_user');
        $this->response($this->m_penginapan->where('id_user', $id_user)->with_kamar()->get());
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

    public function kamar_update_post(){
        $this->load->model('m_kamar');
        $data_kamar = array(
            'id_penginapan' => $this->post('id_penginapan'),
            'nama'          => $this->post('nama'),
            'banyak_kamar'  => $this->post('banyak_kamar'),
            'kapasitas'     => $this->post('kapasitas'),
            'fasilitas'     => $this->post('fasilitas'),
            'harga'         => $this->post('harga')
        );

        $this->m_kamar->update($data_kamar,  $this->post('id_kamar'));

        $this->response($data_kamar);
    }

    public function detail_kamar_post(){
        $this->load->model('m_kamar');
        $id_kamar = $this->post('id_kamar');

        $detail_kamar = $this->m_kamar->where_id_kamar($id_kamar)->with_penginapan()->get();
        $this->response($detail_kamar);
    }

    public function recomendation_post(){

        // ex jenis_layanan = 'wisata'. hanya 1 !
        $jenis_layanan          = $this->post('jenis_layanan');

        $budget_wisata          = $this->post('budget_wisata');
        $budget_kamar           = $this->post('budget_kamar');
        $budget_menu            = $this->post('budget_menu');
        $budget_transport       = $this->post('budget_transport');
        

        //default jumlah_xxxxx = 0
        $jumlah_motor           = $this->post('jumlah_motor');
        $jumlah_mobil           = $this->post('jumlah_mobil');
        $jumlah_bus             = $this->post('jumlah_bus');

        // ex wisata_jenis = 'buatan,alam', default wisata_jenis = 'null'
        $wisata_jenis           = $this->post('wisata_jenis');
        $wisata_jumlah_anak     = $this->post('wisata_jumlah_anak');
        $wisata_jumlah_dewasa   = $this->post('wisata_jumlah_dewasa');
        $wisata_waktu           = $this->post('wisata_waktu');

        //default kamar_jumlah = 0
        $kamar_jumlah           = $this->post('kamar_jumlah');
        $kamar_jumlah_hari      = $this->post('kamar_jumlah_hari');

        //default menu_porsi = 0
        $menu_porsi             = $this->post('menu_porsi');
        $menu_waktu             = $this->post('menu_waktu');

        //jadwal
        $jumlah_hari_liburan    = $this->post('jumlah_hari_liburan');
        $tanggal_liburan        = $this->post('tanggal_liburan');
        $jam_buka               = $this->post('jam_buka');
        $jam_tutup              = $this->post('jam_tutup');

        //transport
        $total_km               = $this->post('total_km');
        $harga_bahan_bakar      = $this->post('harga_bahan_bakar');
        $jasa                   = $this->post('jasa');
        $tambahan               = $this->post('tambahan');
        $biaya_mobil            = $this->post('biaya_mobil');
        $biaya_motor            = $this->post('biaya_motor');
        $biaya_bus              = $this->post('biaya_bus');


        if($jenis_layanan=='wisata'){
            $this->load->model('m_wisata');

            $wisata_jenis_fix =array();
            if (strpos($wisata_jenis, 'alam')!== false) {
                array_push($wisata_jenis_fix, 'alam');
            }

            if (strpos($wisata_jenis, 'buatan')!== false) {
                array_push($wisata_jenis_fix, 'buatan');
            }
            if (strpos($wisata_jenis, 'sejarah')!== false) {
                array_push($wisata_jenis_fix, 'sejarah');
            }

            if ($wisata_jumlah_anak!=0) {
                $budget_tiket_masuk_anak = $budget_wisata / $wisata_jumlah_anak;
            //harus akses data base foreach
            // $budget_tiket_masuk_anak = ($budget_wisata - ($tiket_masuk_dewasa*$wisata_jumlah_dewasa))/$wisata_jumlah_anak;
            }
            else{
                $budget_tiket_masuk_anak = $budget_wisata;
            }
            if ($wisata_jumlah_dewasa!=0) {
                $budget_tiket_masuk_dewasa = $budget_wisata / $wisata_jumlah_dewasa;
            // $budget_tiket_masuk_dewasa = ($budget_wisata - ($tiket_masuk_anak*$wisata_jumlah_anak))/$wisata_jumlah_dewasa;
            }
            else{
                $budget_tiket_masuk_dewasa = $budget_wisata;
            }

            $data = $this->m_wisata->
                where('jenis',$wisata_jenis_fix)->
                where('tiket_masuk_dewasa <= ',$budget_tiket_masuk_dewasa)->
                where('tiket_masuk_anak <=',$budget_tiket_masuk_anak)->get_all();

            $data_recomendation = array();

            $count = 0;
            foreach ($data as $wisata => $value) {
                if ($wisata_jumlah_anak!=0) {

                $budget_tiket_masuk_anak = (
                    $budget_wisata - 
                        ($value->tiket_masuk_dewasa*$wisata_jumlah_dewasa) - 
                        ($value->biaya_parkir_motor*$jumlah_motor) - 
                        ($value->biaya_parkir_mobil*$jumlah_mobil) - 
                        ($value->biaya_parkir_bus*$jumlah_bus))
                    /$wisata_jumlah_anak;
                }
                else{
                    $budget_tiket_masuk_anak = $budget_wisata;
                }
                if ($wisata_jumlah_dewasa!=0) {
                    $budget_tiket_masuk_dewasa = (
                        $budget_wisata - 
                        ($value->tiket_masuk_anak*$wisata_jumlah_anak) - 
                        ($value->biaya_parkir_motor*$jumlah_motor) - 
                        ($value->biaya_parkir_mobil*$jumlah_mobil) - 
                        ($value->biaya_parkir_bus*$jumlah_bus))
                    /$wisata_jumlah_dewasa;
                }
                else{
                    $budget_tiket_masuk_dewasa = $budget_wisata;
                }
                if ($jumlah_motor!=0) {

                    $budget_tiket_parkir_motor = (
                        $budget_wisata - 
                        ($value->tiket_masuk_anak*$wisata_jumlah_anak) - 
                        ($value->tiket_masuk_dewasa*$wisata_jumlah_dewasa) - 
                        ($value->biaya_parkir_mobil*$jumlah_mobil) - 
                        ($value->biaya_parkir_bus*$jumlah_bus))
                    /$jumlah_motor;
                }
                else{
                    $budget_tiket_parkir_motor = $budget_wisata;
                }
                if ($jumlah_mobil!=0) {

                    $budget_tiket_parkir_mobil = (
                        $budget_wisata - 
                        ($value->tiket_masuk_anak*$wisata_jumlah_anak) - 
                        ($value->tiket_masuk_dewasa*$wisata_jumlah_dewasa) - 
                        ($value->biaya_parkir_motor*$jumlah_motor) - 
                        ($value->biaya_parkir_bus*$jumlah_bus))
                    /$jumlah_mobil;
                }
                else{
                    $budget_tiket_parkir_mobil = $budget_wisata;
                }
                if ($jumlah_bus!=0) {

                    $budget_tiket_parkir_bus = (
                        $budget_wisata - 
                        ($value->tiket_masuk_anak*$wisata_jumlah_anak) - 
                        ($value->tiket_masuk_dewasa*$wisata_jumlah_dewasa) - 
                        ($value->biaya_parkir_motor*$jumlah_motor) - 
                        ($value->biaya_parkir_mobil*$jumlah_mobil))
                    /$jumlah_bus;
                }
                else{
                    $budget_tiket_parkir_bus = $budget_wisata;
                }

                if ($value->tiket_masuk_dewasa <= $budget_tiket_masuk_dewasa && 
                $value->tiket_masuk_anak <= $budget_tiket_masuk_anak && 
                $value->biaya_parkir_motor <= $budget_tiket_parkir_motor && 
                $value->biaya_parkir_mobil <= $budget_tiket_parkir_mobil && 
                $value->biaya_parkir_bus <= $budget_tiket_parkir_bus) {
                    array_push($data_recomendation, $value);
                    $harga = $budget_tiket_masuk_dewasa+$budget_tiket_masuk_anak+$budget_tiket_parkir_motor+$budget_tiket_parkir_mobil+$budget_tiket_parkir_bus;
                }

                $count++;
                if ($count==15) {
                    break; 
                }
            }

            $this->response($data_recomendation);
        }

        //berdasarkan jumlah kamar dan lama menginap
        if ($jenis_layanan=='kamar') {
            $this->load->model('m_kamar');

            $budget_kamar   =  $budget_kamar / ($kamar_jumlah*$kamar_jumlah_hari);

            $data_recomendation = $this->m_kamar->
            // where('harga <=',$budget_kamar)->with_penginapan()->get_all();
            where('harga <=',$budget_kamar)->with_penginapan()->paginate(15);

            $this->response($data_recomendation);
        }

        //berdasarkan porsi
        if ($jenis_layanan=='menu') {
            $this->load->model('m_menu');

            $budget_menu = $budget_menu / $menu_porsi;

            $data_recomendation = $this->m_menu->
            // where('harga <=',$budget_menu)->with_kuliner()->get_all();
            where('harga <=',$budget_menu)->with_kuliner()->paginate(15);

            $this->response($data_recomendation);
        }

        if($jenis_layanan=='transport'){
            //$this->load->model('m_kendaraan');

            //$data = array();

            //motor
            $biaya_motor = ($total_km*5000)*$jumlah_motor;

            //mobil
            $biaya_mobil = ($total_km*10000)*$jumlah_mobil;

            //bus
            $biaya_bus = ($total_km*15000)*$jumlah_bus;

            $budget_transport = $biaya_motor + $biaya_mobil + $biaya_bus + $jasa + $tambahan;
            //array_push($data, $budget_transport);

            $this->response($budget_transport);
        }
    }

    public function recommendation_backup_post(){

        // ex jenis_layanan = 'wisata'. hanya 1 !
        $jenis_layanan          = $this->post('jenis_layanan');

        $budget_wisata          = $this->post('budget_wisata');
        $budget_kamar           = $this->post('budget_kamar');
        $budget_menu            = $this->post('budget_menu');
        $budget_transport       = $this->post('budget_transport');

        //default jumlah_xxxxx = 0
        $jumlah_motor           = $this->post('jumlah_motor');
        $jumlah_mobil           = $this->post('jumlah_mobil');
        $jumlah_bus             = $this->post('jumlah_bus');

        // ex wisata_jenis = 'buatan,alam', default wisata_jenis = 'null'
        $wisata_jenis           = $this->post('wisata_jenis');
        $wisata_jumlah_anak     = $this->post('wisata_jumlah_anak');
        $wisata_jumlah_dewasa   = $this->post('wisata_jumlah_dewasa');
        $wisata_waktu           = $this->post('wisata_waktu');

        //default kamar_jumlah = 0
        $kamar_jumlah           = $this->post('kamar_jumlah');
        $kamar_jumlah_hari      = $this->post('kamar_jumlah_hari');

        //default menu_porsi = 0
        $menu_porsi             = $this->post('menu_porsi');
        $menu_waktu             = $this->post('menu_waktu');

        //transport
        $total_km               = $this->post('total_km');
        $harga_bahan_bakar      = $this->post('harga_bahan_bakar');
        $jasa                   = $this->post('jasa');
        $tambahan               = $this->post('tambahan');
        $biaya_mobil            = $this->post('biaya_mobil');
        $biaya_motor            = $this->post('biaya_motor');
        $biaya_bus              = $this->post('biaya_bus');

        if($jenis_layanan=='wisata'){
            $this->load->model('m_wisata');

            $wisata_jenis_fix =array();
            if (strpos($wisata_jenis, 'alam')!== false) {
                array_push($wisata_jenis_fix, 'alam');
            }

            if (strpos($wisata_jenis, 'buatan')!== false) {
                array_push($wisata_jenis_fix, 'buatan');
            }
            if (strpos($wisata_jenis, 'sejarah')!== false) {
                array_push($wisata_jenis_fix, 'sejarah');
            }

            if ($wisata_jumlah_anak!=0) {
                $budget_tiket_masuk_anak = $budget_wisata / $wisata_jumlah_anak;
                //harus akses data base foreach
                // $budget_tiket_masuk_anak = ($budget_wisata - ($tiket_masuk_dewasa*$wisata_jumlah_dewasa))/$wisata_jumlah_anak;
            }
            else{
                $budget_tiket_masuk_anak = $budget_wisata;
            }
            if ($wisata_jumlah_dewasa!=0) {
                $budget_tiket_masuk_dewasa = $budget_wisata / $wisata_jumlah_dewasa;
                // $budget_tiket_masuk_dewasa = ($budget_wisata - ($tiket_masuk_anak*$wisata_jumlah_anak))/$wisata_jumlah_dewasa;
            }
            else{
                $budget_tiket_masuk_dewasa = $budget_wisata;
            }

            $data = $this->m_wisata->
                    where('jenis',$wisata_jenis_fix)->
                    where('tiket_masuk_dewasa <= ',$budget_tiket_masuk_dewasa)->
                    where('tiket_masuk_anak <=',$budget_tiket_masuk_anak)->get_all();

            $data_recomendation = array();

            $count = 0;
            foreach ($data as $wisata => $value) {
                if ($wisata_jumlah_anak!=0) {

                    $budget_tiket_masuk_anak = (
                        $budget_wisata - 
                        ($value->tiket_masuk_dewasa*$wisata_jumlah_dewasa) - 
                        ($value->biaya_parkir_motor*$jumlah_motor) - 
                        ($value->biaya_parkir_mobil*$jumlah_mobil) - 
                        ($value->biaya_parkir_bus*$jumlah_bus))
                    /$wisata_jumlah_anak;
                }
                else{
                    $budget_tiket_masuk_anak = $budget_wisata;
                }
                if ($wisata_jumlah_dewasa!=0) {
                    $budget_tiket_masuk_dewasa = (
                        $budget_wisata - 
                        ($value->tiket_masuk_anak*$wisata_jumlah_anak) - 
                        ($value->biaya_parkir_motor*$jumlah_motor) - 
                        ($value->biaya_parkir_mobil*$jumlah_mobil) - 
                        ($value->biaya_parkir_bus*$jumlah_bus))
                    /$wisata_jumlah_dewasa;
                }
                else{
                    $budget_tiket_masuk_dewasa = $budget_wisata;
                }
                if ($jumlah_motor!=0) {

                    $budget_tiket_parkir_motor = (
                        $budget_wisata - 
                        ($value->tiket_masuk_anak*$wisata_jumlah_anak) - 
                        ($value->tiket_masuk_dewasa*$wisata_jumlah_dewasa) - 
                        ($value->biaya_parkir_mobil*$jumlah_mobil) - 
                        ($value->biaya_parkir_bus*$jumlah_bus))
                        /$jumlah_motor;
                }
                else{
                    $budget_tiket_parkir_motor = $budget_wisata;
                }
                if ($jumlah_mobil!=0) {

                    $budget_tiket_parkir_mobil = (
                        $budget_wisata - 
                        ($value->tiket_masuk_anak*$wisata_jumlah_anak) - 
                        ($value->tiket_masuk_dewasa*$wisata_jumlah_dewasa) - 
                        ($value->biaya_parkir_motor*$jumlah_motor) - 
                        ($value->biaya_parkir_bus*$jumlah_bus))
                    /$jumlah_mobil;
                }
                else{
                    $budget_tiket_parkir_mobil = $budget_wisata;
                }
                if ($jumlah_bus!=0) {

                    $budget_tiket_parkir_bus = (
                        $budget_wisata - 
                        ($value->tiket_masuk_anak*$wisata_jumlah_anak) - 
                        ($value->tiket_masuk_dewasa*$wisata_jumlah_dewasa) - 
                        ($value->biaya_parkir_motor*$jumlah_motor) - 
                        ($value->biaya_parkir_mobil*$jumlah_mobil))
                    /$jumlah_bus;
                }
                else{
                 $budget_tiket_parkir_bus = $budget_wisata;
                }

                if ($value->tiket_masuk_dewasa <= $budget_tiket_masuk_dewasa && 
                    $value->tiket_masuk_anak <= $budget_tiket_masuk_anak && 
                    $value->biaya_parkir_motor <= $budget_tiket_parkir_motor && 
                    $value->biaya_parkir_mobil <= $budget_tiket_parkir_mobil && 
                    $value->biaya_parkir_bus <= $budget_tiket_parkir_bus) {
                    array_push($data_recomendation, $value);
                    $harga = $budget_tiket_masuk_dewasa+$budget_tiket_masuk_anak+$budget_tiket_parkir_motor+$budget_tiket_parkir_mobil+$budget_tiket_parkir_bus;
                }

                $count++;
                if ($count==15) {
                break; 
                }
            }

            $this->response($data_recomendation);
        }

        //berdasarkan jumlah kamar dan lama menginap
        if ($jenis_layanan=='kamar') {
            $this->load->model('m_kamar');

            $budget_kamar = $budget_kamar / ($kamar_jumlah*$kamar_jumlah_hari);     

            $data_recomendation = $this->m_kamar->
            // where('harga <=',$budget_kamar)->with_penginapan()->get_all();
            where('harga <=',$budget_kamar)->with_penginapan()->paginate(15);

            $this->response($budget_kamar);
        }

        //berdasarkan porsi
        if ($jenis_layanan=='menu') {
            $this->load->model('m_menu');

            $budget_menu = $budget_menu / $menu_porsi;

            $data_recomendation = $this->m_menu->
         // where('harga <=',$budget_menu)->with_kuliner()->get_all();
            where('harga <=',$budget_menu)->with_kuliner()->paginate(15);

            $this->response($data_recomendation);
        }

        if ($jenis_layanan=='transport'){
            $this->load->model('m_kendaraan');

            //motor
            $biaya_motor = ($total_km * 5000);

            //mobil
            $biaya_mobil = ($total_km * 10000);

            //bus
            $biaya_bus = ($total_km * 15000);

            $budget_transport = 
                (($biaya_motor * $jumlah_motor) + 
                ($biaya_bus * $jumlah_bus) + 
                ($biaya_mobil * $jumlah_mobil) )+ $jasa + $tambahan
                ;

            $this->response($budget_transport);
        }
    }

    public function package_recomendation_backup_post(){
        $this->load->model('m_pesanan');
        $jenis_layanan = $this->post('jenis_layanan');
        $list_id_wisata = $this->post('list_id_wisata');
        $list_id_kamar =  $this->post('list_id_kamar');
        $list_id_menu = $this->post('list_id_menu');
        //$list_id_rute = $this->post('list_id_rute');

        $id_user = $this->post('id_user');

        switch ($jenis_layanan) {
            case 'wisata':
                $list = $list_id_wisata; 
                break;
            case 'kamar':
                $list = $list_id_kamar;
                break;
            case 'menu':
                $list = $list_id_menu;
                break;
            /*case 'transport':
                $list = $list_id_rute;
                break;*/
            default:
                # code...
                break;
        }
        $list = ltrim($list,",");
        $list = explode(",", $list);


         for ($j=0; $j < count($list); $j++) {   
            if ($jenis_layanan=='wisata'){
                //$insert_data = array('id_wisata' => $list[$j]);
                $this->m_pesanan->insert(array('id_user' => $id_user, 'id_wisata' => $list[$j]));
            }

            if ($jenis_layanan=='kamar') {
                $this->m_pesanan->where('id_user', $id_user)->update(array('id_kamar' => $list[$j]));
                //$data = $this->m_pesanan->where('id_user', $id_user)->with_kamar()->get();
                /*$this->m_rekomendasi->insert(array('id_user' => $id_user,'id_kamar' => $list[$j]));*/
            }

            if ($jenis_layanan=='menu') {
                $this->m_pesanan->where('id_user', $id_user)->update(array('id_menu' => $list[$j]));
                //$data = $this->m_pesanan->where('id_user', $id_user)->with_menu()->get();
                /*$this->m_pesanan->insert(array('id_user' => $id_user,'id_menu' =>$list[$j]));*/
    
            }
        }
        $this->response($this->m_pesanan->where('id_user',$id_user)->get_all());    
    }

    public function package_recomendation_post(){
        $jenis_layanan = $this->post('jenis_layanan');
        $list_id_wisata = $this->post('list_id_wisata');
        $list_id_kamar =  $this->post('list_id_kamar');
        $list_id_menu = $this->post('list_id_menu');

        switch ($jenis_layanan) {
            case 'wisata':
                $m_layanan='m_wisata';
                $list = $list_id_wisata; 
                break;
            case 'kamar':
                $m_layanan='m_kamar';
                $list = $list_id_kamar;
                break;
            case 'menu':
                $m_layanan='m_menu';
                $list = $list_id_menu;
                break;
            default:
                # code...
                break;
        }

        $this->load->model($m_layanan);

        $data=array();
        $list = ltrim($list,",");
        $list = explode(",", $list);
        for ($j=0; $j < count($list); $j++) { 

            if ($jenis_layanan=='wisata'){
                array_push($data,$this->$m_layanan->where('id_'.$jenis_layanan,$list[$j])->get());
            }

            if ($jenis_layanan=='kamar') {
                array_push($data,$this->m_kamar->where_id_kamar($list[$j])->with_penginapan()->get());
            }

            if ($jenis_layanan=='menu') {
                array_push($data,$this->$m_layanan->where('id_'.$jenis_layanan,$list[$j])->with_kuliner()->get());
            }
        }

        $this->response($data);
    }



    public function pesanan_backup_post(){
        $this->load->model('m_rekomendasi');

        $jenis_layanan = $this->post('jenis_layanan');
        $list_id_wisata = $this->post('list_id_wisata');
        $list_id_kamar =  $this->post('list_id_kamar');
        $list_id_menu = $this->post('list_id_menu');

        $id_user = $this->post('id_user');
        $flag = $this->post('flag');

        switch ($jenis_layanan) {
            case 'wisata':
                $m_rekomendasi='m_wisata';
                $list = $list_id_wisata;
                break;
            case 'kamar':
                $m_rekomendasi='m_kamar';
                $list = $list_id_kamar;
                break;
            case 'menu':
                $m_rekomendasi='m_menu';
                $list = $list_id_menu;
                break;
            default:
                # code...
                break;
        }

        //$data = array();
        $list = ltrim($list,",");
        $list = explode(",", $list);

        //$this->m_rekomendasi->insert('id_user' => $id_user);

        //$this->response($list[0]);

        for ($j=0; $j < count($list); $j++) {   
            if ($jenis_layanan=='wisata'){
                //$insert_data = array('id_wisata' => $list[$j]);
                $this->m_rekomendasi->insert(array('id_user' => $id_user, 'id_tujuan' => $list[$j], 'jenis_layanan' => $jenis_layanan));
            }

            if ($jenis_layanan=='kamar') {
                $this->m_rekomendasi->insert(array('id_user'=> $id_user, 'id_tujuan' => $list[$j], 'jenis_layanan' => $jenis_layanan));
                //$data = $this->m_pesanan->where('id_user', $id_user)->with_kamar()->get();
                /*$this->m_rekomendasi->insert(array('id_user' => $id_user,'id_kamar' => $list[$j]));*/
            }

            if ($jenis_layanan=='menu') {
                $this->m_rekomendasi->insert(array('id_user'=> $id_user, 'id_tujuan' => $list[$j], 'jenis_layanan' => $jenis_layanan));
                //$data = $this->m_pesanan->where('id_user', $id_user)->with_menu()->get();
                /*$this->m_pesanan->insert(array('id_user' => $id_user,'id_menu' =>$list[$j]));*/
    
            }
        }

        switch ($jenis_layanan) {
            case 'wisata':
                if($flag == null){
                    $this->response($this->m_rekomendasi->where('id_user', $id_user)->with_wisata()->get_all());
                }
                break;
            case 'kamar':
                if($flag == null){
                    $this->response($this->m_rekomendasi->where('id_user', $id_user)->with_penginapan()->get_all());
                }
                break;
            case 'menu':
                if($flag == null){
                    $this->response($this->m_rekomendasi->where('id_user', $id_user)->with_kuliner()->get_all());
                }
                break;
            default:
                # code...
                break;
        }

        
    }

    public function pesanan_post(){
        $this->load->model('m_rekomendasi');

        $jenis_layanan = $this->post('jenis_layanan');
        $id_tujuan = $this->post('id_tujuan');
        $flag = $this->post('flag');
        $id_user = $this->post('id_user');

        switch ($jenis_layanan) {
            case 'wisata':
                $m_rekomendasi='m_wisata';
                break;
            case 'kamar':
                $m_rekomendasi='m_kamar';
                break;
            case 'menu':
                $m_rekomendasi='m_menu';
                break;
            default:
                # code...
                break;
        }

        //$data = array();
        $id_tujuan = ltrim($id_tujuan,",");
        $id_tujuan = explode(",", $id_tujuan);

        //$this->m_rekomendasi->insert('id_user' => $id_user);

        //$this->response($id_tujuan[0]);

        for ($j=0; $j < count($id_tujuan); $j++) {   
            if ($jenis_layanan=='wisata'){
                //$insert_data = array('id_wisata' => $id_tujuan[$j]);
                $this->m_rekomendasi->insert(array('id_user' => $id_user, 'id_tujuan' => $id_tujuan[$j], 'jenis_layanan' => $jenis_layanan));
            }

            if ($jenis_layanan=='kamar') {
                $this->m_rekomendasi->insert(array('id_user'=> $id_user, 'id_tujuan' => $id_tujuan[$j], 'jenis_layanan' => $jenis_layanan));
                //$data = $this->m_pesanan->where('id_user', $id_user)->with_kamar()->get();
                /*$this->m_rekomendasi->insert(array('id_user' => $id_user,'id_kamar' => $id_tujuan[$j]));*/
            }

            if ($jenis_layanan=='menu') {
                $this->m_rekomendasi->insert(array('id_user'=> $id_user, 'id_tujuan' => $id_tujuan[$j], 'jenis_layanan' => $jenis_layanan));
                //$data = $this->m_pesanan->where('id_user', $id_user)->with_menu()->get();
                /*$this->m_pesanan->insert(array('id_user' => $id_user,'id_menu' =>$list[$j]));*/
    
            }
        }

        switch ($jenis_layanan) {
            case 'wisata':
                $this->response($this->m_rekomendasi->where(array('id_user'=> $id_user, 'flag' => 0))->with_wisata()->get());
                break;
            case 'kamar':
                $this->response($this->m_rekomendasi->where('id_user', $id_user)->with_penginapan()->get_all());
                break;
            case 'menu':
                $this->response($this->m_rekomendasi->where('id_user', $id_user)->with_kuliner()->get_all());
                break;
            default:
                # code...
                break;
        }

    }

    public function take_pesanan_customer_post(){
        $this->load->model('m_pesanan');

        $id_customer = $this->post('id_user');
        /*$id_driver = $this->post('id_user');
        $id_pesanan = $this->post('id_pesanan');*/
        /*$asal_lat = $this->post('asal_lat');
        $asal_lng = $this->post('asal_lng');*/

        $data = array(
            'id_customer' => $this->post('id_customer'),
            'posisi_lat'  => $this->post('posisi_lat'),
            'posisi_lng'  => $this->post('posisi_lng')

        );

        $this->m_pesanan->insert($data);
        $this->response($this->m_pesanan->where('id_customer', $id_customer )->with_rekomendasi()->get_all());
    }

    public function cek_lokasi_post(){
        $this->load->model('m_user');

        $data_customer = array(
            'id_user'       => $this->post('id_user'),
            'posisi_lat'      => $this->post('posisi_lat'),
            'posisi_lng'       => $this->post('posisi_lng'),
            'user_type'     => $this->post('user_type')
        );

        $data=$this->m_user->where($data_customer)->get();

        $posisi_lng = $this->post('posisi_lng');
        $posisi_lat = $this->post('posisi_lat');

        $tla_lat = '-8.1486486';
        $tla_lng = "111.8187383";

        if (($posisi_lat != $tla_lat) && ($posisi_lng != $tla_lng)){
            $this->response("Mohon login di Kabupaten Tulungagung");
        }else{
            $this->response($data);
        }
    }
}

    