
    
<section class="content">
    <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row clearfix">
                 
            <div class="col-xs-12   col-sm-12  col-md-12   col-lg-12 ">
                <ol class="breadcrumb breadcrumb-bg-indigo align-left">
                    <li><a href="<?=base_url()?>"><i class="material-icons">apps</i> Beranda</a></li>
                        <li> <a href="<?=base_url('admin/pengawas')?>"><i class="material-icons">assignment_ind</i> Kelola Data Pengawas</a> </li>  
                    <li> <?=$pengawas->nama_pengawas?></li> 
                </ol>
                <div class="card">
                      <div class="header">
                            <center><h2>FORM EDIT PENGAWAS</h2></center>                          
                        </div>
                        <div class="body"> 

                            <?= form_open_multipart('admin/pengawas/') ?>
                            <input type="hidden" name="email_x" value="<?=$pengawas->email?>">
                            <fieldset> 
                                <div class="form-group">
                                    <div class="form-line">
                                         <div class="row">
                                             <div class="col-md-4">
                                                 <label class="control-label">ID Pengawas</label>
                                                 <input type="text" name="id_pengawas" class="form-control" placeholder="Masukkan Nama Pengawas"  required value="<?=$pengawas->id_pengawas?>" readonly >
                                                 
                                             </div>  
                                             <div class="col-md-4">
                                                 <label class="control-label">Nama Pengawas</label>
                                                 <input type="text" name="nama_pengawas" class="form-control" placeholder="Masukkan Nama Pengawas"  required value="<?=$pengawas->nama_pengawas?>" >
                                                 
                                             </div>  
                                             
                                             <div class="col-md-4">
                                                 <label class="control-label">Email Pengawas</label>
                                                 <input type="email" name="email" class="form-control" placeholder="Masukkan Email Pengawas"  required  value="<?=$pengawas->email?>">
                                                 
                                             </div> 
 
                                         </div> 

                                   </div>
                                 </div>
 
                                <div class="form-group">

                                    <div class="form-line">
                                        <div class="row">
                                             <div class="col-md-4">
                                                 <label class="control-label">Nomor HP/Telepon</label>
                                                 <input type="text" name="no_hp" class="form-control"  placeholder="Masukkan Nomor HP/Telepon"  value="<?=$pengawas->no_hp?>">
                                                 
                                             </div> 
                                             <div class="col-md-8">
                                                 <label class="control-label">Jenis Kelamin</label><br>
                                                    <input name="jk" type="radio" id="jk1" <?php if ($pengawas->jk== "Laki - Laki") {echo "checked";}?>  value="Laki - Laki" required /> 
                                                    <label  for="jk1">Laki - Laki</label>
                                                    <input name="jk" type="radio" id="jk2" <?php if ($pengawas->jk== "Perempuan") {echo "checked";}?>  value="Perempuan" required />
                                                    <label  for="jk2">Perempuan</label>
                                                 
                                             </div> 
                                         </div> 
                                   </div>
                                 </div>
                            </fieldset> 
                            <a  style="" data-toggle="modal" data-target="#hapus"  href=""><button class="btn bg-red">Hapus</button></a> 
                            <a  style="" data-toggle="modal" data-target="#ganti"  href=""><button class="btn bg-blue">Ganti Password</button></a> 
                            <center>
                                 
                            <input  type="submit" class="btn bg-indigo"  name="edit" value="Simpan"> 
                            </center>

                             <br><br>
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
                          <form action="<?= base_url('admin/pengawas')?>" method="Post"  >  
                            <input type="hidden" name="email" value="<?=$pengawas->email?>">
                            <input type="hidden" name="id_pengawas" value="<?=$pengawas->id_pengawas?>">
                         
                                 <table class="table table-bordered"> 
                                        <tr>   
                                            <th>Password Baru</th> 
                                            <th>
                                               <input type="Password" class="form-control" name="password" placeholder="Masukkan Password Baru" required autofocus >
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
<div class="modal fade" id="hapus" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="defaultModalLabel"><center>Hapus data pengawas?</center></h4> 
                            <center><span style="color :red"><i>Semua data yang terkait dengan data pengawas ini akan dihapus.</i></span></center>
                        </div>
                        <div class="modal-body"> 
                       
                         <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                                        <form action="<?= base_url('admin/pengawas')?>" method="Post" >  
                                        <input type="hidden" value="<?=$pengawas->email?>" name="email">  
                                        <input  type="submit" class="btn bg-red btn-block "  name="hapus" value="Ya">
                                         
                                    </div>
                                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                          <button type="button"  class="btn bg-green btn-block" data-dismiss="modal">Tidak</button>
                                    </div>
                            <?php echo form_close() ?> 
                                </div>
                        </div> 
                    </div>
                </div>
    </div>
