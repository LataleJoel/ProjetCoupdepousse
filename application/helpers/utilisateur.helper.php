<?php
defined('__COUPDEPOUCE__') or die('Acces interdit');

abstract class UtilisateurHelper {

    public static function afficher() {
        if(!Authentification::estConnecte()){ return;}
        $utilisateur = Authentification::getUtilisateur();
        ?>
        <div id="utilisateur-helper">
            <h3>Bonjour</h3>
            <p><?php echo $utilisateur['prenom'] . ' ' . $utilisateur['nom']; ?></p>
            <a href="?controller=utilisateurs&action=deconnecter">
                <button class="cdp-button">Se Déconnecter</button>
            </a>
        </div>
        <?php
    }
}