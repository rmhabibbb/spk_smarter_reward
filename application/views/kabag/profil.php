
    
<section class="content">
    <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row clearfix">
                 
            <div class="col-xs-12   col-sm-12  col-md-12   col-lg-12 ">
                <ol class="breadcrumb breadcrumb-bg-indigo align-left">
                    <li><a href="<?=base_url()?>"><i class="material-icons">apps</i> Beranda</a></li>
                    <li>Profil</li>  
                </ol>
                <div class="card">
                      <div class="header">
                            <center><h2>PROFIL</h2></center>                          
                        </div>
                        <div class="body"> 

                            <?= form_open_multipart('kabag/proses_edit_profil/') ?>
                            <div class="row">
                            <div class="col-md-4">
                                <img src="<?=base_url('assets/karyawan/default-l.jpg')?>" width="100%">  

                                <hr>

                                <center> <a  style="" data-toggle="modal" data-target="#ganti"  href=""><button class="btn bg-blue">Ganti Password</button></a> 
                                </center>
                            </div>
                            <div class="col-md-8">
                                <fieldset> 
                                    <div class="form-group">
                                        <div class="form-line">
                                             <div class="row">
                                                
                                                 <div class="col-md-12">
                                                     <label class="control-label">Email</label>
                                                     <input type="email" name="email" class="form-control" placeholder="Masukkan Email Karyawan"  required  value="<?=$profil->email?>" >
                                                     <input type="hidden" name="email_x"   value="<?=$profil->email?>" >
                                                     
                                                 </div> 
     
                                             </div> 

                                       </div>
                                     </div>
     
                                    
                            <center>
                                 
                            <input  type="submit" class="btn bg-indigo"  name="edit" value="Simpan"> 
                            </center>
                                </fieldset> 
                            </div>

                            
                             <?php echo form_close() ?> 

     
                            </div>
                        </div>
                    </div>
            </div>
           
          </div>
        </div>
    </section>
 
 
  <div class="modal fade" id="ganti" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="defaultModalLabel"><center>Form Ganti Password</center></h4>
                        </div>
                        <div class="modal-body">
                          <form action="<?= base_url('kabag/proses_edit_profil')?>" method="Post" id="editform2" >  
                            <input type="hidden" name="email" value="<?=$profil->email?>"> 
                         
                                 <table class="table table-bordered"> 
                                        <tr>   
                                            <th>Password Lama</th> 
                                            <th>
                                               <input type="Password" class="form-control" name="password" placeholder="Masukkan Password Lama" required autofocus id="passlama" >
                                               <div id="pesan4_ks"></div>
                                            </th>  
                                        </tr> 
                                        <tr>   
                                            <th>Password Baru</th> 
                                            <th>
                                               <input type="Password" class="form-control" name="password" placeholder="Masukkan Password Baru" required autofocus id="pass1_ks">
                                               <div id="pesan2_ks"></div>
                                            </th>  
                                        </tr> 
                                        <tr>   
                                            <th>Konfirmasi Password Baru</th> 
                                            <th>
                                               <input type="Password" class="form-control" name="password" placeholder="Masukkan Konfirmasi Password Baru" required autofocus id="pass2_ks" >
                                               <div id="pesan3_ks"></div>
                                            </th>  
                                        </tr> 
                                </table>
                         
                        <input  type="submit" class="btn bg-indigo btn-block"  name="edit2" value="Simpan">  <br><br>
                  
                            <?php echo form_close() ?> 
                        </div> 
                        <div class="modal-footer"> 
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
</div>  