<?php 
    function listemangaControleur($twig, $db){
        $manga = new Manga($db);

        if(isset($_GET['id'])){
            $exec=$manga->delete($_GET['id']);
           
            if (!$exec){
            $etat = false;
            }
            else{
            $etat = true;
            }
            header('Location: index.php?page=listemanga&etat='.$etat);
            exit;
            }
            if(isset($_GET['etat'])){
            $form['etat'] = $_GET['etat'];
            }

        $form = array();
        $liste = $manga->select();

        $limite=25;
        if(!isset($_GET['nopage'])){
            $inf=0;
            $nopage=0;
        }
        else{
            $nopage=$_GET['nopage'];
            $inf=$nopage * $limite;
        }
        $r = $manga->selectCount();
        $nb = $r['nb'];


        $liste1 = $manga->selectLimit($inf,$limite);
        $form['nbpages'] = ceil($nb/$limite);
        $form['nopage'] = $nopage;
        
        echo $twig->render('listemanga.html.twig', array('form'=>$form,'liste'=>$liste)); 


    }
?>