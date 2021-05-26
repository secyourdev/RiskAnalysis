<?php
//session_start();
require_once 'content/bootstrap.php';
use PhpOffice\PhpWord\Element\Field;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\SimpleType\TblWidth;


///fonction générant les tableaux dits 'static' (sans couleur)
function genere_tableau_rapport($rq){
  $style_table = array(
      'borderColor' => 'black',
      'borderSize' => 6,
      'cellMargin' => 100,
      //'valign' => 'both',

      //'layout' => 'autofit',
      'align'  => 'center'
  );

  $first_cells_style = array(
      'bgColor' => '#DCDCDC',
      'valign'  => 'center',
       'layout' => 'autofit'
      // 'width' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(4)
  );
  $cell_style_basic = array(
    'bgColor' => 'white',
    'valign'  => 'center',
    'layout' => 'autofit'
  );

  $first_row_style = array(
    'tblHeader' => true
  );
  $array = mysqli_fetch_all($rq,MYSQLI_NUM);
         //style *****************************************************************

       $nb_row = mysqli_num_rows($rq);
       $nb_col = mysqli_num_fields($rq);


       //création des tableaux*************************************
       $table = new Table($style_table);
       for($i = -1; $i < $nb_row; $i ++){
         if($i == -1 ){
           $table->addRow(1,$first_row_style);
         }
         else{
           $table->addRow();
         }
           for($j = 0; $j<$nb_col;$j++){
               if($i ==-1){
                   $finfo= mysqli_fetch_field_direct($rq,$j);
                   $table->addCell(1, $first_cells_style)->addText($finfo->name,array('bold'=> true));
               }

               else{
                 $table->addCell(1, $cell_style_basic)->addText($array[$i][$j]);
               }

           }
       }
       return $table;
}



//Fonctions générant les tableaux dis 'dynamique' (avec case de couleur)

//Tableaux ateliers 1c/3b/4b
function tab_dyn1c_3b_4b($rq){
  $style_table = array(
      'borderColor' => 'black',
      'borderSize' => 6,
      'cellMargin' => 100,
      //'valign' => 'both',

      //'layout' => 'autofit',
      'align'  => 'center'
  );

  $first_cells_style = array(
      'bgColor' => '#DCDCDC',
      'valign'  => 'center',
       'layout' => 'autofit'
      // 'width' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(4)
  );
  $cell_style_basic = array(
    'bgColor' => 'white',
    'valign'  => 'center',
    'layout' => 'autofit'
  );

  $first_row_style = array(
    'tblHeader' => true
  );
    $array = mysqli_fetch_all($rq,MYSQLI_NUM);


         $nb_row = mysqli_num_rows($rq);
         $nb_col = mysqli_num_fields($rq);


         //création des tableaux*************************************
         $table = new Table($style_table);
         for($i = -1; $i < $nb_row; $i ++){
           if($i == -1 ){
             $table->addRow(1,$first_row_style);
           }
           else{
             $table->addRow();
           }
             for($j = 0; $j<$nb_col;$j++){
                 if($i ==-1){
                     $finfo= mysqli_fetch_field_direct($rq,$j);
                     $table->addCell(1, $first_cells_style)->addText($finfo->name,array('bold'=> true));
                 }
                 else if($j == $nb_col-1){
                   switch($array[$i][$j]){
                     case 1:
                      $table -> addCell(1, array('bgColor' => 'green'))->addText($array[$i][$j]);
                      break;
                     case 2:
                      $table -> addCell(1, array('bgColor' => 'orange'))->addText($array[$i][$j]);
                      break;
                     case 3:
                      $table -> addCell(1, array('bgColor' => 'orange'))->addText($array[$i][$j]);
                      break;
                     case 4:
                      $table -> addCell(1, array('bgColor' => 'red'))->addText($array[$i][$j]);
                      break;
                     case 5:
                      $table -> addCell(1, array('bgColor' => 'red'))->addText($array[$i][$j]);
                      break;
                     default:
                      $table -> addCell(1, $cell_style_basic)->addText($array[$i][$j]);
                    }
                  }
                    else{
                      $table->addCell(1, $cell_style_basic)->addText($array[$i][$j]);
                    }
                     /*if($i%2 == 0){
                         $table->addCell(1, $blue_cell_style)->addText($array[$i][$j]);

                     }
                     else{
                         $table->addCell(1, $cell_style_basic)->addText($array[$i][$j]);
                     }*/


             }
         }
         return $table;
       }

