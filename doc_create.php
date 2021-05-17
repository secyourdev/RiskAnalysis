<?php
session_start();
require_once 'bootstrap.php';
use PhpOffice\PhpWord\Element\Field;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\SimpleType\TblWidth;

function doc_create(){
  ////////////////////////////////////////////////////////////////////////////////

  ////////////////////////////////////////////////////////////////////////////////
  //include_atelier
  //atelier 1
  include("content/php/atelier1a/selection.php");
  include("content/php/atelier1b/selection.php");
  include("content/php/atelier1c/selection.php");
  include("content/php/atelier1d/selection.php");
  // //atelier 2
  include("content/php/atelier2a/selection.php");
  // include("content/php/atelier2b/selection.php");
  include("content/php/atelier2c/selection.php");
  // //atelier 3
  // include("content/php/atelier3a/selection.php");
  // include("content/php/atelier3b/selection.php");
  // include("content/php/atelier3c/selection.php");
  // //atelier 4
  // include("/RiskAnalysis/content/php/atelier4a/selection.php");
  // include("/RiskAnalysis/content/php/atelier4b/selection.php");
  // //atelier 5
  // include("/RiskAnalysis/content/php/atelier5a/selection.php");
  // include("/RiskAnalysis/content/php/atelier5b/selection.php");
  // include("/RiskAnalysis/content/php/atelier5c/selection.php");
  ////////////////////////////////////////////////////////////////////////////////
  //include
  include("tab_create.php");
  ////////////////////////////////////////////////////////////////////////////////

  $template = new \PhpOffice\PhpWord\TemplateProcessor('Template.docx');
  //////requetes
  //$a_utilisateur=$result_grp_user
  //$h_raci =
  ////tableaux

  ///atelier1*************************************************************************
  //1.a//////////////////////////////////////////////////////////
  $tab_acteurs = genere_tableau_rapport($rq_tab_acteurs);
  $tab_raci = genere_tableau_rapport($rq_tab_raci);

  //1.b/////////////////////////////////////////////////////////
  $tab_vm = genere_tableau_rapport($rq_vm_tab);
  $tab_biens = genere_tableau_rapport($rq_biens_tab);
  $tab_mission = genere_tableau_rapport($rq_mission_tab);

  //1.c/////////////////////////////////////////////////////////////

  $tab_echelle = genere_tableau_rapport($rq_echelle_tab);
  $tab_niveau  = genere_tableau_rapport($rq_niveau_tab);

  //1.d///////////////////////////////////////////////////////////////
  $tab_socle_sec = genere_tableau_rapport($rq_socle_sec_tab);
  $tab_regle = genere_tableau_rapport($rq_regle_tab);

  ///atelier2*******************************************************************************
  //2.a/////////////////////////////////////////////////////////////////
  $tab_srov = genere_tableau_rapport($rq_srov_tab);
  $tab_srov3 = genere_tableau_rapport($rq_srov3_tab);


  //2.b///////////////////////////////////////////////////////////////
//TO DO SYS DYN

//2.c///////////////////////////


  ////inclusion tableaux

  $template->setComplexBlock('acteurs', $tab_acteurs);
  $template->setComplexBlock('h_raci', $tab_raci);
  $template->setComplexBlock('j_valeur_metier', $tab_vm);
  $template->setComplexBlock('k_bien_support', $tab_biens);
  $template->setComplexBlock('i_mission', $tab_mission);
  $template->setComplexBlock('da_echelle', $tab_echelle);
  $template->setComplexBlock('da_niveau', $tab_niveau);
  $template->setComplexBlock('n_socle_de_securite', $tab_socle_sec);
  $template->setComplexBlock('o_regle', $tab_regle);
  $template->setComplexBlock('p_srov1', $tab_srov);
  $template->setComplexBlock('p_srov3', $tab_srov3);


  /////sauvegarder fichier

  $template -> saveAS('Rapport.docx');
  // $filename = "Rapport.docx";
  // header('Content-Description: File Transfer');
  // header('Content-type: application/force-download');
  // header('Content-Disposition: attachment; filename='.basename($filename));
  // header('Content-Transfer-Encoding: binary');
  // header('Content-Length: '.filesize($filename));
  // readfile($filename);

}


if($_POST['action'] == 'call_this') {
  doc_create();
}
  ?>
