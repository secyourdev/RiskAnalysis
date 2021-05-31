<?php
//session_start();
require_once 'content/bootstrap.php';
use PhpOffice\PhpWord\Element\Field;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\SimpleType\TblWidth;

$min_size_of_row = \PhpOffice\PhpWord\Shared\Converter::cmToTwip(10);
///fonction générant les tableaux dits 'static' (sans couleur)
function genere_tableau_rapport($rq){
  global $min_size_of_row;

  //Feuilles de styles
    //S'applique au tableau
    $table_style = array(
      'borderColor' => 'black', //Couleur des bordures
      'borderSize' => 6, //Taille des bordures en TWIP
      'align' => 'center',  //Alignement du tableau
      'unit' => \PhpOffice\PhpWord\SimpleType\TblWidth::PERCENT,
      'width' => 101*50

    );



    $first_row_style = array(
      'tblHeader' => true
    );

    $row_style = array(

    );

    $first_cells_style= array(
      'bgColor' => 'DCDCDC', //Couelur de fond de la première ligne
      'valign' => 'center'
    );

    $cell_style = array(
      'valign' => 'center'
    );
    $text_style =array(
    'align' => 'center'
    );


  $array = mysqli_fetch_all($rq,MYSQLI_NUM);
         //style *****************************************************************

       $nb_row = mysqli_num_rows($rq);
       $nb_col = mysqli_num_fields($rq);


       //création des tableaux*************************************
       $table = new Table($table_style);
       for($i = -1; $i < $nb_row; $i ++){
         if($i == -1 ){
           $table->addRow($min_size_of_row,$first_row_style);
         }
         else{
           $table->addRow($min_size_of_row);
         }
           for($j = 0; $j<$nb_col;$j++){
               if($i ==-1){
                   $finfo= mysqli_fetch_field_direct($rq,$j);
                   $table->addCell($min_size_of_row, $first_cells_style)->addText($finfo->name,array('bold'=> true), $text_style);
               }

               else{
                 $table->addCell(1, $cell_style)->addText($array[$i][$j],array(), $text_style);
               }

           }
       }
       return $table;
}



//Fonctions générant les tableaux dis 'dynamique' (avec case de couleur)

