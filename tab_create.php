<?php
//session_start();
require_once 'bootstrap.php';
use PhpOffice\PhpWord\Element\Field;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\SimpleType\TblWidth;
////////////////////////////////////////////////////////////////////////////////
///fonction générant les tableau dits 'static' (sans couleur)
function genere_tableau_rapport($rq){
 $style_table = array(
 'borderColor' => 'black',
 'borderSize' => 6,
 'cellMargin'  => 100,
 //'valign' => 'both',
 //'layout' => 'autofit',
 'align'  => 'center'
 //'layout' => \PhpOffice\PhpWord\Style\Table::LAYOUT_FIXED
);

$first_cells_style = array(
 'bgColor' => 'white',
 'align'  => 'center'
);

$blue_cell_style = array(
 'bgColor' => '858796',
 'align'  => 'center'
);

$grey_cell_style = array(
 'bgColor' => 'F5F5F5',
 'align'  => 'center'
);

$cell_style_basic = array(
'bgColor' => 'white',
'align'  => 'center'
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
                   if($i%2 == 0){
                       $table->addCell(1, $blue_cell_style)->addText($array[$i][$j]);

                   }
                   else{
                       $table->addCell(1, $cell_style_basic)->addText($array[$i][$j]);
                   }
               }

           }
       }
       return $table;
}
////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////
//fonction générant les tableaux dis 'dynamique' (avec case de couleur)
//Tableau atelier 1c
function tab_dyn1c_3b_4b($rq){
  $style_table = array(
 'borderColor' => 'black',
 'borderSize' => 6,
 'cellMargin'  => 100,
 //'valign' => 'both',
 'layout' => 'autofit',
 'align'  => 'center'
);

$first_cells_style = array(
 'bgColor' => 'white',
 'align'  => 'center'
);

$blue_cell_style = array(
 'bgColor' => '858796',
 'align'  => 'center'
);

$grey_cell_style = array(
 'bgColor' => 'F5F5F5',
 'align'  => 'center'
);

$cell_style_basic = array(
'bgColor' => 'white',
'align'  => 'center'
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
                      $table -> addCell(1, array('bgColor' => 'yellow'))->addText($array[$i][$j]);
                      break;
                     case 3:
                      $table -> addCell(1, array('bgColor' => 'yellow'))->addText($array[$i][$j]);
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

//tableau atelier 2b
function tab_dyn2b_3a_3c($rq){
  $style_table = array(
 'borderColor' => 'black',
 'borderSize' => 6,
 'cellMargin'  => 100,
 //'valign' => 'both',
 'layout' => 'autofit',
 'align'  => 'center'
);

$first_cells_style = array(
 'bgColor' => 'white',
 'align'  => 'center'
);

$blue_cell_style = array(
 'bgColor' => '858796',
 'align'  => 'center'
);

$grey_cell_style = array(
 'bgColor' => 'F5F5F5',
 'align'  => 'center'
);

$cell_style_basic = array(
'bgColor' => 'white',
'align'  => 'center'
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
                        $table -> addCell(1, array('bgColor' => 'yellow'))->addText($array[$i][$j]);
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

//tableau atelier 3a & 3c

////////////////////////////////////////////////////////////////////////////////
?>
