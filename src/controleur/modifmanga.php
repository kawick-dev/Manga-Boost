<?php 
function modifmangaControleur($twig, $db){
    
    $form = array();
    if(isset($_GET['id'])){
        $manga = new Manga($db);
        $unManga = $manga->selectById($_GET['id']);
        if ($unManga!=null){
            $form['manga'] = $unManga;
            $form['titremanga'] = $unManga['titre'];
            $form['descriptionmanga'] = $unManga['description'];
            $form['nbtome'] = $unManga['nbtome'];
            $form['auteur'] = $unManga['auteur'];
            $form['dessinateur'] = $unManga['dessinateur'];
            $form['sortiedate'] = $unManga['sortiedate'];
            $form['prix'] = $unManga['prix'];
            $form['statut'] = $unManga['statut'];
                  
        }
        else{
            $form['message'] = 'Utilisateur incorrect';
        }
    }
    else{
        if(isset($_POST['btModifmanga'])){
            $manga = new Manga($db);

            $id = $_POST['id'];
            $titre = $_POST['titre'];
            $description = $_POST['description'];
            $nbtome = $_POST['nbtome'];
            $auteur = $_POST['auteur'];
            $dessinateur = $_POST['dessinateur'];
            $sortiedate = $_POST['sortiedate'];
            $prix = $_POST ['prix'];
            $statut = $_POST['statut'];

            $exec=$manga->update($id, $titre, $description, $nbtome, $auteur, $dessinateur, $sortiedate, $prix, $statut);
            header("Location:index.php?page=modifmanga&id={{form.manga.id}}");

            if(!$exec){
                $form['valide'] = false;
                $form['message'] = 'Echec de la modification';
                header("Location:index.php?page=modifmanga&id={{form.manga.id}}");
            }
            else{
                $form['valide'] = true;
                $form['message'] = 'Modification réussie';
                header("Location:index.php?page=modifmanga&id={{form.manga.id}}");
                
            }
        }
        else{
            $form['message'] = 'Utilisateur non précisé';
        }
    }
           
    echo $twig->render('mangamodif.html.twig', array('form'=>$form));

    
}
?>