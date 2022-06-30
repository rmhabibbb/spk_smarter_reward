<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Pengawas extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
  
        $this->data['email'] = $this->session->userdata('email');
        $this->data['id_role']  = $this->session->userdata('id_role'); 
          if (!$this->data['email'] || ($this->data['id_role'] != 2))
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
    $this->data['dprofil'] = $this->Pengawas_m->get_row(['email' =>$this->data['email'] ]); 
     
    date_default_timezone_set("Asia/Jakarta");


  }

public function index()
{ 

      $this->data['list_karyawan'] = $this->Karyawan_m->get();   
      $this->data['list_penilaian'] = $this->Penilaian_m->get_by_order('id_penilaian','desc',['status' =>1]);   
      $this->data['title']  = 'Beranda'; 
      $this->data['index'] = 1;
      $this->data['content'] = 'pengawas/dashboard';
      $this->template($this->data,'pengawas');
}

public function inputnilai()
{   
    if ($this->POST('input')) {
      $list_kriteria = $this->Kriteria_m->get();
        $id_penilaian = $this->POST('id_penilaian');
        $id_karyawan = $this->POST('id_karyawan');
        foreach ($list_kriteria as $v) { 

            $n = sizeof($this->Subkriteria_m->get(['id_kriteria' => $v->id_kriteria]));
              $prio = $this->Subkriteria_m->get_row(['id_sub' => $this->POST('kriteria_'.$v->id_kriteria)])->prioritas;
             $x = 1;
             for ($i=1; $i <= $n ; $i++) {  
              $z = 0;
              
              if ($i == $prio) {
                for ($j = $x ; $j <= $n ; $j++) { 
                  $z = $z + (1/$j);
                }
                $z = $z/$n;
                $nilai =  number_format($z,4);
              }
              $x++;
            }

            $data = [
              'id_kriteria' => $v->id_kriteria,
              'id_penilaian' => $id_penilaian,
              'id_karyawan' => $id_karyawan,
              'sub' => $this->POST('kriteria_'.$v->id_kriteria),
              'nilai' => $nilai,
              'keterangan' => $this->Subkriteria_m->get_row(['id_sub' => $this->POST('kriteria_'.$v->id_kriteria)])->keterangan,
              'id_pengawas' => $this->data['dprofil']->id_pengawas
            ];
            $this->DP_m->insert($data); 
        }

        $this->flashmsg('NILAI BERHASIL DIINPUT!', 'success');
          redirect('pengawas/inputnilai/'.$id_penilaian);
          exit(); 


    }
    if ($this->POST('edit')) {
        $list_kriteria = $this->Kriteria_m->get();
        $id_penilaian = $this->POST('id_penilaian');
        $id_karyawan = $this->POST('id_karyawan');
        $this->DP_m->delete_by(['id_penilaian' => $id_penilaian,'id_karyawan' => $id_karyawan]);

        foreach ($list_kriteria as $v) { 

              $n = sizeof($this->Subkriteria_m->get(['id_kriteria' => $v->id_kriteria]));
              $prio = $this->Subkriteria_m->get_row(['id_sub' => $this->POST('kriteria_'.$v->id_kriteria)])->prioritas;
             $x = 1;
             for ($i=1; $i <= $n ; $i++) {  
              $z = 0;
              
              if ($i == $prio) {
                for ($j = $x ; $j <= $n ; $j++) { 
                  $z = $z + (1/$j);
                }
                $z = $z/$n;
                $nilai =  number_format($z,4);
              }
              $x++;
            }
 


            $data = [
              'id_kriteria' => $v->id_kriteria,
              'id_penilaian' => $id_penilaian,
              'id_karyawan' => $id_karyawan,
              'sub' => $this->POST('kriteria_'.$v->id_kriteria),
              'nilai' => $nilai,
              'keterangan' => $this->Subkriteria_m->get_row(['id_sub' => $this->POST('kriteria_'.$v->id_kriteria)])->keterangan,
              'id_pengawas' => $this->data['dprofil']->id_pengawas
            ];
            $this->DP_m->insert($data); 
        }

        $this->flashmsg('NILAI BERHASIL DIEDIT!', 'success');
          redirect('pengawas/inputnilai/'.$id_penilaian);
          exit();  
    }
    if ($this->POST('hapus')) { 
        $id_penilaian = $this->POST('id_penilaian');
        $id_karyawan = $this->POST('id_karyawan'); 
        $this->DP_m->delete_by(['id_penilaian' => $id_penilaian,'id_karyawan' => $id_karyawan]);
        $this->flashmsg('NILAI BERHASIL DIHAPUS!', 'success');
          redirect('pengawas/inputnilai/'.$id_penilaian);
          exit();  
    }

    if ($this->POST('selesai')) { 
        $id_penilaian = $this->POST('id_penilaian'); 
        $this->Penilaian_m->update($id_penilaian,['status' => 2]);
        $this->flashmsg('TAHAP PENILAIAN BERHASIL DITUTUP!', 'success');
        redirect('pengawas/penilaian/'.$id_penilaian);
        exit();  
    }
    if ($this->uri->segment(3)) {
      if ($this->Penilaian_m->get_num_row(['id_penilaian' => $this->uri->segment(3)]) == 0) {
        redirect('pengawas/');
        exit();  
      }

      $this->data['penilaian'] = $this->Penilaian_m->get_row(['id_penilaian' => $this->uri->segment(3)]);  
      $this->data['list_dp'] = $this->DP_m->get(['id_penilaian' => $this->uri->segment(3)]);  
      $this->data['list_kriteria'] = $this->Kriteria_m->get();   
      $this->data['list_karyawan'] = $this->Karyawan_m->get();   
      $x = 0;
      foreach ($this->data['list_karyawan'] as $k) {
        if ($this->DP_m->get_num_row(['id_karyawan' => $k->id_karyawan,'id_penilaian' => $this->uri->segment(3)]) != 0) { 
          $x++;
        }
      }
      $this->data['x'] = $x;
      $this->data['title']  = $this->uri->segment(3) . ' - Input Nilai'; 
      $this->data['index'] = 1;
      $this->data['content'] = 'pengawas/inputnilai';
      $this->template($this->data,'pengawas');

    }else{
      redirect('pengawas/');
      exit();    
    }
       
}

