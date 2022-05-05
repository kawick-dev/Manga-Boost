<?php 
    function ajouteanimeControleur($twig, $db){
        $type = new Anime($db);
    
        if(isset($_POST['btAjouteranime'])){
            $titre = $_POST['titre'];
            $description = $_POST['description'];
            $nbsaison = $_POST['nbsaison'];
            $studioanime = $_POST['studioanime'];
            $statut = $_POST['statut'];
            

            $upload = new Upload(array('png', 'gif', 'jpg', 'jpeg'), 'images', 500000);
            $photo = $upload->enregistrer('photo');
            
            $exec = $type->insert($titre, $description, $nbsaison, $studioanime, $statut, $photo['nom']);
            header("Location:index.php?page=ajouteanime");
        }
        
        echo $twig->render('ajouteanime.html.twig'); 



    }
?>


