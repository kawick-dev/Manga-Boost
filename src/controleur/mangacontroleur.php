<?php 
    function ajoutemangaControleur($twig, $db){
        $type = new Manga($db);
        
    
        if(isset($_POST['btAjoutermanga'])){
            $titre = $_POST['titre'];
            $description = $_POST['description'];
            $nbtome = $_POST['nbtome'];
            $auteur = $_POST['auteur'];
            $dessinateur = $_POST['dessinateur'];
            $sortiedate = $_POST['sortiedate'];
            $prix = $_POST['prix'];
            $statut = $_POST['statut'];

            $upload = new Upload(array('png', 'gif', 'jpg', 'jpeg'), 'images', 500000);
            $photo = $upload->enregistrer('photo');

            $exec = $type->insert($titre, $description, $nbtome, $auteur, $dessinateur, $sortiedate, $prix, $statut, $photo['nom']);
            header("Location:index.php?page=ajoutemanga");
        }
        

        
        echo $twig->render('ajoutemanga.html.twig'); 



    }
    
?>
