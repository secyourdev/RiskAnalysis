<?php
session_start();
$id_projet = $_SESSION['id_projet'];

require_once 'bootstrap.php';
use PhpOffice\PhpWord\Element\Field;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\SimpleType\TblWidth;
include("content/php/bdd/connexion_sqli.php");

function doc_create(){
  global $id_projet;
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
  include("content/php/atelier2b/selection.php");
  include("content/php/atelier2c/selection.php");
  // //atelier 3
  include("content/php/atelier3a/selection.php");
  include("content/php/atelier3b/selection.php");
  include("content/php/atelier3c/selection.php");
  // //atelier 4
  include("content/php/atelier4a/selection.php");
  include("content/php/atelier4b/selection.php");
  // //atelier 5
  // include("content/php/atelier5a/selection.php");
  include("content/php/atelier5b/selection.php");
  include("content/php/atelier5c/selection.php");
  ////////////////////////////////////////////////////////////////////////////////
  //include
  include("tab_create.php");
  ////////////////////////////////////////////////////////////////////////////////

  $template = new \PhpOffice\PhpWord\TemplateProcessor('Template.docx');
/*****************    Atelier 1.1.1*********************************************************************/
  $rq_titre = mysqli_query($connect,"SELECT nom_projet FROM F_projet WHERE id_projet = $id_projet");
  $rq_version_for_1a = mysqli_query($connect,"SELECT num_version FROM ZC_version WHERE id_projet= $id_projet");

  $nom_projet = mysqli_fetch_all($rq_titre, MYSQLI_NUM)[0][0];
  $projet = mysqli_fetch_assoc($rq_donnees_principales_res);
  $respo = mysqli_fetch_row($rq_respo_res);
  $version = mysqli_fetch_row($rq_version_for_1a);
  //echo '<pre>'; print_r($projet);echo '</pre>';

  $template -> setValue('Titre', $nom_projet);
  $template -> setValue('nomProjet', $projet['nom_projet']);
  $template -> setValue('Objectif', $projet['objectif_projet']);
  $template -> setValue('jj/mm/aaaa1', date("d-m-Y",strtotime($projet['cadre_temporel'])));
  $template -> setValue('jj/mm/aaaa2', date("d-m-Y",strtotime($projet['cadre_temporel_etape_2'])));
  $template -> setValue('jj/mm/aaaa3', date("d-m-Y",strtotime($projet['cadre_temporel_etape_3'])));
  $template -> setValue('jj/mm/aaaa4', date("d-m-Y",strtotime($projet['cadre_temporel_etape_4'])));
  $template -> setValue('jj/mm/aaaa5', date("d-m-Y",strtotime($projet['cadre_temporel_etape_5'])));
  $template -> setValue('dure1',$projet['duree_strategique']);// stratégique
  $template -> setValue('dure2',$projet['duree_operationnel']);// opérationnel
  $template -> setValue('niveauConfidentialite',$projet['confidentialite']);
  $template -> setValue('version', $version[0]);
  $template -> setValue('responsable', $respo[0]);

  /*********************Seuils*******************************************************************/

$rq_seuils = mysqli_query($connect, "SELECT seuil_danger,seuil_controle, seuil_veille FROM Q_seuil WHERE id_projet = $id_projet ");
$row_seuil = mysqli_fetch_assoc($rq_seuils);//, MYSQLI_ASSOC);
$template -> setValue('danger', $row_seuil['seuil_danger'][0]);
$template -> setValue('contrôle', $row_seuil['seuil_controle'][0]);
$template -> setValue('veille', $row_seuil['seuil_veille'][0]);



/****************************************Tableaux**********************************************/
  ///atelier1*************************************************************************
  //1.a//////////////////////////////////////////////////////////
  $tab_acteurs = genere_tableau_rapport($rq_tab_acteurs);
  $tab_raci = tab_raci($rq_first_tab, $rq_atelier_raci_tab, $rq_raci_tab);

  //1.b/////////////////////////////////////////////////////////
  $tab_vm = genere_tableau_rapport($rq_vm_tab);
  $tab_biens = genere_tableau_rapport($rq_biens_tab);
  $tab_mission = genere_tableau_rapport($rq_mission_tab);

  //1.c/////////////////////////////////////////////////////////////

  $tab_echelle = genere_tableau_rapport($rq_echelle_tab);
  $tab_niveau  = genere_tableau_rapport($rq_niveau_tab);

  $tab_evred = tab_dyn1c_3b_4b($rq_evred_tab);

  //1.d///////////////////////////////////////////////////////////////
  $tab_socle_sec = tab_dyn_1d($rq_socle_sec_tab);
  $tab_regle = genere_tableau_rapport($rq_regle_tab);

  ///atelier2*******************************************************************************
  //2.a/////////////////////////////////////////////////////////////////
  $tab_srov = genere_tableau_rapport($rq_srov_tab);


  //2.b///////////////////////////////////////////////////////////////
  $tab_srov2 = tab_dyn2b_3a_3c($rq_srov2_tab);

  //2.c///////////////////////////

  $tab_srov3 = genere_tableau_rapport($rq_srov3_tab);

  ///atelier 3************************************************************
  //3.a/////////////////////////////////////
  $tab_partie = tab_dyn2b_3a_3c($rq_partie_tab);

  //3.b //////////////////////////////////////

  $tab_cidt = tab_dyn1c_3b_4b($rq_cidt_tab);
  $tab_srov4 = genere_tableau_rapport($rq_srov4_tab);
  $tab_scenar_strat1 = genere_tableau_rapport($rq_scenar_strat3b_tab);
  $tab_chemin_attaque = genere_tableau_rapport($rq_chemin_attaque_tab);

  //3.c////////////////////////////////////////////////
  $tab_partie2 = tab_dyn2b_3a_3c($rq_partie2_tab);
  $tab_scenar_strat = genere_tableau_rapport($rq_scenar_strat_tab);

  ///atelier 4*************************************************************
  //4.a/////////////////////////////////////////////////
  $tab_scen_strat_etabli= genere_tableau_rapport($rq_scen_strat_tab);
  //$tab_scen_op= genere_tableau_rapport($rq_scen_op);
  $tab_mode_op= genere_tableau_rapport($rq_mode_op_tab);
  //4.b/////////////////////////////////////////////////
  $tab_echelle_b = tab_dyn1c_3b_4b($rq_echelle_b_tab);
  $tab_vraisemblance_b = tab_dyn1c_3b_4b($rq_vraisemblance_tab);

  $tab_eval_vrai = tab_dyn1c_3b_4b($rq_eval_vrai_tab);

  ///atelier 5*************************************************************
  //5.b/////////////////////////////////////////////////
  $tab_plan_amelio = genere_tableau_rapport($rq_plan_amelio_tab);
  //5.c/////////////////////////////////////////////////
  $tab_eval_risk_resi = genere_tableau_rapport($qr_eval_risk_resi_tab);


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
  $template->setComplexBlock('p_srov2', $tab_srov2);
  $template->setComplexBlock('p_srov3', $tab_srov3);
  $template->setComplexBlock('m_evenement_redoute', $tab_evred);
  $template->setComplexBlock('r_partie_prenante1', $tab_partie);
  $template->setComplexBlock('r_partie_prenante2', $tab_partie2);
  $template->setComplexBlock('p_srov4', $tab_srov4);
  $template -> setComplexBlock('s_scenario_strategique1', $tab_scenar_strat1);
  $template->setComplexBlock('m_evenement_redoute2', $tab_cidt);
  $template->setComplexBlock('eval_vrai', $tab_eval_vrai);
  $template->setComplexBlock('za_traitement_de_securite', $tab_plan_amelio);
  $template->setComplexBlock('last_table', $tab_eval_risk_resi);
  $template->setComplexBlock('t_chemin_d_attaque_strategique', $tab_chemin_attaque);
  $template->setComplexBlock('s_scenario_strategique3', $tab_scen_strat_etabli);
  $template->setComplexBlock('mode_operatoire', $tab_mode_op);
  $template -> setComplexBlock('s_scenario_strategique2', $tab_scenar_strat);
  $template -> setComplexBlock('da_echelle1', $tab_echelle_b);
  $template -> setComplexBlock('u_scenario_operationnel', $tab_vraisemblance_b);


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
