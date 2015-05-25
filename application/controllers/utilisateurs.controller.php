<?php
defined('__COUPDEPOUCE__')or die('Access Interdit');
Application::useModele('utilisateurs');
Application::useModele('formations');
class UtilisateursController extends Controller{

      public function __construct(){
                
    }
     public function enregistrerAction(){
        $page=Application::getPage();
 $page->setTemplate('application');
 $page->setVue('utilisateur_enregistre'); 
  Page::ajouterCSS('coupsdepousse');
  Page::ajouterCSS('form');
    }
   public function ajouterAction(){
 $page=Application::getPage();
 $page->setTemplate('index');
 $page->setVue('ajouter_utilisateur'); 
 Page::ajouterCSS('form');
 Page::ajouterCSS('ajouter_utilisateur');
 Page::ajouterCSS('coupsdepousse');
 $form=new FormationsModel();
 
 $page->listeFormations=$form->lister();
 $page->formation=filter_var(HTTPHelper::post('formation',''),FILTER_SANITIZE_STRING);
 $page->nom=filter_var(HTTPHelper::post('nom',''),FILTER_SANITIZE_STRING);
 $page->nom= trim($page->nom);
 $page->prenom=filter_var(HTTPHelper::post('prenom',' '),FILTER_SANITIZE_STRING);
 $page->prenom=  trim($page->prenom);
 $page->login=filter_var(HTTPHelper::post('login',' '),FILTER_SANITIZE_STRING);
 $page->login=  trim($page->login);
 $page->email=filter_var(HTTPHelper::post('email',' '),FILTER_SANITIZE_STRING);
 $page->email=  trim($page->email);
 $page->mot_de_passe=filter_var(HTTPHelper::post('mot_de_passe',' '),FILTER_SANITIZE_STRING);
 $page->mot_de_passe=  trim($page->mot_de_passe);
 $page->verification=filter_var(HTTPHelper::post('verification',' '),FILTER_SANITIZE_STRING);
 $page->verification=  trim($page->verification);
 if($_SERVER['REQUEST_METHOD']=='GET'){
    return $page->formMessage; 
 }
$valcle=FormHelper::validerCleCSRF();
if(!$valcle){
    throw new Erreur('session invalide');
}
 if($page->formation=='---'){
   return $page->formMessage='Veuillez choisir une formation';      
 }
 if(!$form->estValide($page->formation)){
      return $page->formMessage='Formation inconnue';
 }
 if(empty($page->nom)){
    return $page->formMessage='Veuillez entrer un Nom';
 }
 else if(empty($page->prenom)){
    return $page->formMessage='Veuillez entrer un prenom';
 }
 else if(empty($page->login)){
    return $page->formMessage='Veuillez entrer un Login';
 }
  else if(empty($page->mot_de_passe)){
    return $page->formMessage='Veuillez entrer un Mot de Passe';
 }
 else if(empty($page->email)){
    return $page->formMessage='Veuillez entrer une adresse mail';
 }
 if(strlen($page->nom)>256){
  throw new Erreur('Le Nom doit etre inférieur a 256 caractères');   
 }
  else if(strlen($page->prenom)>256){
  throw new Erreur('Le Prenom doit etre inférieur a 256 caractères');   
 }
 else if(strlen($page->login)>32){
  throw new Erreur('Le Login doit etre inférieur a 32 caractères');   
 }
 else if(strlen($page->login)<4){
  throw new Erreur('Le Login doit etre supérieur a 4 caractères');   
 }
  else if(strlen($page->mot_de_passe)<5){
  throw new Erreur('Le Mot de Passe doit etre supérieur a 5 caractères');   
 }
   if(!($page->verification==$page->mot_de_passe)){
  throw new Erreur('Confirmer votre mot de passe');   
 }
 if(strpos($page->login,' ')!==FALSE){
  throw new Erreur('Login doit etre Sans espaces');   
 }
 if(strpos($page->email,' ')!==FALSE){
  throw new Erreur('Votre adresse mail doit etre Sans espaces');   
 }
 if(!filter_var($page->email,FILTER_VALIDATE_EMAIL)){
  throw new Erreur('Votre adresse mail doit etre Sans espaces');   
 }
 if(!filter_var($page->mot_de_passe,FILTER_UNSAFE_RAW)){
  throw new Erreur('Votre Mot de Passe doit etre Sans espaces');   
 }
 
 if(strlen($page->email)>256){
  throw new Erreur('Votre adresse mail doit etre inférieur a 256 caractères');   
 }
    $model=new UtilisateursModel();
       $doub=$model->loginExiste($page->login);
    if($doub==FALSE){
       $model->enregistrer($page->nom, $page->prenom,$page->login,$page->email,$page->mot_de_passe,$page->formation);
    } 
   
   return HTTPHelper::rediriger('?controller=utilisateurs&action=enregistrer');
}

    public  function seconnecterAction(){
        if(Authentification::estConnecte()){
            HTTPHelper::rediriger('?controller=index&action=index');
        }
 $page=Application::getPage();
 $page->setTemplate('index');
 $page->setVue('seconnecter');
 Page::ajouterCSS('seconnecter');
 Page::ajouterCSS('form');
 Page::ajouterCSS('coupsdepousse');
 $page->login=filter_var(HTTPHelper::post('login',' '),FILTER_SANITIZE_STRING);
 $page->login=  trim($page->login);
 $page->mot_de_passe=filter_var(HTTPHelper::post('mot_de_passe',' '),FILTER_SANITIZE_STRING);
 $page->mot_de_passe=  trim($page->mot_de_passe);
 if($_SERVER['REQUEST_METHOD']=='GET'){
    return $page->formMessage; 
 }
 $valcle=FormHelper::validerCleCSRF();
if(!$valcle){
    throw new Erreur('session invalide');
}
 if(is_null($page->login)){
  throw new Erreur('Le champ Login ne peut etre vide');   
 }
 if(is_null($page->mot_de_passe)){
  throw new Erreur('le champ Mot de Passe ne peut etre vide');   
 }
 //Authentification::authentifier($page->login, $page->mot_de_passe);
 if(Authentification::authentifier($page->login, $page->mot_de_passe)==FALSE){
     return $page->formMessage='Login et Mot de Passe Incorrect';
 }
 else {
     Authentification::estConnecte();
  //HTTPHelper::rediriger('?controller=index&action=index');
 }
    }
    public  function deconnecterAction(){
        Authentification::deconnecter();
        HTTPHelper::rediriger('?controller=index&action=index');
    
    }
    
}

