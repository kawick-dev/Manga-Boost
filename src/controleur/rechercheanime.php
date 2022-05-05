<?php 
function rechercheControleur($twig, $db){
    $rechercheanime = new Anime($db);
    if(isset($_GET['btRecherche'])){
        
        $recherche = $_GET['inputrecherche'];
        var_dump($recherche);
        //header("Location:index.php?page=recherche"); 
}
    var_dump($recherche);
    echo $twig->render('listeanime.html.twig'); 
}
?>