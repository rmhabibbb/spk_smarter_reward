<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        
                <div class="menu">
                    <ul class="list">
                        <li class="header">Menu </li>
                        <!-- if unconfirmed -->

                        <?php if ($index == 1): ?>
                          <li class="active">
                        <?php else: ?>
                          <li>
                        <?php endif; ?>
                            <a href="<?=base_url('admin')?>">
                                <i class="material-icons">home</i>
                                <span>Beranda</span>
                            </a>
                         </li>   
 
                        <?php if ($index == 3): ?>
                          <li class="active">
                        <?php else: ?>
                          <li>
                        <?php endif; ?>
                            <a href="<?=base_url('admin/karyawan')?>">
                                <i class="material-icons">people</i>
                                <span>Karyawan</span>
                            </a>
                        </li>    
                        <?php if ($index == 4): ?>
                          <li class="active">
                        <?php else: ?>
                          <li>
                        <?php endif; ?>
                            <a href="<?=base_url('admin/pengawas')?>">
                                <i class="material-icons">assignment_ind</i>
                                <span>Pengawas</span>
                            </a>
                        </li>   
                   
                       
                      
                        <li class="header">Pengaturan</li> 
                        <?php if ($index == 6): ?>
                          <li class="active">
                        <?php else: ?>
                          <li>
                        <?php endif; ?>
                            <a href="<?=base_url('admin/profil')?>">
                                <i class="material-icons">person_pin</i>
                                <span>Profil</span>
                            </a>
                        </li>    
                      



         
                          <li> 
                            <a href="<?=base_url('logout')?>">
                                <i class="material-icons">input</i>
                                <span>Keluar</span>
                            </a>
                        </li>
                    </ul>
                </div> 
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                 
            </div>
            <div class="version">
                
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    
    <!-- #END# Right Sidebar -->
</section>
