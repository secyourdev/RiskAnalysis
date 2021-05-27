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

  $text_style = array(
    'align' => 'center',
    'valign' => 'both'
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
                   $table->addCell(1, $first_cells_style)->addText($finfo->name,array('bold'=> true), $text_style);
               }

               else{
                 $table->addCell(1, $cell_style_basic)->addText($array[$i][$j],array(), $text_style);
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
  $text_style = array(
    'align' => 'center',
    'valign' => 'both'
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
                     $table->addCell(1, $first_cells_style)->addText($finfo->name,array('bold'=> true), $text_style);
                 }
                 else if($j == $nb_col-1){
                   switch($array[$i][$j]){
                     case 1:
                      $table -> addCell(1, array('bgColor' => 'green'))->addText($array[$i][$j],array(),$text_style);
                      break;
                     case 2:
                      $table -> addCell(1, array('bgColor' => 'orange'))->addText($array[$i][$j],array(),$text_style);
                      break;
                     case 3:
                      $table -> addCell(1, array('bgColor' => 'orange'))->addText($array[$i][$j],array(),$text_style);
                      break;
                     case 4:
                      $table -> addCell(1, array('bgColor' => 'red'))->addText($array[$i][$j],array(),$text_style);
                      break;
                     case 5:
                      $table -> addCell(1, array('bgColor' => 'red'))->addText($array[$i][$j],array(),$text_style);
                      break;
                     default:
                      $table -> addCell(1, $cell_style_basic)->addText($array[$i][$j],array(),$text_style);
                    }
                  }
                    else{
                      $table->addCell(1, $cell_style_basic)->addText($array[$i][$j],array(),$text_style);
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

$text_style = array(
  'align' => 'center',
  'valign' => 'both'
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
                $table->addCell(1, $first_cells_style)->addText($finfo->name,array('bold'=> true),array(),$text_style);
            }
            else if($j == $nb_col-1){
              switch($array[$i][$j]){
                case "Faible":
                $table -> addCell(1, array('bgColor' => 'green'))->addText($array[$i][$j],array(),$text_style);
                break;
                case "Pas critique":
                $table -> addCell(1, array('bgColor' => 'green'))->addText($array[$i][$j],array(),$text_style);
                break;
                case "Moyenne":
                $table -> addCell(1, array('bgColor' => 'orange'))->addText($array[$i][$j],array(),$text_style);
                break;
                case "Élevée":
                $table -> addCell(1, array('bgColor' => 'red'))->addText($array[$i][$j],array(),$text_style);
                break;
                case "Critique":
                  $table -> addCell(1, array('bgColor' => 'red'))->addText($array[$i][$j],array(),$text_style);
                  break;
                default:
                $table -> addCell(1, $cell_style_basic)->addText($array[$i][$j],array(),$text_style);
              }
            }
              else{
                $table->addCell(1, $cell_style_basic)->addText($array[$i][$j],array(),$text_style);
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

  $text_style = array(
    'align' => 'center',
    'valign' => 'both'
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
                                $table->addCell(1, $first_cells_style)->addText($finfo->name,array('bold'=> true),$text_style);
                            }
                            else if($j == 2){
                              switch($array[$i][$j]){
                                case "Appliqué sans restriction":
                                 $table -> addCell(1, array('bgColor' => 'green'))->addText($array[$i][$j],array(),$text_style);
                                 break;
                                case "Appliqué avec restriction":
                                 $table -> addCell(1, array('bgColor' => 'orange'))->addText($array[$i][$j],array(),$text_style);
                                 break;
                                case "Non appliqué":
                                 $table -> addCell(1, array('bgColor' => 'red'))->addText($array[$i][$j],array(),$text_style);
                                 break;
                                default:
                                 $table -> addCell(1, $cell_style_basic)->addText($array[$i][$j],array(),$text_style);
                               }
                             }
                               else{
                                 $table->addCell(1, $cell_style_basic)->addText($array[$i][$j],array(),$text_style);
                               }
                        }
                    }
                    return $table;
                  }