//tableaux ateliers 2b/3a/3c
function tab_dyn2b_3a_3c($rq){
  $style_table = array(
      'borderColor' => 'black',
      'borderSize' => 6,
      'cellMargin' => 100,
      //'valign' => 'both',

      //'layout' => 'autofit',
      'align'  => 'center'
  );

  $first_cells_style = array(
      'bgColor' => '#DCDCDC',
      'valign'  => 'center',
       'layout' => 'autofit'
      // 'width' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(4)
  );
  $cell_style_basic = array(
    'bgColor' => 'white',
    'valign'  => 'center',
    'layout' => 'autofit'
  );

  $first_row_style = array(
    'tblHeader' => true
  );


      $array = mysqli_fetch_all($rq,MYSQLI_NUM);
             //style *****************************************************************


           $nb_row = mysqli_num_rows($rq);
           $nb_col = mysqli_num_fields($rq);


           //création des tableaux*************************************
           $table = new Table($style_table);
           for($i = -1; $i < $nb_row; $i ++){
             if($i == -1 ){
               $table->addRow(1,$first_row_style);
             }
             else{
               $table->addRow();
             }
               for($j = 0; $j<$nb_col;$j++){
                   if($i ==-1){
                       $finfo= mysqli_fetch_field_direct($rq,$j);
                       $table->addCell(1, $first_cells_style)->addText($finfo->name,array('bold'=> true));
                   }
                   else if($j == $nb_col-1){
                     switch($array[$i][$j]){
                       case "Faible":
                        $table -> addCell(1, array('bgColor' => 'green'))->addText($array[$i][$j]);
                        break;
                       case "Pas critique":
                        $table -> addCell(1, array('bgColor' => 'green'))->addText($array[$i][$j]);
                        break;
                       case "Moyenne":
                        $table -> addCell(1, array('bgColor' => 'orange'))->addText($array[$i][$j]);
                        break;
                       case "Élevée":
                        $table -> addCell(1, array('bgColor' => 'red'))->addText($array[$i][$j]);
                        break;
                        case "Critique":
                         $table -> addCell(1, array('bgColor' => 'red'))->addText($array[$i][$j]);
                         break;
                       default:
                        $table -> addCell(1, $cell_style_basic)->addText($array[$i][$j]);
                      }
                    }
                      else{
                        $table->addCell(1, $cell_style_basic)->addText($array[$i][$j]);
                      }
               }
           }
           return $table;
         }


//tableua atelier 1d
function tab_dyn_1d($rq){
  $style_table = array(
      'borderColor' => 'black',
      'borderSize' => 6,
      'cellMargin' => 100,
      //'valign' => 'both',

      //'layout' => 'autofit',
      'align'  => 'center'
  );

  $first_cells_style = array(
      'bgColor' => '#DCDCDC',
      'valign'  => 'center',
       'layout' => 'autofit'
      // 'width' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(4)
  );
  $cell_style_basic = array(
    'bgColor' => 'white',
    'valign'  => 'center',
    'layout' => 'autofit'
  );

  $first_row_style = array(
    'tblHeader' => true
  );


               $array = mysqli_fetch_all($rq,MYSQLI_NUM);
                      //style *****************************************************************


                    $nb_row = mysqli_num_rows($rq);
                    $nb_col = mysqli_num_fields($rq);


                    //création des tableaux*************************************
                    $table = new Table($style_table);
                    for($i = -1; $i < $nb_row; $i ++){
                      if($i == -1 ){
                        $table->addRow(1,$first_row_style);
                      }
                      else{
                        $table->addRow();
                      }
                        for($j = 0; $j<$nb_col;$j++){
                            if($i ==-1){
                                $finfo= mysqli_fetch_field_direct($rq,$j);
                                $table->addCell(1, $first_cells_style)->addText($finfo->name,array('bold'=> true));
                            }
                            else if($j == 2){
                              switch($array[$i][$j]){
                                case "Appliqué sans restriction":
                                 $table -> addCell(1, array('bgColor' => 'green'))->addText($array[$i][$j]);
                                 break;
                                case "Appliqué avec restriction":
                                 $table -> addCell(1, array('bgColor' => 'orange'))->addText($array[$i][$j]);
                                 break;
                                case "Non appliqué":
                                 $table -> addCell(1, array('bgColor' => 'red'))->addText($array[$i][$j]);
                                 break;
                                default:
                                 $table -> addCell(1, $cell_style_basic)->addText($array[$i][$j]);
                               }
                             }
                               else{
                                 $table->addCell(1, $cell_style_basic)->addText($array[$i][$j]);
                               }
                        }
                    }
                    return $table;
                  }


