# TJ-1AIO1
Travail journalier sur réducteur d'URL et Base de données pour un fédération de judo - 1ère année d'Assistant Développeur.

Ce répertoire est composé des 2 travaux demandés durant cette année. Ils ont été réalisés par Mattias Cavalier, Mateo Oppenbrouwer, Enzo DE CICCO et Thomas DELEPINE.
Je vais résumer ici la tâche demandée ainsi que les fonctionnalités disponibles sur nos applications web. 

---

Pour UWURL, il fallait crée un réducteur d'URL avec comme fonctionnalités : 
- La possibilité de réduire une URL et de la customiser ainsi que de voir le nombre de fois que le lien à été cliqué. 
- La possibilité de générer un QR code pour son URL. 
- Un mode clair et un mode sombre. 

Notre application offre bien sûr toutes ces fonctionnalités mais bien plus encore ! 

Tout d'abord, il n'est possible d'accéder à l'appilcation que si l'utilisateur à créer un compte et que celui-ci n'a pas été désactivé par un administrateur. 

Pour la partie utilisateur sans rang. La page d'index lui permet de créer une URL raccourcie ainsi que la customiser. Il peux aussi consulter tous les liens qui ont été créé depuis la création du site ainsi que le nombre de clics sur chaque URL. 
Depuis la barre de navigation, il pourra se rendre sur 2 autres pages ; La page "Mes liens" qui permet à l'utilisateur de consulter tous les liens qu'il a créé ainsi que de générer un QR code pour chacuns d'entre-eux et la page profil pour changer ses informations personnelles ainsi que son mot de passe. 

Pour la partie administration, les fonctionnalités sont les mêmes que pour l'utilisateur lamda à l'exception qu'il a le droit depuis la page "index" de désactivé tous les liens qui ont été créé ains que l'accès à un onglet "Administration". Sur cette page, il pourra consulter et modfier tous ce qui concerne les utilisateurs. Premièrement, leur rang, qui lui permettra à tout moment de rajouter un adminstrateur pour l'aider. Ensuite, la petite horloge à côté du nom lui permettra de consulter l'historique des liens créés par un utilsateur et de les désactiver ou les supprimer. Il pourra aussi modifier les infomartions comme l'adresse e-mail, le pseudo, le rang ou le statut des utilisateurs depuis l'icône "modifier". Pour faciliter la tâche de l'administrateur, il possède aussi un barre de recherche où il peux 
aisément rechercher une personne avec son pseudo ou son adresse e-mail. 

En plus de tout cela, il est possible de changer le thème du site depuis les boutons situés en bas à gauche de l'écran pour pouvoir profiter du style épuré du site que ce soit en journée ou dans la pénombre ! 

Vous pouvez consulter l'application en ligne avec l'addresse https://uwurl.fr ou faire des tests par vous-même avec les fichiers sources disponibles dans ce répertoire. 

--- 

Pour la fédération de Judo, le plus important était de réaliser l'architcture de la base de données que vous pourrez retrouver dans le fichier "iy2bt_fwjudo.sql". Cependant, nous avons décidé de tout de même démarrer une ébauche de ce à quoi pourrez ressembler le site. Les fonctionnalités dessus sont encore très précaires et contiennent encore des bugs mais nous comptons bien encore essayer d'améliorer tout ceic avec un système de messagerie entre autres fonctionnalités !

Vous pouvez une fois encore consulter le site depuis l'adresse "https://judo.laviedemattias.be" ou consulter les fichiers sources dans ce répértoire ! 

Merci d'avoir consulté nos projets !  
