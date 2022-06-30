<?php 
class Penilaian_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_penilaian';
    $this->data['table_name'] = 'penilaian';
  }

  public function smarter($tahun){

          $list_karyawan = $this->Karyawan_m->get();
          $list_kriteria = $this->Kriteria_m->get();
          $list_penilaian = $this->Penilaian_m->get(['tahun' => $tahun ]);
          $n_penilaian = sizeof($list_penilaian);
          $n_kriteria = sizeof($list_kriteria);
          $nilai_awal = array();

          foreach ($list_karyawan as $k) {
              $nilai = array(); 
                $i = 1; 
                foreach ($list_kriteria as $l) {
                    $nilai[$i] = 0; 
                    foreach ($list_penilaian as $p) {
                      $d =  $this->DP_m->get_row(['id_karyawan' => $k->id_karyawan, 'id_penilaian' => $p->id_penilaian,'id_kriteria' => $l->id_kriteria]); 
                      if ($d) {
                        $nilai[$i] = $nilai[$i] + $d->nilai; 
                      } 
                    } 

                    $nilai[$i] = number_format($nilai[$i]/$n_penilaian,4);
                    $i++;
                }
            $data = [
              'id_karyawan' => $k->id_karyawan, 
              'nilai' => $nilai
            ]; 
            array_push($nilai_awal, $data);
          }

 


          $bobot = array();
          $x = 1;
          foreach ($list_kriteria as $l) { 
            $z = 0;
            for ($j = $x ; $j <= $n_kriteria ; $j++) { 
              $z = $z + (1/$j);
            }
            $z = $z/$n_kriteria;
            $bobot[$x] = number_format($z,4);
            $x++;
          }


          $nilai_utility = array(); 
          foreach ($nilai_awal as $v) {

            $utility = array();
            for ($i=1; $i <= $n_kriteria ; $i++) { 
              $utility[$i] = number_format($v['nilai'][$i]*$bobot[$i],4);
            }

            $data = [
              'id_karyawan' => $v['id_karyawan'], 
              'utility' => $utility
            ];
            array_push($nilai_utility, $data);


          }


              
          $nilai_pre = array(); 

          foreach ($nilai_utility as $v) {
            $nilai = 0;
            for ($i=1; $i <= $n_kriteria ; $i++) { 
              $nilai = $nilai + $v['utility'][$i];
            }

            $data = [
              'nilai' => number_format($nilai,4),
              'id_karyawan' => $v['id_karyawan'] 
            ];
            array_push($nilai_pre, $data);

          }  

          rsort($nilai_pre);
          $nilai_akhir = array(); 
          $i = 1;
          foreach ($nilai_pre as $v) { 
            $data = [
              'nilai' => $v['nilai'],
              'id_karyawan' => $v['id_karyawan'],
              'rank' => $i
            ];
            $i++;
            array_push($nilai_akhir, $data);

          }

          $this->data['nilai_awal'] = $nilai_awal; 
          $this->data['nilai_utility'] = $nilai_utility; 
          $this->data['nilai_pre'] = $nilai_pre; 
          $this->data['nilai_akhir'] = $nilai_akhir; 
          $this->data['bobot'] = $bobot; 

          return $this->data;

  }
}

 ?>