// KELOLA PENILAIAN ----------------------------------------------------------------------------

    public function penilaian(){

      if ($this->POST('tambah')) {    

        if ($this->Penilaian_m->get_num_row(['bulan' => $this->POST('bulan'), 'tahun' => $this->POST('tahun')]) != 0) {
          $this->flashmsg('DATA PENILAIAN PADA BULAN INI TELAH ADA!', 'warning');
          redirect('pengawas/penilaian/');
          exit();  
        }

        $data = [   
          'bulan' => $this->POST('bulan') ,
          'tahun' => $this->POST('tahun') ,
          'status' => 1
        ];
        $this->Penilaian_m->insert($data); 
        $id = $this->db->insert_id(); 

        $this->flashmsg('DATA PENILAIAN BERHASIL DITAMBAH!', 'success');
        redirect('pengawas/inputnilai/'.$id  );
        exit();    
      }elseif ($this->POST('hapus')) {  
        $this->Penilaian_m->delete($this->POST('id_penilaian'));
 
        $this->flashmsg('Penilaian berhasil dihapus!', 'success');
        redirect('pengawas/');
        exit();    
      }   

      if ($this->uri->segment(3)) {
        if ($this->Penilaian_m->get_num_row(['id_penilaian' => $this->uri->segment(3)]) == 0) {
            redirect('pengawas/penilaian');
            exit();  
        }
  
        
        $this->data['penilaian'] = $this->Penilaian_m->get_row(['id_penilaian' => $this->uri->segment(3)]);   
        $this->data['list_kriteria'] = $this->Kriteria_m->get();   
        $this->data['list_karyawan'] = $this->Karyawan_m->get(); 
        $x = 0;
        foreach ($this->data['list_karyawan'] as $k) {
          if ($this->DP_m->get_num_row(['id_karyawan' => $k->id_karyawan,'id_penilaian' => $this->uri->segment(3)]) != 0) { 
            $x++;
          }
        }
        $this->data['x'] = $x;
        
        $this->data['title']  = 'Kelola Data Penilaian';
        $this->data['index'] = 2;
        $this->data['content'] = 'pengawas/detailpenilaian';
        $this->template($this->data,'pengawas');
      } 

        
      else {
        $this->data['list_penilaian'] = $this->Penilaian_m->get_by_order('id_penilaian','desc',['status' => 2]);   

        $this->data['title']  = 'Kelola Data Penilaian';
        $this->data['index'] = 2;
        $this->data['content'] = 'pengawas/penilaian';
        $this->template($this->data,'pengawas');
      }
    }  
     
