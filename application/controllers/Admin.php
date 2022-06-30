<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Admin extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
  
        $this->data['email'] = $this->session->userdata('email');
        $this->data['id_role']  = $this->session->userdata('id_role'); 
          if (!$this->data['email'] || ($this->data['id_role'] != 1))
          {
            $this->flashmsg('<i class="glyphicon glyphicon-remove"></i> Anda harus login terlebih dahulu', 'danger');
            redirect('login');
            exit;
          }  
    
    $this->load->model('login_m'); 
    $this->load->model('register_m');   
    $this->load->model('Karyawan_m');  
    $this->load->model('Pengawas_m');   
    $this->load->model('Subkriteria_m');     
    $this->load->model('Kriteria_m');    
    $this->load->model('Penilaian_m');    
    $this->load->model('DP_m');  
    $this->load->model('Laporan_m');    
    $this->load->model('DL_m');  
    
    $this->data['profil'] = $this->login_m->get_row(['email' =>$this->data['email'] ]); 
     
    date_default_timezone_set("Asia/Jakarta");


  }

public function index()
{ 

      $this->data['title']  = 'Beranda'; 
      $this->data['index'] = 1;
      $this->data['content'] = 'admin/dashboard';
      $this->template($this->data,'admin');
}
 

// KELOLA KRITERA ----------------------------------------------------------------------------

    public function kriteria(){
      if ($this->POST('tambah')) {    
        $prioritas = $this->Kriteria_m->get_prioritas() + 1; 
        $data = [   
          'nama_kriteria' => $this->POST('nama_kriteria') ,
          'prioritas' => $prioritas
        ];
        $this->Kriteria_m->insert($data); 
        $id = $this->Kriteria_m->get_row(['nama_kriteria' => $this->POST('nama')])->id_kriteria; 

        $this->flashmsg('KRITERA BERHASIL DITAMBAH!', 'success');
        redirect('admin/kriteria/'.$id);
        exit();    
      }  

      if ($this->POST('edit')) { 
        $data = [    
          'nama_kriteria' => $this->POST('nama_kriteria') 
        ];

        $this->Kriteria_m->update($this->POST('id_kriteria'),$data);

        $this->flashmsg('DATA BERHASIL TERSIMPAN!', 'success');
        redirect('admin/kriteria/'.$this->POST('id_kriteria'));
        exit();    
      } 

      if ($this->POST('hapus')) { 
        $id_kriteria = $this->POST('id_kriteria');
        $kriteria = $this->Kriteria_m->get_row(['id_kriteria' => $id_kriteria]);
        $list = $this->Kriteria_m->get(['prioritas >' => $kriteria->prioritas]); 
        
           
        $this->Kriteria_m->delete($id_kriteria);

        $i = 0;
        foreach ($list as $k) {
          $this->Kriteria_m->update($k->id_kriteria,['prioritas' => $kriteria->prioritas + $i]);
          $i++;
        }

        $this->flashmsg('Kriteria berhasil dihapus!', 'success');
        redirect('admin/kriteria/');
        exit();    
      } 

       

      if ($this->uri->segment(3)) {
        if ($this->Kriteria_m->get_num_row(['id_kriteria' => $this->uri->segment(3)]) == 1) {
          $this->data['kriteria'] = $this->Kriteria_m->get_row(['id_kriteria' => $this->uri->segment(3)]);   
          $this->data['list_sub'] = $this->Subkriteria_m->get_by_order('prioritas','asc',['id_kriteria' => $this->uri->segment(3) ]);   
          $this->data['list_kriteria'] = $this->Kriteria_m->get_by_order('prioritas','asc',[]);   
          $this->data['min_prio'] = $this->Subkriteria_m->min_prio($this->uri->segment(3));  
          $this->data['max_prio'] = $this->Subkriteria_m->max_prio($this->uri->segment(3));    
 
           
          $this->data['title']  = 'Kelola Kriteria - '.$this->data['kriteria']->nama_kriteria .'';
          $this->data['index'] = 5;
          $this->data['content'] = 'admin/detailkriteria';
          $this->template($this->data,'admin'); 
        }else {
          redirect('admin/kriteria');
          exit();
        }
      }

     
      else {
        $this->data['list_kriteria'] = $this->Kriteria_m->get_by_order('prioritas','asc',[]);  
        $this->data['min_prio'] = $this->Kriteria_m->min_prio();  
        $this->data['max_prio'] = $this->Kriteria_m->max_prio();   

        $this->data['title']  = 'Kelola Data Kriteria';
        $this->data['index'] = 5;
        $this->data['content'] = 'admin/kriteria';
        $this->template($this->data,'admin');
      }
    } 

    public function kriteriaup(){
      if ($this->uri->segment(3)) {
        $prioritas =  $this->uri->segment(3);
        $temp = $this->Kriteria_m->get_row(['prioritas' => $prioritas - 1]);
        $x = $this->Kriteria_m->get_row(['prioritas' => $prioritas]);
        $this->Kriteria_m->update($x->id_kriteria, ['prioritas' => $temp->prioritas]);
        $this->Kriteria_m->update($temp->id_kriteria, ['prioritas' => $prioritas]);
        redirect('admin/kriteria');
        exit();
      }else{
        redirect('admin/kriteria');
        exit();
      }
    }

    public function kriteriadown(){
      if ($this->uri->segment(3)) {
        $prioritas =  $this->uri->segment(3);
        $temp = $this->Kriteria_m->get_row(['prioritas' => $prioritas + 1]);
        $x = $this->Kriteria_m->get_row(['prioritas' => $prioritas]);
        $this->Kriteria_m->update($x->id_kriteria, ['prioritas' => $temp->prioritas]);
        $this->Kriteria_m->update($temp->id_kriteria, ['prioritas' => $prioritas]);
        redirect('admin/kriteria');
        exit();
      }else{
        redirect('admin/kriteria');
        exit();
      }
    }

    public function subkriteria(){
      if ($this->POST('tambah')) {    
        $prioritas = $this->Subkriteria_m->get_prioritas($this->POST('id_kriteria')) + 1; 
        $data = [   
          'keterangan' => $this->POST('keterangan') ,
          'prioritas' => $prioritas,
          'id_kriteria' => $this->POST('id_kriteria')
        ];
        $this->Subkriteria_m->insert($data);
        $id = $this->db->insert_id();

        $this->flashmsg('SUB KRITERA BERHASIL DITAMBAH!', 'success');
        redirect('admin/kriteria/'.$this->POST('id_kriteria'));
        exit();  
      }  

      if ($this->POST('edit')) { 
         $data = [   
          'keterangan' => $this->POST('ket') 
        ];

        $this->Subkriteria_m->update($this->POST('id_sub'),$data);

        $this->flashmsg('DATA BERHASIL TERSIMPAN!', 'success');
        redirect('admin/kriteria/'.$this->POST('id_kriteria'));
        exit();    
      } 

      if ($this->POST('hapus')) {   
        $id_kriteria = $this->POST('id_kriteria');
        $id_sub = $this->POST('id_sub');
        $sub = $this->Subkriteria_m->get_row(['id_sub' => $id_sub]);
        $list = $this->Subkriteria_m->get(['id_kriteria' => $id_kriteria, 'prioritas >' => $sub->prioritas]); 
        
           
        $this->Subkriteria_m->delete($id_sub);

        $i = 0;
        foreach ($list as $k) {
          $this->Subkriteria_m->update($k->id_sub,['prioritas' => $sub->prioritas + $i]);
          $i++;
        }

 
        $this->flashmsg('SUB KRITERA BERHASIL DIHAPUS!', 'success');
        redirect('admin/kriteria/'.$this->POST('id_kriteria'));
        exit();    
      }  
    } 

    public function subup(){
      if ($this->uri->segment(3)) {
        $prioritas =  $this->uri->segment(3);
        $id_kriteria =  $this->uri->segment(4);
        $temp = $this->Subkriteria_m->get_row(['id_kriteria' => $id_kriteria, 'prioritas' => $prioritas - 1]);
        $x = $this->Subkriteria_m->get_row(['id_kriteria' => $id_kriteria, 'prioritas' => $prioritas]);
        $this->Subkriteria_m->update($x->id_sub, ['prioritas' => $temp->prioritas]);
        $this->Subkriteria_m->update($temp->id_sub, ['prioritas' => $prioritas]);
        redirect('admin/kriteria/'. $id_kriteria);
        exit();
      }else{
        redirect('admin/kriteria');
        exit();
      }
    }

    public function subdown(){
      if ($this->uri->segment(3)) {
        $prioritas =  $this->uri->segment(3);
        $id_kriteria =  $this->uri->segment(4);
        $temp = $this->Subkriteria_m->get_row(['id_kriteria' => $id_kriteria, 'prioritas' => $prioritas + 1]);
        $x = $this->Subkriteria_m->get_row(['id_kriteria' => $id_kriteria, 'prioritas' => $prioritas]);
        $this->Subkriteria_m->update($x->id_sub, ['prioritas' => $temp->prioritas]);
        $this->Subkriteria_m->update($temp->id_sub, ['prioritas' => $prioritas]);
        redirect('admin/kriteria/'. $id_kriteria);
      }else{
        redirect('admin/kriteria');
        exit();
      }
    }
     
