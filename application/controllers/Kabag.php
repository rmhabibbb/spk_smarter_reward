<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Kabag extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
  
        $this->data['email'] = $this->session->userdata('email');
        $this->data['id_role']  = $this->session->userdata('id_role'); 
          if (!$this->data['email'] || ($this->data['id_role'] != 3))
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
  redirect('kabag/laporan');
  exit();
}

   public function laporan(){
 
      if ($this->uri->segment(3)) {
        if ($this->Laporan_m->get_num_row(['id_laporan' => $this->uri->segment(3)]) == 0) {
            redirect('kabag/penilaian');
            exit();  
        }
        
        $laporan = $this->Laporan_m->get_row(['id_laporan' => $this->uri->segment(3)]);

        if ($laporan->status == 1) {


          $smarter = $this->Penilaian_m->smarter($laporan->tahun);

          $this->data['laporan']  = $laporan;
          $this->data['nilai_akhir']  = $smarter['nilai_akhir'];
          $this->data['title']  = 'Proses Laporan';
          $this->data['index'] = 3;
          $this->data['content'] = 'kabag/proseslaporan';
          $this->template($this->data,'kabag');

        }else{
          $smarter = $this->Penilaian_m->smarter($laporan->tahun);

          $this->data['laporan']  = $laporan; 
          $this->data['dlaporan']  = $this->DL_m->get(['id_laporan' => $laporan->id_laporan]); 
          $this->data['title']  = 'Detail Laporan';
          $this->data['index'] = 3;
          $this->data['content'] = 'kabag/detaillaporan';
          $this->template($this->data,'kabag');
        } 
  
        
      } 

        
      else {
        $this->data['list_laporan'] = $this->Laporan_m->get_by_order('id_laporan','desc',['status' => 2]); 

        $this->data['title']  = 'Kelola Data Laporan';
        $this->data['index'] = 3;
        $this->data['content'] = 'kabag/laporan';
        $this->template($this->data,'kabag');
      }
    }  
     

    public function smarter(){
      if ($this->uri->segment(3)) {
        if ($this->Laporan_m->get_num_row(['id_laporan' => $this->uri->segment(3)]) == 0) {
            redirect('kabag/laporan');
            exit();  
        }


        $laporan = $this->Laporan_m->get_row(['id_laporan' => $this->uri->segment(3)]);  
        $smarter = $this->Penilaian_m->smarter($laporan->tahun);
        $this->data['list_kriteria'] = $this->Kriteria_m->get();  
        $this->data['min_prio'] = $this->Kriteria_m->min_prio();  
        $this->data['max_prio'] = $this->Kriteria_m->max_prio();   
        $this->data['list_karyawan'] = $this->Karyawan_m->get(); 

        $this->data['laporan']  = $laporan;
        $this->data['nilai_awal']  = $smarter['nilai_awal'];
        $this->data['nilai_utility']  = $smarter['nilai_utility'];
        $this->data['nilai_pre']  = $smarter['nilai_pre'];
        $this->data['nilai_akhir']  = $smarter['nilai_akhir'];
        $this->data['title']  = 'Detail Perhitungan SMARTER';
        $this->data['index'] = 3;
        $this->data['content'] = 'kabag/detailsmarter';
        $this->template($this->data,'kabag');

      }else{
        redirect('kabag/laporan');
        exit();
      }

    }

    public function detailnilai(){
      if ($this->uri->segment(3)) {
        if ($this->Laporan_m->get_num_row(['id_laporan' => $this->uri->segment(3)]) == 0) {
            redirect('kabag/laporan');
            exit();  
        }

        $laporan = $this->Laporan_m->get_row(['id_laporan' => $this->uri->segment(3)]);  
        $smarter = $this->Penilaian_m->smarter($laporan->tahun);
        $this->data['list_kriteria'] = $this->Kriteria_m->get();   
        $this->data['list_penilaian'] = $this->Penilaian_m->get(['tahun' => $laporan->tahun, 'status' => 2]);   

        $this->data['laporan']  = $laporan; 
        $this->data['karyawan']  = $this->Karyawan_m->get_row(['id_karyawan' => $this->uri->segment(4)]); 
        $this->data['title']  = 'Detail Nilai Bulanan';
        $this->data['index'] = 3;
        $this->data['content'] = 'kabag/detailnilai';
        $this->template($this->data,'kabag');

      }else{
        redirect('kabag/laporan');
        exit();
      }

    }
 
 
  // -----------------------------------------------------------------------------------------------------------------
   
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
        redirect('kabag/kriteria/'.$id);
        exit();    
      }  

      if ($this->POST('edit')) { 
        $data = [    
          'nama_kriteria' => $this->POST('nama_kriteria') 
        ];

        $this->Kriteria_m->update($this->POST('id_kriteria'),$data);

        $this->flashmsg('DATA BERHASIL TERSIMPAN!', 'success');
        redirect('kabag/kriteria/'.$this->POST('id_kriteria'));
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
        redirect('kabag/kriteria/');
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
          $this->data['content'] = 'kabag/detailkriteria';
          $this->template($this->data,'kabag'); 
        }else {
          redirect('kabag/kriteria');
          exit();
        }
      }

     
      else {
        $this->data['list_kriteria'] = $this->Kriteria_m->get_by_order('prioritas','asc',[]);  
        $this->data['min_prio'] = $this->Kriteria_m->min_prio();  
        $this->data['max_prio'] = $this->Kriteria_m->max_prio();   

        $this->data['title']  = 'Kelola Data Kriteria';
        $this->data['index'] = 5;
        $this->data['content'] = 'kabag/kriteria';
        $this->template($this->data,'kabag');
      }
    } 

    public function kriteriaup(){
      if ($this->uri->segment(3)) {
        $prioritas =  $this->uri->segment(3);
        $temp = $this->Kriteria_m->get_row(['prioritas' => $prioritas - 1]);
        $x = $this->Kriteria_m->get_row(['prioritas' => $prioritas]);
        $this->Kriteria_m->update($x->id_kriteria, ['prioritas' => $temp->prioritas]);
        $this->Kriteria_m->update($temp->id_kriteria, ['prioritas' => $prioritas]);
        redirect('kabag/kriteria');
        exit();
      }else{
        redirect('kabag/kriteria');
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
        redirect('kabag/kriteria');
        exit();
      }else{
        redirect('kabag/kriteria');
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
        redirect('kabag/kriteria/'.$this->POST('id_kriteria'));
        exit();  
      }  

      if ($this->POST('edit')) { 
         $data = [   
          'keterangan' => $this->POST('ket') 
        ];

        $this->Subkriteria_m->update($this->POST('id_sub'),$data);

        $this->flashmsg('DATA BERHASIL TERSIMPAN!', 'success');
        redirect('kabag/kriteria/'.$this->POST('id_kriteria'));
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
        redirect('kabag/kriteria/'.$this->POST('id_kriteria'));
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
        redirect('kabag/kriteria/'. $id_kriteria);
        exit();
      }else{
        redirect('kabag/kriteria');
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
        redirect('kabag/kriteria/'. $id_kriteria);
      }else{
        redirect('kabag/kriteria');
        exit();
      }
    }
     
