<?php 
function modifanimeControleur($twig, $db){

    $form = array();
    if(isset($_GET['id'])){

        $anime = new Anime($db);
        $unAnime = $anime->selectById($_GET['id']);
        if ($unAnime!=null){
            $form['anime'] = $unAnime;
            $form['titreanime'] = $unAnime['titre'];
            $form['descriptionanime'] = $unAnime['description'];
            $form['nbsaisonanime'] = $unAnime['nbsaison'];
            $form['studioanime'] = $unAnime['studioanime'];
            $form['statutanime'] = $unAnime['statut'];        
        }
        else{
            $form['message'] = 'Utilisateur incorrect';
        }
    }
    else{
        if(isset($_POST['btModifanime'])){
            $anime = new Anime($db);

            $titre = $_POST['titre'];
            $description = $_POST['description'];
            $nbsaison = $_POST['nbsaison'];
            $statut = $_POST['statut'];
            $studioanime = $_POST['studioanime'];
            $id = $_POST['id'];

            $exec=$anime->update($id, $titre, $description, $nbsaison, $statut, $studioanime);
            header("Location:index.php?page=listeanime");

            if(!$exec){
                $form['valide'] = false;
                $form['message'] = 'Echec de la modification';
                header("Location:index.php?page=listeanime");
            }
            else{
                $form['valide'] = true;
                $form['message'] = 'Modification réussie';
                header("Location:index.php?page=listeanime");
                
            }
        }
        else{
            $form['message'] = 'Utilisateur non précisé';
        }
    }
           
    echo $twig->render('animemodif.html.twig', array('form'=>$form));
}
?>