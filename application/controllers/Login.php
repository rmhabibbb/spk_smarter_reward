<?php
/**
 *
 */
class Login extends MY_Controller {
  function __construct() {
    parent::__construct();
    $this->data['email'] = $this->session->userdata('email');
    $this->data['id_role']  = $this->session->userdata('id_role');
    if (isset($this->data['email'], $this->data['id_role']))
    {
      switch ($this->data['id_role'])
      {
        case 1:
          redirect('admin');
          break;
        case 2:
          redirect('pengawas');
          break; 
        case 3:
          redirect('kabag');
          break; 
        case 4:
          redirect('karyawan');
          break; 
      }
      exit;
    }
    $this->load->model('Login_m');
  }

  public function cek(){
      $email = $this->POST('email');
      $password = $this->POST('password');
      if($this->Login_m->cek_login($email,$password) == 0){
        $this->flashmsg('email tidak terdaftar!', 'danger');
        redirect('login');
        exit;
      }else if($this->Login_m->cek_login($email,$password) == 1){
        setcookie('email_temp', $email, time() + 5, "/");
        $this->flashmsg('Password Salah!', 'danger');
        redirect('login');
        exit;
      }
    redirect('login');
  }

  public function index() {
    $this->data[ 'title' ] = 'Login | ' . $this->title;
    $this->data[ 'content' ] = 'login';
    $this->load->view('sign-in');
  }
}

?>
