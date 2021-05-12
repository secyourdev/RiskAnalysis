/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_tableau","#editable_table tbody tr")
/*----------------------------- EXPORT EXCEL --------------------------------*/
export_table_to_excel('editable_table','#button_download_tableau_recapitulatif','tableau_recapitulatif.xlsx')