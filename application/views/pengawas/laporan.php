
    
<section class="content">
    <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row clearfix">
                 
            <div class="col-xs-12   col-sm-12  col-md-12   col-lg-12 ">
                <ol class="breadcrumb breadcrumb-bg-indigo align-left">
                    <li><a href="<?=base_url()?>"><i class="material-icons">apps</i> Beranda</a></li>
                    <li> <i class="material-icons">assignment</i> Kelola Data Laporan </li> 
                </ol>
                <div class="card">
                      <div class="header">
                            <center><h2>KELOLA DATA LAPORAN</h2></center>                          
                        </div>
                        <div class="body">
                          <a   data-toggle="modal" data-target="#tambah"  href=""><button class="btn bg-indigo">Buat Laporan</button></a> 

                            <div class="table-responsive">
                                 <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>   
                                            <th>No.</th>  
                                            <th>Tahun</th>   
                                            <th>Tanggal Buat</th>   
                                            <th>Jumlah Penerima Reward</th>   
                                            <th>Status</th>        
                                            <th>Aksi</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                      <?php 
                                       $i = 1; 
                                       foreach ($list_laporan as $row): ?> 
                                          <tr>   
                                              <td><?=$i++?> </td>  
                                               
                                              <td>
                                                 <?=$row->tahun?>
                                              </td>  
                                              <td>
                                                 <?=date('d-m-Y' ,strtotime($row->tgl_buat)) ?>
                                              </td>  
                                              <td>
                                                 <?=$row->jumlah_penerima_reward?> Karyawan
                                              </td>  
                                              <td>
                                              <?php
                                                if ($row->status == 1) {
                                                  echo "<i>draft</i>";
                                                }else{
                                                  echo "Selesai";
                                                }

                                              ?></td>    
                                              
                                               <td style="vertical-align: middle;">
                                                  <a href="<?=base_url('pengawas/laporan/'.$row->id_laporan)?>"> 
                                                       <button class="btn bg-indigo">Lihat Detail</button>
                                                   </a>
                                                   <?php
                                                if ($row->status == 1) { ?>
                                                    <a data-toggle="modal" data-target="#delete-<?=$row->id_laporan?>"  href="">
                                                       <button class="btn bg-red">Hapus</button>
                                                   </a>
                                                <?php } ?>   
                                               </td>  



                                          </tr>
                                      <?php endforeach; ?>
                                    </tbody>
                                </table>

     
                            </div>
                        </div>
                    </div>
            </div>
           
          </div>
        </div>
    </section>
 
 <div class="modal fade" id="tambah" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="defaultModalLabel"><center>Form Buat Laporan</center></h4>
                        </div>
                        <div class="modal-body">
                          <form action="<?= base_url('pengawas/laporan')?>" method="Post"  >  
                         
                                 <table class="table table-bordered"> 
                                         
                                        <tr>   
                                            <th>Tahun</th> 
                                            <th>
                                               <input type="number" class="form-control" name="tahun"   required autofocus  >
                                            </th>  
                                        </tr> 
                                        <tr>   
                                            <th>Jumlah Penerima Reward</th> 
                                            <th>
                                               <input type="number" class="form-control" name="jumlah" min="1"  max="<?=$this->Karyawan_m->get_num_row([])?>" required autofocus  >
                                            </th>  
                                        </tr> 
                                </table>
                         
                        <input  type="submit" class="btn bg-indigo btn-block"  name="tambah" value="Tambah">  <br><br>
                  
                            <?php echo form_close() ?> 
                        </div> 
                        <div class="modal-footer"> 
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
</div> 

<?php $i = 1; foreach ($list_laporan as $row): ?> 
 <div class="modal fade" id="delete-<?=$row->id_laporan?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="defaultModalLabel"><center>Hapus Draft Laporan?</center></h4> 
                            <center><span style="color :red"><i>Semua data yang terkait dengan draft ini akan dihapus.</i></span></center>
                        </div>
                        <div class="modal-body"> 
                       
                         <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                                        <form action="<?= base_url('pengawas/laporan')?>" method="Post" > 
                                        <input type="hidden" value="<?=$row->id_laporan?>" name="id_laporan">  
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
<?php endforeach; ?>