<?php
function typeControleur($twig, $db){
 $form = array();
 $type = new Type($db);
    if (isset($_POST['btAjouteranime'])){
        $libelle = $_POST['libelle'];
        $exec = $type->insert($libelle);
        header("Location:index.php?page=ajouteanime");
    }
 $liste = $type->select();
 echo $twig->render('type.html.twig', array('form'=>$form,'liste'=>$liste));
}
?>