<?php

class Login_m extends MY_Model{
	public function __construct(){
		parent::__construct();
		$this->data['table_name'] 	= 'akun';
    	$this->data['primary_key']	= 'email';
	}
	
	public function cek_login($email,$password){
		$user_data = $this->get_row(['email'=>$email]);
		if(isset($user_data)){
			if ($user_data->password == md5($password)) {

				 
				$user_session = [
					'email'	=> $user_data->email, 
					'id_role'	=> $user_data->role 
				];
				$this->session->set_userdata($user_session);
				return 2;
			}else {
				return 1;
			}
		}
		return 0;
	}
}