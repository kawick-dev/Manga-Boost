<?php
class Anime{
 private $select;
 private $db;
 private $insert;
 private $selectLimit;
 private $selectCount;
 private $delete;
 private $recherche;
 private $selectById;
 private $update;

 public function __construct($db){
    $this->db = $db;
    $this->insert = $this->db->prepare("insert into anime(titre, description, nbsaison, studioanime, statut, photo) values(:titre, :description, :nbsaison, :studioanime, :statut, :photo)");
    $this->select = $this->db->prepare("select id, titre, description, nbsaison, studioanime, statut, photo from anime order by titre ");
    $this->selectCount = $db->prepare("select count(*) as nb from anime");
    $this->selectLimit = $db->prepare("select id ,titre, description, nbsaison, studioanime, statut, photo from anime order by titre limit :inf,:limite");
    $this->delete = $db->prepare("delete from anime where id=:id");
    $this->recherche = $db->prepare("select * FROM anime where titre LIKE :recherche order by titre");
    $this->selectById = $db->prepare("select id ,titre, description, nbsaison, studioanime, statut from anime where id=:id");
    $this->update = $db->prepare("update anime set titre=:titre, description=:description, nbsaison=:nbsaison, statut=:statut, studioanime=:studioanime where id=:id");
   }

 public function insert($titre, $description, $nbsaison, $studioanime, $statut, $photo){
    $r = true;
    $this->insert->execute(array('titre'=>$titre, 'description'=>$description, 'nbsaison'=>$nbsaison, 'studioanime'=>$studioanime, 'statut'=>$statut, 'photo'=>$photo));
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
public function recherche($recherche){
   $this->recherche->execute(array('recherche'=>'%'.$recherche.'%'));
   if ($this->recherche->errorCode()!=0){
   print_r($this->recherche->errorInfo());
   }
   return $this->recherche->fetchAll();
   }  
   
public function selectById($id){
   $this->selectById->execute(array(':id'=>$id));
   if ($this->selectById->errorCode()!=0){
   print_r($this->selectById->errorInfo());
   }
   return $this->selectById->fetch();
   }

public function update($id, $titre, $description, $nbsaison, $statut, $studioanime){
   $r = true;
   $this->update->execute(array(':id'=>$id, ':titre'=>$titre, ':description'=>$description, ':nbsaison'=>$nbsaison, ':statut'=>$statut, ':studioanime'=>$studioanime));
   if ($this->update->errorCode()!=0){
   print_r($this->update->errorInfo());
   $r=false;
   }
   return $r;
   }
     
}


?>