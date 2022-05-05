<?php
    function getPage($db){
        
        $lesPages['accueil'] = "accueilControleur";
        $lesPages['inscrire'] = "inscrireControleur";
        $lesPages['mentions'] = "mentionsControleur";
        $lesPages['connexion'] = "connexionControleur";
        $lesPages['maintenance'] = "maintenanceControleur";
        $lesPages['deconnexion'] = "deconnexionControleur";
        $lesPages['utilisateur'] = "utilisateurControleur";
        $lesPages['ajouteanime'] = "ajouteanimeControleur";
        $lesPages['ajoutemanga'] = "ajoutemangaControleur";
        $lesPages['contact'] = "contactControleur";
        $lesPages['persocontact'] = "persocontactControleur";
        $lesPages['listeanime'] = "listeanimeControleur";
        $lesPages['listemanga'] = "listemangaControleur";
        $lesPages['actu'] = "actuControleur";
        $lesPages['profil'] = "profilControleur";
        $lesPages['modif'] = "utilisateurModifControleur";
        $lesPages['recherche'] = "rechercheControleur";
        $lesPages['modifanime'] = "modifanimeControleur";
        $lesPages['modifmanga'] = "modifmangaControleur";

        

        if ($db!=null){
        if(isset($_GET['page'])){
        
        $page = $_GET['page']; }
        else{
        
        $page = 'accueil';
        }
        if (!isset($lesPages[$page])){
        
        $page = 'accueil';
        }
        $contenu = $lesPages[$page];
        }
        else{
        $contenu = $lesPages['maintenance'];
        }
        
        return $contenu;
        }
?>
