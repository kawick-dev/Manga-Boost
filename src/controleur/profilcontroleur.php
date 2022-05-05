<?php 
    function profilControleur($twig, $db){
        $type = new Manga($db);

        $form = array();
        $liste = $type->select();
        
        echo $twig->render('profil.html.twig',array('liste'=>$liste)); 


    }
?>