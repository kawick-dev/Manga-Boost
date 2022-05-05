<?php 
    function listeanimeControleur($twig, $db){
        $anime = new Anime($db);

        if(isset($_GET['id'])){
            $exec=$anime->delete($_GET['id']);
           
            if (!$exec){
            $etat = false;
            }
            else{
            $etat = true;
            }
            header('Location: index.php?page=listeanime&etat='.$etat);
            exit;
            }
            if(isset($_GET['etat'])){
            $form['etat'] = $_GET['etat'];
            }

        $form = array();
        $liste = $anime->select();

        $limite=25;
        if(!isset($_GET['nopage'])){
            $inf=0;
            $nopage=0;
        }
        else{
            $nopage=$_GET['nopage'];
            $inf=$nopage * $limite;
        }
        $r = $anime->selectCount();
        $nb = $r['nb'];
    

        $liste = $anime->selectLimit($inf,$limite);
        $form['nbpages'] = ceil($nb/$limite);
        $form['nopage'] = $nopage;

        echo $twig->render('listeanime.html.twig', array('form'=>$form,'liste'=>$liste)); 
    }

?>