// KELOLA KRITERIA ---------------------------------------------------------------------
 
 
 // KELOLA PENGAWAS ----------------------------------------------------------------------------

    public function pengawas(){
      if ($this->POST('tambah')) { 
        if ($this->login_m->get_num_row(['email' => $this->POST('email')]) != 0) {
          $this->flashmsg('Email telah digunakan!', 'warning');
          redirect('admin/formpengawas/');
          exit();   
        }  
        $data = [    
          'email' => $this->POST('email') ,
          'password' => md5($this->POST('password')) , 
          'role' => 2
        ];
        $this->login_m->insert($data); 

        $data = [    
          'nama_pengawas' => $this->POST('nama_pengawas') ,
          'jk' => $this->POST('jk') ,
          'no_hp' => $this->POST('no_hp'),
          'email' => $this->POST('email') 
        ];
        $this->Pengawas_m->insert($data); 
        $id = $this->db->insert_id();
        $this->flashmsg('DATA PENGAWAS BERHASIL DITAMBAH!', 'success');
        redirect('admin/pengawas/'.$id);
        exit();    
      }  

      if ($this->POST('edit')) { 
        
        $email_x = $this->POST('email_x');
        $email = $this->POST('email');
        $id_pengawas = $this->POST('id_pengawas');
        if ($this->login_m->get_num_row(['email' => $email]) != 0 && $email_x != $email) {
          $this->flashmsg('Email telah digunakan!', 'warning');
          redirect('admin/pengawas/'.$id_pengawas);
          exit();   
        }  
        $data = [    
          'email' => $email  
        ];
        $this->login_m->update($email_x,$data); 

        $data = [    
          'nama_pengawas' => $this->POST('nama_pengawas') ,
          'jk' => $this->POST('jk') ,
          'no_hp' => $this->POST('no_hp') 
        ];
        $this->Pengawas_m->update($id_pengawas,$data); 

        $this->flashmsg('DATA BERHASIL TERSIMPAN!', 'success');
        redirect('admin/pengawas/'.$id_pengawas);
        exit();    
      } 

      if ($this->POST('edit2')) {  


        $data = [     
          'password' => md5($this->POST('password')) 
        ];
        $this->login_m->update($this->POST('email'),$data); 

        $this->flashmsg('Password berhasil diganti!', 'success');
        redirect('admin/pengawas/'.$this->POST('id_pengawas'));
        exit();    
      } 

      if ($this->POST('hapus')) {
        $this->login_m->delete($this->POST('email'));
         $this->flashmsg('DATA PENGAWAS BERHASIL DIHAPUS!', 'success');
        redirect('admin/pengawas/' );
        exit(); 

      } 

      if ($this->uri->segment(3)) {
        if ($this->Pengawas_m->get_num_row(['id_pengawas' => $this->uri->segment(3)]) == 1) {
          $this->data['pengawas'] = $this->Pengawas_m->get_row(['id_pengawas' => $this->uri->segment(3)]);    
           

          $this->data['title']  =  $this->data['pengawas']->nama_pengawas .' - Kelola Data Pengawas';
          $this->data['index'] = 4; 
          $this->data['content'] = 'admin/detailpengawas';
          $this->template($this->data,'admin'); 
        }else {
          redirect('admin/pengawas');
          exit();
        }
      }

     
      else {
        $this->data['list_pengawas'] = $this->Pengawas_m->get();  


        $this->data['title']  = 'Kelola Data Pengawas';
        $this->data['index'] = 4;
        $this->data['content'] = 'admin/pengawas';
        $this->template($this->data,'admin');
      }
    } 
 
    public function formpengawas(){
 
      $this->data['title']  = 'Tambah Data Pengawas';
      $this->data['index'] = 4;
      $this->data['content'] = 'admin/form-tambahpengawas';
      $this->template($this->data,'admin');
      
    } 
