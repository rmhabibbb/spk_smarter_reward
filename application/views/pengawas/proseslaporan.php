 
 <section class="content" >
    <div class="container-fluid"> 
        <?= $this->session->flashdata('msg') ?>
        <div class="row clearfix">
          
               
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ol class="breadcrumb breadcrumb-bg-indigo align-left">
                        <li><a href="<?=base_url()?>"><i class="material-icons">apps</i> Beranda</a></li>
                        <li> <a href="<?=base_url('pengawas/laporan')?>"><i class="material-icons">view_list</i> Kelola Data Laporan</a> </li> 
                        <li> <i class="material-icons">class</i><?=$laporan->tahun?></li>  
                    </ol>
                    <div class="card">
                        
                        <div class="body"> 
                            <table class="table table-bordered table-striped table-hover" style="max-height: 300px">

                                <tbody>
                                    
                                     <tr>
                                         <th style="width: 30%">
                                             ID Laporan
                                         </th>
                                         <td> 
                                          
                                            <?=$laporan->id_laporan?>

                                         </td>
                                     </tr>
                                      
                                    
                                     <tr>
                                         <th style="width: 30%">
                                             Tahun
                                         </th>
                                         <td> 
                                           <?=$laporan->tahun?>
                                         </td>
                                     </tr>  
                                     <tr>
                                         <th style="width: 30%">
                                             Tanggal Buat
                                         </th>
                                         <td> 
                                           <?=date('d-m-Y' ,strtotime($laporan->tgl_buat)) ?>
                                         </td>
                                     </tr>  
                                     <tr>
                                         <th style="width: 30%">
                                             Jumlah Penerima
                                         </th>
                                         <td> 
                                            <?=$laporan->jumlah_penerima_reward?> Karyawan
                                         </td>
                                     </tr>  
                                     <tr>
                                         <th style="width: 30%">
                                             Status laporan
                                         </th>
                                         <td> 
                                           <?php  
                                             if ($laporan->status == 1) {
                                               echo "Proses Laporan";
                                             }else{
                                              echo "Selesai";
                                             }
                                           ?>
                                         </td>
                                     </tr>   
                                   
                                </tbody>

                            </table>   

                            <center>
                            <a data-toggle="modal" data-target="#selesai"  href=""><button class="btn bg-indigo">Proses</button></a> 
                             </center>
                         </div>
                    </div>
                    <div class="card">
                      <div class="header">
                            <center><h2>HASIL PENILAIAN</h2></center>                          
                        </div>
                        <div class="body">  
                            <a href="<?=base_url('pengawas/smarter/'.$laporan->id_laporan)?>"><button class="btn bg-indigo">Hasil Perhitungan SMARTER</button></a> 
                             <br><br>
                            <div class="table-responsive">
                                 <table class="table table-bordered table-striped table-hover  js-exportable dataTable">
                                    <thead>
                                        <tr>   
                                            <th style="width: 10px">Peringkat</th>
                                            <th>ID Karyawan</th> 
                                            <th>Nama Karyawan</th> 
                                            <th>Nilai Akhir</th>   
                                            <th>Aksi</th>   
                                        </tr>
                                    </thead> 
                                    <tbody>
                                      <?php 

                                      $i = 1;   
                                      $x = 1;
                                      foreach ($nilai_akhir as $row): ?>  
                                        <?php $k = $this->Karyawan_m->get_row(['id_karyawan' => $row['id_karyawan']]); ?>
                                          <tr>    
                                              <td 
                                                <?php if ($x <= $laporan->jumlah_penerima_reward): ?>
                                              <?php echo 'style="background-color: green; color : white"' ?>
                                            <?php endif ?>
                                              ><center><?=$i++?></center></td>
                                              <td 
                                                <?php if ($x <= $laporan->jumlah_penerima_reward): ?>
                                              <?php echo 'style="background-color: green; color : white"' ?>
                                            <?php endif ?>
                                              ><?=$k->id_karyawan?></td>  
                                              <td 
                                                <?php if ($x <= $laporan->jumlah_penerima_reward): ?>
                                              <?php echo 'style="background-color: green; color : white"' ?>
                                            <?php endif ?>
                                              ><?=$k->nama_karyawan?></td>   
                                              <td 
                                                <?php if ($x <= $laporan->jumlah_penerima_reward): ?>
                                              <?php echo 'style="background-color: green; color : white"' ?>
                                            <?php endif ?>
                                              ><?=$row['nilai']?></td> 
                                              <td>
                                                <center>
                                                  <a href="<?=base_url('pengawas/detailnilai/'.$laporan->id_laporan.'/'.$k->id_karyawan)?>"> 
                                                       <button class="btn bg-indigo">Detail Nilai</button>
                                                   </a>
                                                </center>
                                                
                                              </td>     
                                          </tr>
                                      <?php $x++; endforeach; ?>
                                    </tbody>
                                </table>

     
                            </div>
                        </div>
                    </div>
 
                    
                </div>
    </div>
</section>

<div class="modal fade" id="selesai" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header"> 
              <h4 class="modal-title" id="defaultModalLabel"><center>PROSES LAPORAN ?</center></h4>
          </div>

                        <div class="modal-body">
                         <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                                        <form action="<?= base_url('pengawas/laporan')?>" method="Post" > 
                                        <input type="hidden" value="<?=$laporan->id_laporan?>" name="id_laporan">  
                                        <input  type="submit" class="btn bg-green btn-block "  name="proses" value="PROSES">
                                         
                                    </div>
                                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                          <button type="button"  class="btn bg-red btn-block" data-dismiss="modal">BATAL</button>
                                    </div>
                                        <?php echo form_close() ?> 
                                </div> 
                            </div> 
          </div> 
          
      </div>
  </div>
</div> 