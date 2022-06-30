
    
<section class="content">
    <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row clearfix">
                 
            <div class="col-xs-12   col-sm-12  col-md-12   col-lg-12 ">
                <ol class="breadcrumb breadcrumb-bg-indigo align-left">
                    <li><a href="<?=base_url()?>"><i class="material-icons">apps</i> Beranda</a></li>
                        <li> <a href="<?=base_url('admin/pengawas')?>"><i class="material-icons">assignment_ind</i> Kelola Data Pengawas</a> </li>  
                    <li>  Tambah Data Pengawas</li> 
                </ol>
                <div class="card">
                      <div class="header">
                            <center><h2>FORM TAMBAH PENGAWAS</h2></center>                          
                        </div>
                        <div class="body"> 

                            <?= form_open_multipart('admin/pengawas/') ?>
    
                            <fieldset> 
                                <div class="form-group">
                                    <div class="form-line">
                                         <div class="row">
                                             
                                             <div class="col-md-4">
                                                 <label class="control-label">Nama Pengawas</label>
                                                 <input type="text" name="nama_pengawas" class="form-control" placeholder="Masukkan Nama Pengawas"  required  >
                                                 
                                             </div>  
                                             
                                             <div class="col-md-4">
                                                 <label class="control-label">Email Pengawas</label>
                                                 <input type="email" name="email" class="form-control" placeholder="Masukkan Email Pengawas"  required  >
                                                 
                                             </div> 

                                             <div class="col-md-4">
                                                 <label class="control-label">Password</label>
                                                 <input type="password" name="password" class="form-control" placeholder="Masukkan Password"  required  >
                                                 
                                             </div> 
                                         </div> 

                                   </div>
                                 </div>
 
                                <div class="form-group">

                                    <div class="form-line">
                                        <div class="row">
                                             <div class="col-md-4">
                                                 <label class="control-label">Nomor HP/Telepon</label>
                                                 <input type="text" name="no_hp" class="form-control"  placeholder="Masukkan Nomor HP/Telepon" >
                                                 
                                             </div> 
                                             <div class="col-md-8">
                                                 <label class="control-label">Jenis Kelamin</label><br>
                                                <input name="jk" type="radio" id="jk1"  value="Laki - Laki" required /> 
                                                    <label  for="jk1">Laki - Laki</label>
                                                    <input name="jk" type="radio" id="jk2"   value="Perempuan" required />
                                                    <label  for="jk2">Perempuan</label>
                                                 
                                             </div> 
                                         </div> 
                                   </div>
                                 </div>
                            </fieldset> 
                            
                              
                            <input  type="submit" class="btn bg-indigo btn-block btn-lg"  name="tambah" value="Tambah">  <br><br>
                             <?php echo form_close() ?> 

     
                            </div>
                        </div>
                    </div>
            </div>
           
          </div>
        </div>
    </section>
 
 