// KELOLA PENILAIAN ---------------------------------------------------------------------
 
 // KELOLA PENILAIAN ----------------------------------------------------------------------------

    public function laporan(){

      if ($this->POST('tambah')) {    

        if ($this->Laporan_m->get_num_row(['tahun' => $this->POST('tahun')]) != 0) {
          $this->flashmsg('DATA PENILAIAN PADA TAHUN INI TELAH ADA!', 'warning');
          redirect('pengawas/laporan/'. $this->Laporan_m->get_row(['tahun' => $this->POST('tahun')])->id_laporan);
          exit();  
        }
 

        if ($this->Penilaian_m->get_num_row(['tahun' => $this->POST('tahun')]) == 0) {
          $this->flashmsg('Tidak ada data pada tahun ini!', 'warning');
          redirect('pengawas/laporan/');
          exit();  
        }

        $data = [    
          'tahun' => $this->POST('tahun') ,
          'jumlah_penerima_reward' => $this->POST('jumlah') ,
          'tgl_buat' => date('Y-m-d H:i:s'),
          'status' => 1
        ];
        $this->Laporan_m->insert($data); 
        $id = $this->db->insert_id(); 

        $this->flashmsg('DRAFT LAPORAN BERHASIL DI BUAT!', 'success');
        redirect('pengawas/laporan/'.$id  );
        exit();    
      }elseif ($this->POST('hapus')) {  
        $this->Laporan_m->delete($this->POST('id_laporan'));
 
        $this->flashmsg('Penilaian berhasil dihapus!', 'success');
        redirect('pengawas/laporan');
        exit();    
      } 
      elseif ($this->POST('proses')) {  
        $id_laporan = $this->POST('id_laporan'); 
        

        $laporan = $this->Laporan_m->get_row(['id_laporan' => $id_laporan]);
        $smarter = $this->Penilaian_m->smarter($laporan->tahun);
        $z = 1;
        foreach ($smarter['nilai_akhir'] as $v) {

          if ($z <= $laporan->jumlah_penerima_reward) {
            $s = 1;
          }else{
            $s = 0;
          }
          $z++;
          $this->DL_m->insert(['id_laporan' => $id_laporan, 'id_karyawan' => $v['id_karyawan'],'nilai_preferensi' => $v['nilai'] ,'peringkat' => $v['rank'], 'status' => $s]);
        }

        $list = $this->DL_m->get(['id_laporan' => $id_laporan, 'status' => 1]);

        foreach ($list as $l) {
           $karyawan = $this->Karyawan_m->get_row(['id_karyawan' => $l->id_karyawan]);
           $config = [
              'mailtype'  => 'html',
              'charset'   => 'utf-8',
              'protocol'  => 'smtp',
              'smtp_host' => 'smtp.gmail.com',
              'smtp_user' => 'Indahnadiahwulandari28@gmail.com',  // Email gmail
              'smtp_pass'   => 'hitamputih',  // Password gmail
              'smtp_crypto' => 'ssl',
              'smtp_port'   => 465,
              'crlf'    => "\r\n",
              'newline' => "\r\n"
            ];

            // Load library email dan konfigurasinya
            $this->load->library('email', $config);

            // Email dan nama pengirim
            $this->email->from('Indahnadiahwulandari28@gmail.com', 'PT. PERTAMINA RU III PALEMBANG');
   

              
            $this->email->to($karyawan->email); 
            // Lampiran email, isi dengan url/path file
           
            // Subject email
            $this->email->subject('Reward Tahunan - PT. PERTAMINA RU III PALEMBANG');

            // Isi email
            $this->email->message('Selamat, ' . $karyawan->nama_karyawan . '<br>Anda mendapatkan Reward Tahunan periode ' . $laporan->tahun . ' dengan nilai '. $l->nilai_preferensi . '<br><br>Terima Kasih');
 
            $this->email->send();
        }

        $this->Laporan_m->update($id_laporan,['status' => 2]);
        $this->flashmsg('Laporan berhasil di proses!', 'success');
        redirect('pengawas/laporan/'.$id_laporan);
        exit();    
      }   

      if ($this->uri->segment(3)) {
        if ($this->Laporan_m->get_num_row(['id_laporan' => $this->uri->segment(3)]) == 0) {
            redirect('pengawas/penilaian');
            exit();  
        }
        
        $laporan = $this->Laporan_m->get_row(['id_laporan' => $this->uri->segment(3)]);

        if ($laporan->status == 1) {


          $smarter = $this->Penilaian_m->smarter($laporan->tahun);

          $this->data['laporan']  = $laporan;
          $this->data['nilai_akhir']  = $smarter['nilai_akhir'];
          $this->data['title']  = 'Proses Laporan';
          $this->data['index'] = 3;
          $this->data['content'] = 'pengawas/proseslaporan';
          $this->template($this->data,'pengawas');

        }else{
          $smarter = $this->Penilaian_m->smarter($laporan->tahun);

          $this->data['laporan']  = $laporan; 
          $this->data['dlaporan']  = $this->DL_m->get(['id_laporan' => $laporan->id_laporan]); 
          $this->data['title']  = 'Detail Laporan';
          $this->data['index'] = 3;
          $this->data['content'] = 'pengawas/detaillaporan';
          $this->template($this->data,'pengawas');
        } 
  
        
      } 

        
      else {
        $this->data['list_laporan'] = $this->Laporan_m->get_by_order('id_laporan','desc',[]);   

        $this->data['title']  = 'Kelola Data Laporan';
        $this->data['index'] = 3;
        $this->data['content'] = 'pengawas/laporan';
        $this->template($this->data,'pengawas');
      }
    }  
     

    public function smarter(){
      if ($this->uri->segment(3)) {
        if ($this->Laporan_m->get_num_row(['id_laporan' => $this->uri->segment(3)]) == 0) {
            redirect('pengawas/laporan');
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
        $this->data['content'] = 'pengawas/detailsmarter';
        $this->template($this->data,'pengawas');

      }else{
        redirect('pengawas/laporan');
        exit();
      }

    }

    public function detailnilai(){
      if ($this->uri->segment(3)) {
        if ($this->Laporan_m->get_num_row(['id_laporan' => $this->uri->segment(3)]) == 0) {
            redirect('pengawas/laporan');
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
        $this->data['content'] = 'pengawas/detailnilai';
        $this->template($this->data,'pengawas');

      }else{
        redirect('pengawas/laporan');
        exit();
      }

    }
// KELOLA PENILAIAN ---------------------------------------------------------------------
 

 
 
  // -----------------------------------------------------------------------------------------------------------------
       public function profil(){
       
        $this->data['title']  = 'Profil';
        $this->data['index'] = 6;
        $this->data['content'] = 'pengawas/profil';
        $this->template($this->data,'pengawas');
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
          redirect('pengawas/profil');
          exit();

          } elseif ($this->POST('edit2')) { 
            $data = [ 
              'password' => md5($this->POST('password')) 
            ];
            
            $this->login_m->update($this->data['email'],$data);
        
            $this->flashmsg('KATA SANDI BARU TELAH TERSIMPAN!', 'success');
            redirect('pengawas/profil');
            exit();    
          }  

          else{

          redirect('pengawas/profil');
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
