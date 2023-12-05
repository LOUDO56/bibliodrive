# bibliodrive
Un projet PHP fait durant ma première année d'étude en BTS SIO qui simule des empreints de livres.

# Principe

Une librairie ferme ses portes, mais pour pouvoir toujours emprunter des livres, on peut commander sur leur site Internet.

# But

Le but de ce projet et de conçevoir un site de A a Z avec le PHP pour nous se familiariser avec les base de données et le backend en général.
J'ai suivi le cahier des charges donné par ma professeure. Donc, il se peut que la navigation ou des éléments ne soit pas très fluide pour un utilisateur. C'est normal, le but n'est pas de créer un site pour un client mais de nous entraînez à coder en PHP.

# Preview

Voici à quoi ressemble mon site :

(Adresse email et adresse sont totalement fictives et servent seulement de placeholder.)

### Accueil
![image](https://github.com/LOUDO56/bibliodrive/assets/117168736/838bf640-933e-4f47-b341-b6d75d5e6a7c)

### Recherche
![image](https://github.com/LOUDO56/bibliodrive/assets/117168736/b789dff1-48e1-4603-b674-db90d99f1404)

### Détail d'un livre
![image](https://github.com/LOUDO56/bibliodrive/assets/117168736/e51846cf-2a72-4a08-9e43-a18fd470c0e3)

### Panier
![image](https://github.com/LOUDO56/bibliodrive/assets/117168736/a44177c1-f75f-4f4b-9c96-6d14f60bc18f)

# Faire fonctionne le projet

1. Installer <a href="https://www.apachefriends.org/fr/index.html">XAMPP</a>
2. Déplacer le projet dans C:/xampp/htdocs
3. Lancer les services APACHE et XAMPP
4. Aller sur `http://localhost/phpmyadmin`et créer la table "bibliodrive" et ensuite copier coller le script de `bibliodrive.sql` dans la rubrique SQL et executé le.
5. Aller sur votre navigateur et entrez le lien suivant `http://localhost/bibliodrive/src/accueil.php`
6. Pour se connecter, des identifiants Admin et Client sont déjà à votre disposition (admin: email: admin@admin.fr, mdp: admin | client: email: client@client.fr, mdp: client)