// KELOLA PENGAWAS ---------------------------------------------------------------------
 
// KELOLA KARYAWAN ----------------------------------------------------------------------------

    public function karyawan(){
      if ($this->POST('tambah')) { 
        if ($this->login_m->get_num_row(['email' => $this->POST('email')]) != 0) {
          $this->flashmsg('Email telah digunakan!', 'warning');
          redirect('admin/formkaryawan/');
          exit();   
        }  
        $data = [    
          'email' => $this->POST('email') ,
          'password' => md5($this->POST('password')) , 
          'role' => 4
        ];
        $this->login_m->insert($data); 

        if ($_FILES['foto']['name'] !== '') { 
          $files = $_FILES['foto'];
          $_FILES['foto']['name'] = $files['name'];
          $_FILES['foto']['type'] = $files['type'];
          $_FILES['foto']['tmp_name'] = $files['tmp_name'];
          $_FILES['foto']['size'] = $files['size'];

          $id_foto = rand(1,9);
          for ($j=1; $j <= 5 ; $j++) {
            $id_foto .= rand(0,9);
          }  
          $this->upload($id_foto, 'karyawan/','foto');     
          $foto = 'karyawan/'.$id_foto.'.jpg';
        }else{   
          if ($this->POST('jk') == "Perempuan") {
            $foto = 'karyawan/default-p.jpg';
          }else{ 
            $foto = 'karyawan/default-l.jpg';
          }
        }

        $data = [    
          'id_karyawan' => $this->POST('id_karyawan'),
          'nama_karyawan' => $this->POST('nama_karyawan') ,
          'jk' => $this->POST('jk') ,
          'tl' => $this->POST('tl') ,
          'alamat' => $this->POST('alamat') ,
          'jabatan' => $this->POST('jabatan') ,
          'no_hp' => $this->POST('no_hp'),
          'email' => $this->POST('email'),
          'foto' => $foto
        ];
        $this->Karyawan_m->insert($data);  
        $this->flashmsg('DATA KARYAWAN BERHASIL DITAMBAH!', 'success');
        redirect('admin/karyawan/'.$this->POST('id_karyawan'));
        exit();    
      }  

      if ($this->POST('edit')) { 
        
        $email_x = $this->POST('email_x');
        $email = $this->POST('email');
        $id_karyawan = $this->POST('id_karyawan');
        $id_karyawan_x = $this->POST('id_karyawan_x');
        if ($this->login_m->get_num_row(['email' => $email]) != 0 && $email_x != $email) {
          $this->flashmsg('Email telah digunakan!', 'warning');
          redirect('admin/karyawan/'.$id_karyawan);
          exit();   
        }  
        $data = [    
          'email' => $email  
        ];
        $this->login_m->update($email_x,$data); 

        $karyawan = $this->Karyawan_m->get_row(['id_karyawan' => $id_karyawan_x]);
        if ($_FILES['foto']['name'] !== '') { 
          $files = $_FILES['foto'];
          $_FILES['foto']['name'] = $files['name'];
          $_FILES['foto']['type'] = $files['type'];
          $_FILES['foto']['tmp_name'] = $files['tmp_name'];
          $_FILES['foto']['size'] = $files['size'];

          $id_foto = rand(1,9);
          for ($j=1; $j <= 5 ; $j++) {
            $id_foto .= rand(0,9);
          }  
          @unlink(realpath(APPPATH . '../assets/' . $karyawan->foto));
          $this->upload($id_foto, 'karyawan/','foto');     
          $foto = 'karyawan/'.$id_foto.'.jpg';
        }else{   
          if ($karyawan->foto == 'karyawan/default-p.jpg' || $karyawan->foto == 'karyawan/default-l.jpg') {
            if ($this->POST('jk') == "Perempuan") {
              $foto = 'karyawan/default-p.jpg';
            }else{ 
              $foto = 'karyawan/default-l.jpg';
            }
          }else {
            $foto = $karyawan->foto;
          }
        }


        $data = [    
          'id_karyawan' => $this->POST('id_karyawan') ,
          'nama_karyawan' => $this->POST('nama_karyawan') ,
          'jk' => $this->POST('jk') ,
          'tl' => $this->POST('tl') ,
          'alamat' => $this->POST('alamat') ,
          'jabatan' => $this->POST('jabatan') ,
          'no_hp' => $this->POST('no_hp'), 
          'foto' => $foto
        ];
        $this->Karyawan_m->update($id_karyawan_x,$data); 

        $this->flashmsg('DATA BERHASIL TERSIMPAN!', 'success');
        redirect('admin/karyawan/'.$id_karyawan);
        exit();    
      } 

      if ($this->POST('edit2')) {  


        $data = [     
          'password' => md5($this->POST('password')) 
        ];
        $this->login_m->update($this->POST('email'),$data); 

        $this->flashmsg('Password berhasil diganti!', 'success');
        redirect('admin/karyawan/'.$this->POST('id_karyawan'));
        exit();    
      } 

      if ($this->POST('hapus')) {
        $this->login_m->delete($this->POST('email'));
         $this->flashmsg('DATA KARYAWAN BERHASIL DIHAPUS!', 'success');
        redirect('admin/karyawan/' );
        exit(); 

      } 

      if ($this->uri->segment(3)) {
        if ($this->Karyawan_m->get_num_row(['id_karyawan' => $this->uri->segment(3)]) == 1) {
          $this->data['karyawan'] = $this->Karyawan_m->get_row(['id_karyawan' => $this->uri->segment(3)]);    
           

          $this->data['title']  =  $this->data['karyawan']->nama_karyawan .' - Kelola Data karyawan';
          $this->data['index'] = 4; 
          $this->data['content'] = 'admin/detailkaryawan';
          $this->template($this->data,'admin'); 
        }else {
          redirect('admin/karyawan');
          exit();
        }
      }

     
      else {
        $this->data['list_karyawan'] = $this->Karyawan_m->get();  


        $this->data['title']  = 'Kelola Data Karyawan';
        $this->data['index'] = 3;
        $this->data['content'] = 'admin/karyawan';
        $this->template($this->data,'admin');
      }
    } 
 
    public function formkaryawan(){
 
      $this->data['title']  = 'Tambah Data Karyawan';
      $this->data['index'] = 3;
      $this->data['content'] = 'admin/form-tambahkaryawan';
      $this->template($this->data,'admin');
      
    } 
