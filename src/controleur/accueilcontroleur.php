<?php
    function accueilControleur($twig){
        echo $twig->render('accueil.html.twig', array());

    }
    function contactControleur($twig, $db){
        $form = array();
        $contact = new Contact($db);
            if (isset($_POST['btContact'])){
            $inputName = $_POST['inputNom'];
            $inputEmail = $_POST['inputEmail'];
            $user_message = $_POST['inputM'];
            $form['valide'] = true;
            $form['name'] = $inputName;
            $form['email'] = $inputEmail;
            $form['message'] = $message;
            $exec = $contact->insert($inputName, $inputEmail, $user_message);
            header("Location:index.php?page=contact");
            }

        echo $twig->render('contact.html.twig', array('form'=>$form));;
    }
    function persocontactControleur($twig, $db){
        $form = array();
        $contact = new Contact($db);

        $liste1 = $contact->select();
        echo $twig->render('persocontact.html.twig', array('form'=>$form,'liste1'=>$liste1));
    }

    function connexionControleur($twig, $db){
        $form = array();
       
        if (isset($_POST['btConnecter'])){
            $form['valide'] = true;
            $inputEmail = $_POST['inputEmail'];
            $inputPassword = $_POST['inputPassword'];
            $utilisateur = new Utilisateur($db);
            $unUtilisateur = $utilisateur->connect($inputEmail);

            if ($unUtilisateur!=null){
                if(!password_verify($inputPassword,$unUtilisateur['mdp'])){ 
                $form['valide'] = false;
                $form['message'] = 'Login ou mot de passe incorrect';
                }
                else{
                    $_SESSION['login'] = $inputEmail;
                    $_SESSION['role'] = $unUtilisateur['idRole'];
                    header("Location:index.php");
                }
                
            }   
            else{
            $form['valide'] = false;
            $form['message'] = 'Login ou mot de passe incorrect';
            }
        }
        echo $twig->render('connexion.html.twig', array('form'=>$form));
       }
       function deconnexionControleur($twig, $db){
        session_unset();
        session_destroy();
        header("Location:index.php");
       }       
    
               

    function inscrireControleur($twig, $db){
        $form = array();
        if (isset($_POST['btInscrire'])){
            $inputEmail = $_POST['inputEmail'];
            $inputPassword = $_POST['inputPassword'];
            $inputPassword2 = $_POST['inputPassword2'];
            $role = $_POST['role'];
            $form['valide'] = true;
            $form['email'] = $inputEmail;
            $form['role'] = $role;
            $nom = $_POST['inputNom'];
            $prenom = $_POST['inputPrenom'];

            if ($inputPassword != $inputPassword2){
                $form['valide'] = false;
                $form['message']= 'Les mots de passe sont différents';
            }
            else{
                $utilisateur = new Utilisateur($db);
                $verif = $utilisateur->connect($inputEmail);
                if ($verif == NULL){
                    $exec = $utilisateur->insert($inputEmail, password_hash($inputPassword,
                    PASSWORD_DEFAULT), $role, $nom, $prenom);
                    if (!$exec){
                        $form['valide'] = false;
                        $form['message'] = 'Problème d\'insertion dans la table utilisateur ';
                    } 
                }   
                else{
                    $form['valide'] = false;
                    $form['message'] = 'L\'email existe deja';
                }
                
            
            }     
       
        }
        echo $twig->render('inscrire.html.twig', array('form'=>$form));
    }

    
    
    function maintenanceControleur($twig){
        echo $twig->render('maintenance.html.twig', array());
    }

    function actuControleur($twig){
        echo $twig->render('actu.html.twig', array());
    }

    
?>