function tab_raci($rq_first, $rq_atelier, $rq_raci){

                    $style_table = array(
                        'borderColor' => 'black',
                        'borderSize' => 6,
                        // 'cellMargin(Top)' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(10),
                        // 'cellMargin(Right)' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(10),
                        // 'cellMargin(Bottom)' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(10),
                        // 'cellMargin(Left)' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(10),
                        // 'alignement' => 'center',
                        // 'valign' => 'center',

                        //'layout' => 'autofit',
                        'align'  => 'center'
                    );

                    $first_cells_style = array(
                        'bgColor' => '#DCDCDC',
                        'valign'  => 'bottom',
                         //'layout' => 'autofit',
                         'textDirection'=>\PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR,
                         'cantSplit' => 'true',
                         //'cellMargin' => 100
                        // 'width' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(4)
                    );
                    $cell_style_basic = array(
                      'bgColor' => 'white',
                      'align'  => 'alignment'
                      //'layout' => 'autofit'
                    );

                    $first_row_style = array(
                      'tblHeader' => true,
                      // 'cantSplit' => 'true',
                      //'cellMargin' => 100,
                      //'align' => 'center',
                      //'valign' => 'center'
                    );

                    $text_style = array(
                      'align' => 'center',
                      'valign' => 'both'
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
                            $table->addCell(1,$cell_style_basic)-> addText(" # ",array(),$text_style);
                          }
                          else{
                          $table->addCell(1,$first_cells_style)-> addText($tab_atelier[$j][0],array('bold' => true), $text_style);
                          }
                        }
                        else{
                          if($j == -1){
                            //for($l = 0; $l < 15; $l++){
                            $i--;
                              $table->addCell(1,$cell_style_basic)-> addText($first_row[$i][0],array('bold' => true),$text_style);
                              $i++;
                            //}
                          }
                          else if($vvar){
                            for($k = 0; $k <$nb_atelier ; $k++){
                              $table -> addCell(1, $cell_style_basic)->addText($array[$array_index][2][0], $cell_style_basic, $text_style);
                              $array_index++;
                              if($k%(14)==0){$vvar=false;}
                            }

                          }
                        }
                      }
                    }

                    return $table;


}


function tab_carto($rq_carto_into){
  $style_table = array(
      'borderColor' => 'black',
      'borderSize' => 6,
      'cellMargin' => 100,
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

  $text_style = array(
    'align' => 'center',
    'valign' => 'both'
  );

  $table = new Table($style_table);

  $first_cells_style_borderless = array(
    'bgColor' => 'FFFFFF',
    'valign'  => 'center',
    'layout' => 'autofit',
    'borderColor' =>'white',
    'borderSize' => 6
);
  //$first_row = mysqli_fetch_all($rq_carto_into);

  $array = mysqli_fetch_all($rq_carto_into);

  // $nb_col = mysqli_fetch_fields($rq_first);
  // $nb_first = mysqli_num_rows($rq_first);
  // $nb_row = mysqli_num_rows($rq_carto_into);
  // print_r($array);




  // for($i = -1; $i < 6; $i++){
  //   //Création de la structure des lignes
  //   if($i == 0){
  //     $table->addRow(1,$first_cells_style_borderless);
  //   }
  //   else{
  //     $table->addRow();
  //     $vvar = true;
  //   }
    //Fin création structure


    //Remplissage des lignes
    for($i = -1; $i < 6; $i++){
      if($i == 0){
          $table->addRow(1,$first_cells_style_borderless);
        }
        else{
          $table->addRow();
          // $vvar = true;
        }



    for($j = -1; $j < 5; $j++ ){
      if($i == -1){
        if($j == -1){
          $table->addCell(1,$first_cells_style_borderless)-> addText(" Gravité ");
        }
        else{
            $table->addCell(1,$first_cells_style_borderless)-> addText(" ");
        }
      }
      else{
        if($j == -1 && $i != -1 && $i != 5){
          $table->addCell(1,$first_cells_style_borderless)-> addText(5-$i);
        }
        else if($i == 5 && $j == 4){
            $table->addCell(1,$first_cells_style_borderless)-> addText(" Vraisemblance ");
        }
        else if($i == 5 && $j !=-1){
          $table->addCell(1,$first_cells_style_borderless)-> addText($j+1);
        }
        else if($j == 4 && $i !=5 ){
          $table->addCell(1,$first_cells_style_borderless)-> addText("  ");

        }
        else if($j == -1 && $i ==5 ){
          $table->addCell(1,$first_cells_style_borderless)-> addText("  ");

        }
        else{
          $table->addCell(1,$cell_style_basic)-> addText("vide1 ");
        }

      }
  }
}



  return $table;
}
// for($j = 0; $j < 6; $j++){
//   switch($i){
//     case $i == 0:
//       if($j == 0){
//         $table -> addCell(1, $cell_style_basic)->addText('Gravité');
//       }
//     case $i == 1:
//       if($j == 0){
//         $table -> addCell(1, $cell_style_basic)->addText('5');
//       }
//     case $i == 2:
//       if($j == 0){
//         $table -> addCell(1, $cell_style_basic)->addText('4');
//       }
//     case $i == 3:
//       if($j == 0){
//         $table -> addCell(1, $cell_style_basic)->addText('3');
//       }
//     case $i == 4:
//       if($j == 0){
//         $table -> addCell(1, $cell_style_basic)->addText('2');
//       }
//     case $i == 5:
//       if($j == 0){
//         $table -> addCell(1, $cell_style_basic)->addText('1');
//       }
//     case $i == 6:
//       if($j > 0){
//         $table -> addCell(1, $cell_style_basic)->addText($j);
//       }
//    }
// }