//Tableaux ateliers 1c/3b/4b
function tab_dyn1c_3b_4b($rq){
  global $min_size_of_row;

  //Feuilles de styles
    //S'applique au tableau
    $table_style = array(
      'borderColor' => 'black', //Couleur des bordures
      'borderSize' => 6, //Taille des bordures en TWIP
      'align' => 'center',  //Alignement du tableau
      'unit' => \PhpOffice\PhpWord\SimpleType\TblWidth::PERCENT,
      'width' => 100*50

    );



    $first_row_style = array(
      'tblHeader' => true
    );

    $row_style = array(

    );

    $first_cells_style= array(
      'bgColor' => 'DCDCDC', //Couelur de fond de la première ligne
      'valign' => 'center'
    );

    $cell_style = array(
      'valign' => 'center'
    );
    $text_style =array(
    'align' => 'center'
    );
    $array = mysqli_fetch_all($rq,MYSQLI_NUM);


         $nb_row = mysqli_num_rows($rq);
         $nb_col = mysqli_num_fields($rq);


         //création des tableaux*************************************
         $table = new Table($table_style);
         for($i = -1; $i < $nb_row; $i ++){
           if($i == -1 ){
             $table->addRow($min_size_of_row,$first_row_style);
           }
           else{
             $table->addRow($min_size_of_row);
           }
             for($j = 0; $j<$nb_col;$j++){
                 if($i ==-1){
                     $finfo= mysqli_fetch_field_direct($rq,$j);
                     $table->addCell(1, $first_cells_style)->addText($finfo->name,array('bold'=> true), $text_style);
                 }
                 else if($j == $nb_col-1){
                   switch($array[$i][$j]){
                     case 1:
                      $table -> addCell(1, array('bgColor' => 'green', 'valign' => 'center'))->addText($array[$i][$j],array(),$text_style);
                      break;
                     case 2:
                      $table -> addCell(1, array('bgColor' => 'orange', 'valign' => 'center'))->addText($array[$i][$j],array(),$text_style);
                      break;
                     case 3:
                      $table -> addCell(1, array('bgColor' => 'orange', 'valign' => 'center'))->addText($array[$i][$j],array(),$text_style);
                      break;
                     case 4:
                      $table -> addCell(1, array('bgColor' => 'red', 'valign' => 'center'))->addText($array[$i][$j],array(),$text_style);
                      break;
                     case 5:
                      $table -> addCell(1, array('bgColor' => 'red', 'valign' => 'center'))->addText($array[$i][$j],array(),$text_style);
                      break;
                     default:
                      $table -> addCell(1, $cell_style)->addText($array[$i][$j],array(),$text_style);
                    }
                  }
                    else{
                      $table->addCell(1, $cell_style)->addText($array[$i][$j],array(),$text_style);
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
  global $min_size_of_row;

  //Feuilles de styles
    //S'applique au tableau
    $table_style = array(
      'borderColor' => 'black', //Couleur des bordures
      'borderSize' => 6, //Taille des bordures en TWIP
      'align' => 'center',  //Alignement du tableau
      'unit' => \PhpOffice\PhpWord\SimpleType\TblWidth::PERCENT,
      'width' => 101*50

    );



    $first_row_style = array(
      'tblHeader' => true,
      'cantSplit' => true
    );

    $row_style = array(

    );

    $first_cells_style= array(
      'bgColor' => 'DCDCDC', //Couelur de fond de la première ligne
      'valign' => 'center'
    );

    $cell_style = array(
      'valign' => 'center'
    );
    $text_style =array(
    'align' => 'center'
    );


  $array = mysqli_fetch_all($rq,MYSQLI_NUM);
        //style *****************************************************************


      $nb_row = mysqli_num_rows($rq);
      $nb_col = mysqli_num_fields($rq);


      //création des tableaux*************************************
      $table = new Table($table_style);
      for($i = -1; $i < $nb_row; $i ++){
        if($i == -1 ){
          $table->addRow($min_size_of_row,$first_row_style);
        }
        else{
          $table->addRow($min_size_of_row);
        }
          for($j = 0; $j<$nb_col;$j++){
              if($i ==-1){
                  $finfo= mysqli_fetch_field_direct($rq,$j);
                  $table->addCell($min_size_of_row, $first_cells_style)->addText($finfo->name,array('bold'=> true),array(),$text_style);
              }
              else if($j == $nb_col-1){
                switch($array[$i][$j]){
                  case "Faible":
                  $table -> addCell(1, array('bgColor' => 'green','valign' => 'center'))->addText($array[$i][$j],array(),$text_style);
                  break;
                  case "Pas critique":
                  $table -> addCell(1, array('bgColor' => 'green','valign' => 'center'))->addText($array[$i][$j],array(),$text_style);
                  break;
                  case "Moyenne":
                  $table -> addCell(1, array('bgColor' => 'orange','valign' => 'center'))->addText($array[$i][$j],array(),$text_style);
                  break;
                  case "Élevée":
                  $table -> addCell(1, array('bgColor' => 'red','valign' => 'center'))->addText($array[$i][$j],array(),$text_style);
                  break;
                  case "Critique":
                    $table -> addCell(1, array('bgColor' => 'red','valign' => 'center'))->addText($array[$i][$j],array(),$text_style);
                    break;
                  default:
                  $table -> addCell(1, $cell_style)->addText($array[$i][$j],array(),$text_style);
                }
              }
                else{
                  $table->addCell(1, $cell_style)->addText($array[$i][$j],array(),$text_style);
                }
          }
      }
      return $table;
    }


//tableua atelier 1d
function tab_dyn_1d($rq){
  global $min_size_of_row;

  //Feuilles de styles
    //S'applique au tableau
    $table_style = array(
      'borderColor' => 'black', //Couleur des bordures
      'borderSize' => 6, //Taille des bordures en TWIP
      'align' => 'center',  //Alignement du tableau
      'unit' => \PhpOffice\PhpWord\SimpleType\TblWidth::PERCENT,
      'width' => 100*50

    );



    $first_row_style = array(
      'tblHeader' => true
    );

    $row_style = array(

    );

    $first_cells_style= array(
      'bgColor' => 'DCDCDC', //Couelur de fond de la première ligne
      'valign' => 'center'
    );

    $cell_style = array(
      'valign' => 'center'
    );
    $text_style =array(
    'align' => 'center'
    );


               $array = mysqli_fetch_all($rq,MYSQLI_NUM);
                      //style *****************************************************************


                    $nb_row = mysqli_num_rows($rq);
                    $nb_col = mysqli_num_fields($rq);


                    //création des tableaux*************************************
                    $table = new Table($table_style);
                    for($i = -1; $i < $nb_row; $i ++){
                      if($i == -1 ){
                        $table->addRow($min_size_of_row,$first_row_style);
                      }
                      else{
                        $table->addRow($min_size_of_row);
                      }
                        for($j = 0; $j<$nb_col;$j++){
                            if($i ==-1){
                                $finfo= mysqli_fetch_field_direct($rq,$j);
                                $table->addCell(1, $first_cells_style)->addText($finfo->name,array('bold'=> true),$text_style);
                            }
                            else if($j == 2){
                              switch($array[$i][$j]){
                                case "Appliqué sans restriction":
                                 $table -> addCell(1, array('bgColor' => 'green', 'valign' => 'center'))->addText($array[$i][$j],array(),$text_style);
                                 break;
                                case "Appliqué avec restriction":
                                 $table -> addCell(1, array('bgColor' => 'orange', 'valign' => 'center'))->addText($array[$i][$j],array(),$text_style);
                                 break;
                                case "Non appliqué":
                                 $table -> addCell(1, array('bgColor' => 'red', 'valign' => 'center'))->addText($array[$i][$j],array(),$text_style);
                                 break;
                                default:
                                 $table -> addCell(1, $cell_style)->addText($array[$i][$j],array(),$text_style);
                               }
                             }
                               else{
                                 $table->addCell(1, $cell_style)->addText($array[$i][$j],array(),$text_style);
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


function tab_carto($rq_carto){
  global $min_size_of_row;

  //Feuilles de styles
    //S'applique au tableau
    $table_style = array(
      'borderColor' => 'black', //Couleur des bordures
      'borderSize' => 6, //Taille des bordures en TWIP
      'align' => 'center',  //Alignement du tableau
      'unit' => \PhpOffice\PhpWord\SimpleType\TblWidth::PERCENT,
      'width' => 100*50

    );



    $first_row_style = array(
      'tblHeader' => true
    );

    $row_style = array(

    );

    $first_cells_style= array(
      'bgColor' => 'DCDCDC', //Couelur de fond de la première ligne
      'valign' => 'center'
    );

    $cell_style = array(
      'valign' => 'center'
    );
    $text_style =array(
    'align' => 'center'
    );

  $table = new Table($table_style);

  $first_cells_style_borderless = array(
    'bgColor' => 'FFFFFF',
    'valign'  => 'center',
    'layout' => 'autofit',
    'borderColor' =>'white',
    'borderSize' => 6
);
    //$first_row = mysqli_fetch_all($rq_carto_into);

    $array = mysqli_fetch_all($rq_carto);

    // print_r($array);

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
    $vvar = false;
    $compte=0;
    $k = 0;
    $a=0;


    $tab = array_fill(0,5 , [' ']);
    $empty_string = "";
   //print_r($tab);



                       for($i = 5; $i >=0; $i--){

                         for($j = 1; $j < 6; $j++){
                           for($k = 0; $k < mysqli_num_rows($rq_carto)-1;$k++){
                             //$tab[$i][$compte] = $compte;
                             if(5-$i == $array[$k][2] && $j == $array[$k][1]){

                               $tab[$i][$j-1] = $array[$k][0];
                               // if($compte==mysqli_num_rows($rq_carto)-1){
                               //   $compte=mysqli_num_rows($rq_carto)+1;
                               //   $tab[$i][$compte] = $array[mysqli_num_rows($rq_carto)+1][0];
                               // }
                               $compte ++;



                             }
                             else{
                               $tab[$i][$j] = $empty_string;
                             }
                           }

                         }
                       }



  //   }
    //Fin création structure


    //Remplissage des lignes
    for($i = -1; $i < 6; $i++){
      if($i == 0){
          $table->addRow(1,$first_cells_style_borderless);
        }
        else{
          $table->addRow();
          //$vvar = false;
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

          $table->addCell(1,$cell_style)-> addText($tab[$i][$j]);
        // for($k=0;$k<mysqli_num_rows($rq_carto);$k++){
        //     /*if($j==3){
        //       $k=0;
        //     }*/
        //
        //     if($i == $array[$k][2] && $j == $array[$k][1]){
        //       $table->addCell(1,$cell_style)-> addText($array[$k][0]);
        //     }
        //     else{
        //       $table->addCell(1,$cell_style)-> addText("vide  ");
        //     }
        // //     }
        // $table->addCell(1,$cell_style)-> addText($i." -- ".$j);

          }
      }
  }//fin de la bocule $J
  // $x+=1;
  // $y+=1;
}//fin de la boucle $I



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

/*
else{
  // if($vvar){
  //   $table->addCell(1,$cell_style)-> addText($array[$compte][0]);
  //   $vvar=false;
  // echo($compte.'    ');

  // //echo($array[$compte][1].'    ');
  // //echo($array[$compte][2].'    ');
  // //echo($array[$compte][3].'    ');
  // //echo('  $x =  '.$x.' $y = '.$y.' |[||| ');
  // }
  // else{
  // $table->addCell(1,$cell_style)-> addText("vide1");
  // }
  for($k = ($compte+1); $k < $nb_row; $k++){

    if($array[$k][1] == $x && $array[$k][2] == $y){
      /*if($compte > $k){
        $k=$compte;
      }*/
  //     $vvar=true;
  //
  //     $compte=$k;
  //     //$table->addCell(1,$cell_style_basic)-> addText($array[$compte][0]);
  //     //echo($array[$k][0].";".$array[$k][1]. ";".$array[$k][2]. " jaaaaaj");
  //     break;
  //   }
  // }
  //
  //
  // if($vvar){
  //   $table->addCell(1,$cell_style)-> addText($array[$compte][0]);
  //   $vvar=false;
  //  //echo($compte.'    ');
  //
  // //echo($array[$compte][1].'    ');
  // //echo($array[$compte][2].'    ');
  // //echo($array[$compte][3].'    ');
  // //echo('  $x =  '.$x.' $y = '.$y.' |[||| ');
  // }

  /*else{
    for($k = 0; $k < $nb_row; $k++){
      if($array[$k][1] == $i && $array[$k][2] == $j){
        $o=1;//$table->addCell(1,$cell_style_basic)-> addText($array[$k][3]);
      }else{
        $o=0;
      }
    }
    //$table->addCell(1,$cell_style_basic)-> addText("vide1 ");
  }*/