function tab_raci($rq_first, $rq_atelier, $rq_raci){

                    $style_table = array(
                        'borderColor' => 'black',
                        'borderSize' => 6,
                        'cellMargin' => 100,
                        'alignement' => 'center',
                        // 'valign' => 'center',

                        //'layout' => 'autofit',
                        'align'  => 'center'
                    );

                    $first_cells_style = array(
                        'bgColor' => '#DCDCDC',
                        'valign'  => 'center',
                         'layout' => 'autofit',
                         'textDirection'=>\PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR,
                         'height' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(3),
                         'cantSplit' => 'true',
                         'cellMargin' => 100
                        // 'width' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(4)
                    );
                    $cell_style_basic = array(
                      'bgColor' => 'white',
                      'valign'  => 'center',
                      'layout' => 'autofit'
                    );

                    $first_row_style = array(
                      'tblHeader' => true,
                      'height' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(30),
                      'cantSplit' => 'true',
                      'cellMargin' => 100,
                      'align' => 'center',
                      'valign' => 'center'
                    );

                    $first_row = mysqli_fetch_all($rq_first); //Contient noms prénoms
                    $tab_atelier = mysqli_fetch_all($rq_atelier); //Contient id atelier
                    $array = mysqli_fetch_all($rq_raci); // Contient les écritures
                    $array_index=0;
                    $nb_col = mysqli_fetch_fields($rq_first);
                    $nb_first = mysqli_num_rows($rq_first);
                    $nb_row = mysqli_num_rows($rq_raci);
                    $nb_atelier = mysqli_num_rows($rq_atelier);
                    // print_r($array);

                    $table = new Table($style_table);
                    $vvar=true;
                    for($i = 0; $i < $nb_first; $i ++){
                      if($i == 0){
                        $table->addRow(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(6.5),$first_row_style);
                      }
                      else{
                        $table->addRow();
                        $vvar=true;
                      }
                      for($j = -1; $j< 15; $j++){

                        if($i == 0){
                          if($j == -1){
                            $table->addCell(1,$cell_style_basic)-> addText(" # ");
                          }
                          else{
                          $table->addCell(1,$first_cells_style)-> addText($tab_atelier[$j][0],array('bold' => true, 'textDirection'=>\PhpOffice\PhpWord\Style\Cell::TEXT_DIR_LRTBV));
                          }
                        }
                        else{
                          if($j == -1){
                            //for($l = 0; $l < 15; $l++){
                            $i--;
                              $table->addCell(1,$cell_style_basic)-> addText($first_row[$i][0],array('bold' => true));
                              $i++;
                            //}
                          }
                          else if($vvar){
                            for($k = 0; $k <$nb_atelier ; $k++){
                              $table -> addCell(1, $cell_style_basic)->addText($array[$array_index][2][0], $cell_style_basic);
                              $array_index++;
                              if($k%(14)==0){$vvar=false;}
                            }

                          }
                        }
                      }
                    }

                    return $table;


}

// function tab_raci($rq_first, $rq_atelier, $rq_raci){
//   $style_table = array(
//       'borderColor' => 'black',
//       'borderSize' => 6,
//       'cellMargin' => 100,
//       //'valign' => 'both',
//
//       //'layout' => 'autofit',
//       'align'  => 'center'
//   );
//
//   $first_cells_style = array(
//       'bgColor' => '#DCDCDC',
//       'valign'  => 'center',
//        'layout' => 'autofit'
//       // 'width' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(4)
//   );
//   $cell_style_basic = array(
//     'bgColor' => 'white',
//     'valign'  => 'center',
//     'layout' => 'autofit'
//   );
//
//   $first_row_style = array(
//     'tblHeader' => true,
//
//   );
//
//   $first_row = mysqli_fetch_all($rq_first);
//   $tab_atelier = mysqli_fetch_all($rq_atelier);
//   $array = mysqli_fetch_all($rq_raci);
//
//   $nb_col = mysqli_fetch_fields($rq_first);
//   $nb_first = mysqli_num_rows($rq_first);
//   $nb_row = mysqli_num_rows($rq_raci);
//   // print_r($array);
//
//   $table = new Table($style_table);
//
//   for($i = 0; $i < $nb_first; $i++){
//     //Création de la structure des lignes
//     if($i == 0){
//       $table->addRow(1,$first_row_style);
//     }
//     else{
//       $table->addRow();
//       $vvar = true;
//     }
//     //Fin création structure
//
//
//     //Remplissage des lignes
//
//     for($j = -1; $j < $nb_col; $j++ ){
//       if($i == 0 && $j = -1){
//         $table->addCell(1,$cell_style_basic)-> addText(" # ");
//       }
//       else if($i == 0){
//         $table->addCell(1,$first_cells_style)-> addText($tab_atelier[$j][0]);
//       }
//       else if($j == -1){
//         $table->addCell(1,$cell_style_basic)-> addText($first_row[$i][0]);
//       }
//       else if($vvar){
//         for($k = 0; $k <$nb_col ; $k++){
//             $table -> addCell(1, $cell_style_basic)->addText($array[$k][2]);
//             if($k%($nb_col-1)==0){
//               $vvar=false;
//             }
//         }
//       }
//     }
//   }
//   return $table;
// }


?>
