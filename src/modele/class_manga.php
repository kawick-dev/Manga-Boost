<?php
class Manga{
 private $select;
 private $db;
 private $insert;
 private $selectLimit;
 private $selectCount;
 private $update;
 private $delete;
 private $selectById;


 public function __construct($db){
    $this->db = $db;
    $this->insert = $this->db->prepare("insert into manga(titre, description, nbtome, auteur, dessinateur, sortiedate, prix, statut, photo) values(:titre, :description, :nbtome, :auteur, :dessinateur, :sortiedate, :prix, :statut, :photo)");
    $this->select = $this->db->prepare("select id, titre, description, nbtome, auteur, dessinateur, sortiedate, prix, statut, photo from manga order by titre ");
    $this->selectLimit = $db->prepare("select id, titre, description, nbtome, auteur, dessinateur, sortiedate, prix, statut, photo from manga order by titre limit :inf,:limite");
    $this->selectCount = $db->prepare("select count(*) as nb from manga");
    $this->selectById = $db->prepare("select id ,titre, description, nbtome, auteur, dessinateur, sortiedate, prix, statut from manga where id=:id");
    $this->update = $db->prepare("update manga set titre=:titre, description=:description, nbtome=:nbtome, auteur=:auteur, dessinateur=:dessinateur, sortiedate=:sortiedate, prix=:prix, statut=:statut where id=:id");
    $this->delete = $db->prepare("delete from manga where id=:id");
   }

 public function insert($titre, $description, $nbtome, $auteur, $dessinateur, $sortiedate, $prix, $statut, $photo){
    $this->insert->execute(array('titre'=>$titre, 'description'=>$description, 'nbtome'=>$nbtome, 'auteur'=>$auteur, 'dessinateur'=>$dessinateur, 'sortiedate'=>$sortiedate, 'prix'=>$prix, 'statut'=>$statut, 'photo'=>$photo));
    if ($this->insert->errorCode()!=0){
        print_r($this->insert->errorInfo());
        $r=false;
        }
        return $r;
 }

 public function select(){
   $this->select->execute();
   if ($this->select->errorCode()!=0){
       print_r($this->select->errorInfo());
   }
   return $this->select->fetchAll();
}
 
 public function selectLimit($inf, $limite){
   $this->selectLimit->bindParam(':inf', $inf, PDO::PARAM_INT);
   $this->selectLimit->bindParam(':limite', $limite, PDO::PARAM_INT);
   $this->selectLimit->execute();
   if ($this->selectLimit->errorCode()!=0){
   print_r($this->selectLimit->errorInfo());
   }
   return $this->selectLimit->fetchAll();
   }
 
public function selectCount(){
 $this->selectCount->execute();
 if ($this->selectCount->errorCode()!=0){
 print_r($this->selectCount->errorInfo());
 }
 return $this->selectCount->fetch();
 }

public function delete($id){
   $r = true;
   $this->delete->execute(array(':id'=>$id));
   if ($this->delete->errorCode()!=0){
   print_r($this->delete->errorInfo());
   $r=false;
   }
   return $r;
}
  

public function update($id, $titre, $description, $nbtome, $auteur, $dessinateur, $sortiedate, $prix, $statut){
   $r = true;
   $this->update->execute(array(':id'=>$id, 'titre'=>$titre, 'description'=>$description, 'nbtome'=>$nbtome, 'auteur'=>$auteur, 'dessinateur'=>$dessinateur, 'sortiedate'=>$sortiedate, 'prix'=>$prix, 'statut'=>$statut));
   if ($this->update->errorCode()!=0){
   print_r($this->update->errorInfo());
   $r=false;
   }
   return $r;
   }

public function selectById($id){
   $this->selectById->execute(array(':id'=>$id));
   if ($this->selectById->errorCode()!=0){
   print_r($this->selectById->errorInfo());
   }
   return $this->selectById->fetch();
   }


}

?>