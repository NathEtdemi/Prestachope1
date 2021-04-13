<?php
include_once("tools/databaselinker.php");
class SuperController
{
	public static function callPage($page)
	{
            switch($page)
            {
                case "presentation":
                {
                   include_once 'pages/presentation/presentation_view.php'; 
                   break; 
                }
                case "info":
                {
                    include_once 'pages/information/information_view.php';
                    break;
                }
                case "new_product":
                {
                    include_once("pages/header.php");
                    include_once '/xampp/htdocs/PrestachopeGroupe5/web/DAO/categorieDAO.php';
                    include_once 'pages/creationproduit/Creation_produitcontrolleur.php';
                    $instanceController = new Creation_produitcontrolleur();
                    $instanceController->includeView();
                    if (isset($_POST['Nom'],$_POST['description'],$_POST['prix'],$_POST['Stock'],$_POST['categorie']))
                    {
                        $target_dir = "C:/xampp/htdocs/PrestachopeGroupe5/assets/images/";
                        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                        if(isset($_POST["submit"])) 
                        {
                            echo "wtf";
                            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                            if($check !== false) 
                            {
                                echo "File is an image - " . $check["mime"] . ".";
                                $uploadOk = 1;
                            } 
                            else 
                            {
                                echo "File is not an image.";
                                $uploadOk = 0;
                            }
                        }
                        if (file_exists($target_file)) 
                        {
                          echo "Sorry, file already exists.";
                          $uploadOk = 0;
                        }

                        if ($_FILES["fileToUpload"]["size"] > 500000) 
                        {
                          echo "Sorry, your file is too large.";
                          $uploadOk = 0;
                        }

                        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif" ) 
                        {
                          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                          $uploadOk = 0;
                        }

                        if ($uploadOk == 0) 
                        {
                          echo "Sorry, your file was not uploaded.";
                        } 
                        else 
                        {
                            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
                            {
                                echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                            } 
                            else 
                            {
                                echo "Sorry, there was an error uploading your file.";
                            }
                        }
                        $instanceController->newproduct($_POST['Nom'],$_POST['description'],$_POST['prix'],$_POST['Stock'],$_POST['categorie']);
                    }
                        
                    }
                    break;
                case "new_categorie":
                {
                    include_once("pages/header.php");
                    include_once 'pages/creationcategorie/Creation_categoriecontrolleur.php';
                    $instanceController = new Creation_categoriecontrolleur();
                    $instanceController->includeView();
                    if (isset($_POST['Nom']))
                    {
                        $instanceController->newcategorie($_POST['Nom']);
                    }
                    break;
                }
                case "new_souscategorie":
                {
                    include_once("pages/header.php");
                    include_once 'pages/creationsouscategorie/Creation_souscategoriecontrolleur.php';
                    $instanceController = new Creation_souscategoriecontrolleur();
                    $instanceController->includeView();
                    if (isset($_POST['Nom'],$_POST['categorie']))
                    {
                        $instanceController->newsouscategorie($_POST['Nom'],$_POST['categorie']);
                    }
                break;
                }
                case "delete_produit":
                {
                    include_once("pages/header.php");
                    include_once 'pages/deleteproduit/delete_produitcontrolleur.php';
                    $instanceController = new delete_produitcontrolleur();
                    $instanceController->includeView();
                    if (isset($_POST['categorie']))
                    {
                        $instanceController->deleteproduit($_POST['categorie']);
                    }
                break;
                }
                case "delete_categorie":
                {
                    include_once("pages/header.php");
                    include_once 'pages/deleteproduit/delete_produitcontrolleur.php';
                    $instanceController = new delete_categoriecontrolleur();
                    $instanceController->includeView();
                    if (isset($_POST['produit']))
                    {
                        $instanceController->deletecategorie($_POST['produit']);
                    }
                break;
                }
                case "delete_souscategorie":
                {
                    include_once("pages/header.php");
                    include_once 'pages/deletesouscategorie/delete_souscategoriecontrolleur.php';
                    $instanceController = new delete_souscategoriecontrolleur();
                    $instanceController->includeView();
                    if (isset($_POST['souscategorie']))
                    {
                        $instanceController->deletesouscategorie($_POST['souscategorie']);
                    }
                break;
                }
                case "inscription":
                {
                    include_once("pages/header.php");
                    include_once 'pages/inscription/Inscription_controlleur.php';
                    $instanceController = new Inscription_controlleur();
                    $instanceController->includeview();
                    if (isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['adresse'], $_POST['mdp'], $_POST['conf_mdp']))
                    {
                        if ($_POST['mdp']==$_POST['conf_mdp'])
                        {
                            if($instanceController->newUtilisateur($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['adresse'], $_POST['mdp']))
                            {
                               $instanceController->redirectUser(); 
                            }
                        }
                        else
                        {
                            echo "les deux mots de passe sont différents";
                        }
                    }   
                break;
                }
                case "connexion":
                    include_once("pages/header.php");
                    include_once 'pages/connexion/Connexion_controller.php';
                    $instanceController = new Connexion_controller();
                    $instanceController->includeview();
                    if(isset($_POST['email'],$_POST['mdp']))
                        {
                            $instanceController->connectUtilisateur($_POST['email'], $_POST['mdp']);
                        }
                break;
            }
        }
}
?>