// KELOLA KRITERIA ---------------------------------------------------------------------
 
 

       public function profil(){
       
        $this->data['title']  = 'Profil';
        $this->data['index'] = 6;
        $this->data['content'] = 'kabag/profil';
        $this->template($this->data,'kabag');
     }
    public function proses_edit_profil(){
      if ($this->POST('edit')) {
      
          
          $this->login_m->update($this->POST('email_x'),['email' => $this->POST('email')   ]);  

          $data = [
            'nama_pengawas' => $this->POST('nama_pengawas'),
            'jk' => $this->POST('jk'),
            'no_hp' => $this->POST('no_hp') 
          ];  

          $this->Pengawas_m->update($this->POST('id_pengawas'),$data);
          $user_session = [
            'email' => $this->POST('email'),  
          ];
          $this->session->set_userdata($user_session);
 
  
          $this->flashmsg('PROFIL BERHASIL DISIMPAN!', 'success');
          redirect('kabag/profil');
          exit();

          } elseif ($this->POST('edit2')) { 
            $data = [ 
              'password' => md5($this->POST('password')) 
            ];
            
            $this->login_m->update($this->data['email'],$data);
        
            $this->flashmsg('KATA SANDI BARU TELAH TERSIMPAN!', 'success');
            redirect('kabag/profil');
            exit();    
          }  

          else{

          redirect('kabag/profil');
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
