<?php
//session_start();
require_once 'bootstrap.php';
use PhpOffice\PhpWord\Element\Field;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\SimpleType\TblWidth;
////////////////////////////////////////////////////////////////////////////////
//include
//atelier 1
include("content/php/atelier1a/selection.php");
include("content/php/atelier1b/selection.php");
// include("content/php/atelier1c/selection.php");
// include("content/php/atelier1d/selection.php");
// //atelier 2
// include("content/php/atelier2a/selection.php");
// include("content/php/atelier2b/selection.php");
// include("content/php/atelier2c/selection.php");
// //atelier 3
// include("content/php/atelier3a/selection.php");
// include("content/php/atelier3b/selection.php");
// include("content/php/atelier3c/selection.php");
// //atelier 4
// include("content/php/atelier4a/selection.php");
// include("content/php/atelier4b/selection.php");
// //atelier 5
// include("content/php/atelier5a/selection.php");
// include("content/php/atelier5b/selection.php");
// include("content/php/atelier5c/selection.php");
////////////////////////////////////////////////////////////////////////////////

function genere_tableau_rapport($rq){

  $array = mysqli_fetch_all($rq,MYSQLI_NUM);
         //style *****************************************************************
       $style_table = array(
           'borderColor' => 'black',
           'borderSize' => 6,
           'cellMargin'  => 10,
           //'valign' => 'both',
           'layout' => 'autofit',
           'align'  => 'center'
       );

       $first_cells_style = array(
           'bgColor' => 'A9A9A9',
           'align'  => 'center'
       );

       $blue_cell_style = array(
           'bgColor' => '008B8B',
           'align'  => 'center'
       );

       $cell_style_basic = array(
         'bgColor' => 'white',
         'align'  => 'center'
       );

       $first_row_style = array(
         'tblHeader' => true
       );

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
                   if($i%2 != 0){
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

?>
