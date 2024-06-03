# ECF GARAGE Vincent Parrot

## Description

Développement d'un site web pour la gestion administrative d'un garage automobile.

Programmation orientée objet avec architecture MVC

## Installation

1. **Installer XAMPP** : Téléchargez et installez XAMPP à partir du site officiel. Suivez les instructions d'installation fournies par XAMPP.

2. **Cloner le dépôt** : Ouvrez une fenêtre de terminal ou d'invite de commande et naviguez vers le dossier htdocs de XAMPP. Ensuite, clonez le dépôt en utilisant la commande git suivante :

git clone https://github.com/Edgo74/ecf_garage_v_parrot.git

3. **Démarrer le serveur Apache** : 
Ouvrez le panneau de contrôle de XAMPP et démarrez les services Apache et MySQL.

5. **Configurer la base de données**

Ouvrez une fenêtre de terminal ou d'invite de commande et connectez-vous à MySQL en utilisant la commande suivante :
 mysql -u root -p

Une fois connecté à MySQL, créez une nouvelle base de données en utilisant la commande suivante :
CREATE DATABASE garage;

Utilisez la commande suivante pour utiliser la nouvelle base de données :
USE garage;

Enfin, exécutez le fichier SQL dans le dossier de votre projet en utilisant la commande suivante :
mysql -u root -p garage < garage.sql

5. **Accéder au projet** : 
Ouvrez un navigateur web et naviguez vers `http://localhost/ecf_garage_v_parrot`.

Pour se connecter en tant qu'administrateur : 
entrer  "admin@mail.com" pour l'email. 
entrer "Eucalyptus17?" pour le mot de passe. 

