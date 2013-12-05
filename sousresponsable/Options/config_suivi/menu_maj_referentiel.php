<table width="100%" >
  <tr >
    <td width="15%" height="34" class="sous_titre_tableau"><a href='maj_referentiel.php?id_arbre=<?php echo"$arbre->id_arbre" ?>' ><img src='../../../images/b_edit.png' border='0' title='supprimer'>Modifier
    le contenu </a>      <td width="16%" class="sous_titre_tableau"><img src='../../../images/b_edit.png' border='0' title='supprimer'> <a href='#' onClick="window.open('modifier_referentiel.php?id_arbre=<?php echo"$arbre->id_arbre" ?>','','width=600 height=400 scrollbars=yes')">Modifier
        son intitulé </a>    
    <td width="12%" align="left" class="sous_titre_tableau"> <a href='supprimer_referentiel.php?action=supprimer&id_arbre=<?php echo"$arbre->id_arbre" ?>' 
			   onClick='return deleteConfirm("ce référentiel")' > <img src='../../../images/b_drop.png' border='0' title='supprimer'> Le
        supprimer </a>
    <td width="15%" align="left" class="sous_titre_tableau"> <img src='../../../images/ico_corbeille.png' width="22" height="22" border='0' title='supprimer'> <a href='supprimer_referentiel.php?action=vider&id_arbre=<?php echo"$arbre->id_arbre" ?>' 
			   onClick='return confirm("Ëtes-vous sur de vouloir vider le contenu de ce référentiel")' > Vider
        son contenu </a>
    <td width="13%" align="left" class="sous_titre_tableau"> <img src='../../../images/ico_afficherOUarborescence.png' width="22" height="22" border='0'> <a href='afficher_referentiel.php?id_arbre=<?php echo"$arbre->id_arbre" ?>' > Afficher
        tout le contenu </a>
    <td width="16%" align="left" class="sous_titre_tableau"> <a href='mode_validation_referentiel.php?id_arbre=<?php echo"$arbre->id_arbre" ?>' > <img src='../../../images/ico_valider.png' width="22" height="22" border='0'>Mode
        de validation</a>
    <td width="13%" align="left" class="sous_titre_tableau"> <a href='criteres_performance.php?id_arbre=<?php echo"$arbre->id_arbre" ?>' ><img src='../../../images/ico_valider.png' width="22" height="22" border='0'> Critères
        de performance </a> 
  </tr>
</table>
