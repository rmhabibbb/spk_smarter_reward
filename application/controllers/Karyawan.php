<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Karyawan extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
  
        $this->data['email'] = $this->session->userdata('email');
        $this->data['id_role']  = $this->session->userdata('id_role'); 
          if (!$this->data['email'] || ($this->data['id_role'] != 4))
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
    $this->data['dprofil'] = $this->Karyawan_m->get_row(['email' =>$this->data['email'] ]);  
     
    date_default_timezone_set("Asia/Jakarta");


  }

public function index()
{ 
  redirect('karyawan/laporan');
  exit();
}

   public function laporan(){
 

      if ($this->uri->segment(3)) {
        if ($this->Laporan_m->get_num_row(['id_laporan' => $this->uri->segment(3)]) == 0) {
            redirect('karyawan/penilaian');
            exit();  
        }
        
        $laporan = $this->Laporan_m->get_row(['id_laporan' => $this->uri->segment(3)]);

        if ($laporan->status == 1) {


          $smarter = $this->Penilaian_m->smarter($laporan->tahun);

          $this->data['laporan']  = $laporan;
          $this->data['nilai_akhir']  = $smarter['nilai_akhir'];
          $this->data['title']  = 'Proses Laporan';
          $this->data['index'] = 3;
          $this->data['content'] = 'karyawan/proseslaporan';
          $this->template($this->data,'karyawan');

        }else{
          $smarter = $this->Penilaian_m->smarter($laporan->tahun);

          $this->data['laporan']  = $laporan; 
          $this->data['dlaporan']  = $this->DL_m->get(['id_laporan' => $laporan->id_laporan]); 
          $this->data['title']  = 'Detail Laporan';
          $this->data['index'] = 3;
          $this->data['content'] = 'karyawan/detaillaporan';
          $this->template($this->data,'karyawan');
        } 
  
        
      } 

        
      else {
        $this->data['list_laporan'] = $this->Laporan_m->get_by_order('id_laporan','desc',['status' => 2]);   

        $this->data['title']  = 'Kelola Data Laporan';
        $this->data['index'] = 3;
        $this->data['content'] = 'karyawan/laporan';
        $this->template($this->data,'karyawan');
      }
    }  
     

    public function smarter(){
      if ($this->uri->segment(3)) {
        if ($this->Laporan_m->get_num_row(['id_laporan' => $this->uri->segment(3)]) == 0) {
            redirect('karyawan/laporan');
            exit();  
        }

        $laporan = $this->Laporan_m->get_row(['id_laporan' => $this->uri->segment(3)]);  
        $smarter = $this->Penilaian_m->smarter($laporan->tahun);
        $this->data['list_kriteria'] = $this->Kriteria_m->get();   

        $this->data['laporan']  = $laporan;
        $this->data['nilai_awal']  = $smarter['nilai_awal'];
        $this->data['nilai_utility']  = $smarter['nilai_utility'];
        $this->data['nilai_pre']  = $smarter['nilai_pre'];
        $this->data['nilai_akhir']  = $smarter['nilai_akhir'];
        $this->data['title']  = 'Detail Perhitungan SMARTER';
        $this->data['index'] = 3;
        $this->data['content'] = 'karyawan/detailsmarter';
        $this->template($this->data,'karyawan');

      }else{
        redirect('karyawan/laporan');
        exit();
      }

    }

    public function detailnilai(){
      if ($this->uri->segment(3)) {
        if ($this->Laporan_m->get_num_row(['id_laporan' => $this->uri->segment(3)]) == 0) {
            redirect('karyawan/laporan');
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
        $this->data['content'] = 'karyawan/detailnilai';
        $this->template($this->data,'karyawan');

      }else{
        redirect('karyawan/laporan');
        exit();
      }

    }
 
 
  // -----------------------------------------------------------------------------------------------------------------
    public function profil(){
       
        $this->data['title']  = 'Profil';
        $this->data['index'] = 6;
        $this->data['content'] = 'karyawan/profil';
        $this->template($this->data,'karyawan');
     }

     public function hapusfoto(){
        if ($this->data['dprofil']->jk == "Perempuan") {
                  $foto = 'karyawan/default-p.jpg';
        }else{

                  $foto = 'karyawan/default-l.jpg';
        }

        @unlink(realpath(APPPATH . '../assets/' . $this->data['dprofil']->foto));
        $this->Karyawan_m->update($this->data['dprofil']->id_karyawan,['foto' => $foto]); 

        $this->flashmsg('Foto berhasil di hapus!', 'success');
            redirect('karyawan/profil');
            exit();    
     }
    public function proses_edit_profil(){
      if ($this->POST('edit')) {
      
          $email_x = $this->POST('email_x');
            $email = $this->POST('email');
            $id_karyawan = $this->POST('id_karyawan'); 
            if ($this->login_m->get_num_row(['email' => $email]) != 0 && $email_x != $email) {
              $this->flashmsg('Email telah digunakan!', 'warning');
              redirect('karyawan/profil/');
              exit();   
            }  
            $data = [    
              'email' => $email  
            ];
            $this->login_m->update($email_x,$data); 

            $user_session = [
              'email' => $this->POST('email'),  
            ];
            $this->session->set_userdata($user_session);

            $karyawan = $this->Karyawan_m->get_row(['id_karyawan' => $id_karyawan]);
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
          'nama_karyawan' => $this->POST('nama_karyawan') ,
          'jk' => $this->POST('jk') ,
          'tl' => $this->POST('tl') ,
          'alamat' => $this->POST('alamat') ,
          'jabatan' => $this->POST('jabatan') ,
          'no_hp' => $this->POST('no_hp'), 
          'foto' => $foto
        ];
        $this->Karyawan_m->update($id_karyawan,$data); 
 
  
          $this->flashmsg('PROFIL BERHASIL DISIMPAN!', 'success');
          redirect('karyawan/profil');
          exit();

          } elseif ($this->POST('edit2')) { 
            $data = [ 
              'password' => md5($this->POST('password')) 
            ];
            
            $this->login_m->update($this->data['email'],$data);
        
            $this->flashmsg('KATA SANDI BARU TELAH TERSIMPAN!', 'success');
            redirect('karyawan/profil');
            exit();    
          }  

          else{

          redirect('karyawan/profil');
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
