
    
<section class="content">
    <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row clearfix">
                 
            <div class="col-xs-12   col-sm-12  col-md-12   col-lg-12 ">
                <ol class="breadcrumb breadcrumb-bg-indigo align-left">
                    <li><a href="<?=base_url()?>"><i class="material-icons">apps</i> Beranda</a></li>
                    <li> <i class="material-icons">assignment</i>Data Laporan </li> 
                </ol>
                <div class="card">
                      <div class="header">
                            <center><h2> DATA LAPORAN</h2></center>                          
                        </div>
                        <div class="body"> 
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
                                                  <a href="<?=base_url('kabag/laporan/'.$row->id_laporan)?>"> 
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
 
 