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
                        'align'  => 'center'
                    );

                    $first_cells_style = array(
                        'bgColor' => '#DCDCDC',
                        'valign'  => 'bottom',
                         'textDirection'=>\PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR,
                         'cantSplit' => 'true',
                    );
                    $cell_style_basic = array(
                      'bgColor' => 'white',
                      'align'  => 'alignment'
                    );

                    $first_row_style = array(
                      'tblHeader' => true,
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
                        $table->addRow(1,$first_row_style);
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


function tab_carto1($rq_carto){
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


  $first_cells_style_borderless = array(
    'bgColor' => 'FFFFFF',
    'borderColor' =>'white',
    'borderSize' => 6
  );

  $text_right = array(
  'align' => 'right',
  'valign' => 'both'
  );
   
  $table = new Table($table_style);

  $array = mysqli_fetch_all($rq_carto);

  $compte=0;
  $k = 0;

  //Création array contenu
  $tab = array_fill(0,5 , [' ']);
  $empty_string = "";



  for($i = 5; $i >=0; $i--){

    for($j = 1; $j < 6; $j++){
      for($k = 0; $k < mysqli_num_rows($rq_carto);$k++){
        if(5-$i == $array[$k][2] && $j == $array[$k][1]){
          $tab[$i][$j-1] = $array[$k][0];          
          $compte ++;
        }
        else{
          $tab[$i][$j] = $empty_string;
        }
      }
    }
  }
  //Fin création array contenu
    


    //Création strcucture
  for($i = -1; $i < 6; $i++){
    if($i == 0){
        $table->addRow(1,$first_cells_style_borderless);
      }
    else{
      $table->addRow();
    }
    //Fin création structure

    //Remplissage des lignes
    for($j = -1; $j < 5; $j++ ){
      if($i == -1){
        if($j == -1){
          $table->addCell(1,$first_cells_style_borderless)-> addText(" Gravité ",array(),$text_right);
        }
        else{
            $table->addCell(1,$first_cells_style_borderless)-> addText(" ");
        }
      }
      else{
        if($j == -1 && $i != -1 && $i != 5){
          $table->addCell(1,$first_cells_style_borderless)-> addText(5-$i,array(),$text_right);
        }
        else if($i == 5 && $j == 4){
            $table->addCell(1,$first_cells_style_borderless)-> addText(" Vraisemblance ");
        }
        else if($i == 5 && $j !=-1){
          $table->addCell(1,$first_cells_style_borderless)-> addText($j+1,array(),array('align' => 'center'));
        }
        else if($j == 4 && $i !=5 ){
          $table->addCell(1,$first_cells_style_borderless)-> addText("  ");

        }
        else if($j == -1 && $i ==5 ){
          $table->addCell(1,$first_cells_style_borderless)-> addText("  ");

        }
        else{
          $table->addCell(1)-> addText($tab[$i][$j],array(),array('align' => 'center', 'valign' => 'both'));
          }
      }
    }
  }
  return $table;
}


function tab_carto_couleurs($rq_carto, $rq_couleur){
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

  $table = new Table($table_style);

  $first_cells_style_borderless = array(
    'bgColor' => 'FFFFFF',
    'borderColor' =>'white',
    'borderSize' => 6
  );

  $text_right = array(
  'align' => 'right'
  );
   

  $array = mysqli_fetch_all($rq_carto);
  $couleurs = mysqli_fetch_all($rq_couleur, MYSQLI_NUM);

  $tab_couleurs =  array_fill(0,5 , [' ']);

  $compte=0;
  $compte_c =0;
  $k = 0;

  //Création array contenu
  $tab = array_fill(0,5 , [' ']);
  $empty_string = "";



  for($i = 4; $i >=0; $i--){

    for($j = 1; $j < 5; $j++){
      for($k = 0; $k < mysqli_num_rows($rq_carto);$k++){
        if(5-$i == $array[$k][2] && $j == $array[$k][1]){
          $tab[$i][$j-1] = $array[$k][0];          
          $compte ++;
        }
        else{
          $tab[$i][$j] = $empty_string;
        }
      }
    }
  }
  //Fin création array contenu

  //Création array couleurs
  for($i = 4; $i >= 0;$i--){
    for($j = 0; $j <4; $j++){
      $tab_couleurs[$i][$j] = $couleurs[$compte_c][0]; 
      $compte_c ++;
    }
  }
  // echo '<pre>'; print_r($tab_couleurs);echo '</pre>';
  // echo '<pre>'; print_r($tab);echo '</pre>';
    


    //Création strcucture
  for($i = -1; $i < 6; $i++){
    if($i == 0){
        $table->addRow(1,$first_cells_style_borderless);
      }
    else{
      $table->addRow();
    }
    //Fin création structure

    //Remplissage des lignes
    for($j = -1; $j < 5; $j++ ){
      if($i == -1){
        if($j == -1){
          $table->addCell(1,$first_cells_style_borderless)-> addText(" Gravité ",array(),$text_right);
        }
        else{
            $table->addCell(1,$first_cells_style_borderless)-> addText(" ");
        }
      }
      else{
        if($j == -1 && $i != -1 && $i != 5){
          $table->addCell(1,$first_cells_style_borderless)-> addText(5-$i,array(),$text_right);
        }
        else if($i == 5 && $j == 4){
            $table->addCell(1,$first_cells_style_borderless)-> addText(" Vraisemblance ");
        }
        else if($i == 5 && $j !=-1){
          $table->addCell(1,$first_cells_style_borderless)-> addText($j+1,array(),array('align'=>'center'));
        }
        else if($j == 4 && $i !=5 ){
          $table->addCell(1,$first_cells_style_borderless)-> addText("  ");

        }
        else if($j == -1 && $i ==5 ){
          $table->addCell(1,$first_cells_style_borderless)-> addText("  ");

        }
        else{
          // $table->addCell(1,array('bgColor' => 'white'))-> addText($tab[$i][$j]);
          switch($tab_couleurs[$i][$j]){
            
            case 'fond-vert':
              $table->addCell(1,array('bgColor' => 'green'))-> addText($tab[$i][$j],array(),array('align'=>'center', 'valign' => 'both'));
              break;
            case 'fond-orange':
              $table->addCell(1,array('bgColor' => 'orange'))-> addText($tab[$i][$j],array(),array('align'=>'center', 'valign' => 'both'));
              break;

            case 'fond-rouge':
              $table->addCell(1,array('bgColor' => 'red'))-> addText($tab[$i][$j],array(),array('align'=>'center', 'valign' => 'both'));
              break;

            default :
              $table->addCell(1,array('bgColor' => 'blue'))-> addText('Problème bdd',array(),array('align'=>'center', 'valign' => 'both'));

          
          }
        }
      }
    }
  }
  return $table;
}
