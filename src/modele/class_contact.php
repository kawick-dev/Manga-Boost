<?php

class Contact{
    private $db;
    private $insert;
    private $select;
    private $selectByContact;


    public function __construct($db){
    $this->db = $db;
    $this->insert = $this->db->prepare("insert into contact(nom, email, message) values (:nom, :email, :message)");
    $this->selectByContact = $db->prepare("select id, nom, email, message from contact where id=:id, nom=:nom, email=:email, message=:message");
    $this->select = $db->prepare("select id, nom, email, message from contact order by id");

    }
    public function insert($nom, $email, $message){
        $r = true;
        $this->insert->execute(array(':nom'=>$nom, ':email'=>$email, ':message'=>$message));
        if ($this->insert->errorCode()!=0){
            print_r($this->insert->errorInfo());
            $r=false;
        }
        return $r;
    }

    public function selectByContact($nom, $email, $message){
        $this->selectByContact->execute(array(':nom'=>$nom, ':email'=>$email, ':message'=>$message));

        if($this->selectByContact->errorCode()!=0){
            print_r($this->selectByContact->errorInfo());
        }

        return $this->selectByContact->fetch();
    }

    public function select(){
        $this->select->execute();
        if ($this->select->errorCode()!=0){
        print_r($this->select->errorInfo());
        }
        return $this->select->fetchAll();
    }
       
}
?>