// KELOLA KARYAWAN ---------------------------------------------------------------------
 
 
 
  // -----------------------------------------------------------------------------------------------------------------
       public function profil(){
       
        $this->data['title']  = 'Profil';
        $this->data['index'] = 6;
        $this->data['content'] = 'admin/profil';
        $this->template($this->data,'admin');
     }
    public function proses_edit_profil(){
      if ($this->POST('edit')) {
      
          
          $this->login_m->update($this->POST('email_x'),['email' => $this->POST('email')   ]);    
          $user_session = [
            'email' => $this->POST('email'),  
          ];
          $this->session->set_userdata($user_session);
 
  
          $this->flashmsg('PROFIL BERHASIL DISIMPAN!', 'success');
          redirect('admin/profil');
          exit();

          } elseif ($this->POST('edit2')) { 
            $data = [ 
              'password' => md5($this->POST('password')) 
            ];
            
            $this->login_m->update($this->data['email'],$data);
        
            $this->flashmsg('KATA SANDI BARU TELAH TERSIMPAN!', 'success');
            redirect('admin/profil');
            exit();    
          }  

          else{

          redirect('admin/profil');
          exit();
          }

    }

    public function loadnklinik(){
      if ($this->Klinik_m->get_num_row(['status' => 0]) != 0) {
       echo   $this->Klinik_m->get_num_row(['status' => 0]) . ' Klinik baru';
      }
    }

    public function cekpasslama(){ echo $this->login_m->cekpasslama($this->data['email'],$this->input->post('pass')); } 
    public function cekpass(){ echo $this->login_m->cek_password_length($this->input->post('pass1')); }
    public function cekpass2(){ echo $this->login_m->cek_passwords($this->input->post('pass1'),$this->input->post('pass2')); }

 
}

 ?>
