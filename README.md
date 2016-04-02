lisf2
====

Introduction
====
lisf est un script php permettant de lister les fichiers du mois en cours se trouvant dans un dossier ainsi que les archives.

Installation
====
Dans le fichier *index.php*, indiquez le répertoire d'installation du script dans la variable `$install_path` à la ligne 21.

Par exemple, si le script est installé dans le sous répertoire `http://dol.lu/files/`, la variables devra être initialisée comme ceci : `$install_path = "/files/";`.

Si vous souhaitez simplement installer le script à la racine, laissez la variable vide : `$install_path = "/";` (aussi dans le cas d'un sous domaine type `http://sousdomaine.dol.lu/`)

Puis mettez simplement le fichier *index.php* à l'endroit où vous souhaitez lister vos dossiers/fichiers.

Convention à respecter
====
L'architecture des dossiers doit être sous la forme /2016/04/02/ (2 avril 2016)
```
-├── index.php
-├── README.md
-├── 2015
-│   ├── 03
-│   │   └── 27
-│   │       └── image.png
-│   └── 04
-│       ├── 01
-│       │   └── image.png
-│       └── 02
-│           ├── image.png
-│           ├── fichier.txt
-│           └── image.png
-├── 2016
-│   ├── 05
-│   │   └── 15
-│   │       └── image.png
-│   └── 09
-│       ├── 12
-│       │   └── image.png
-│       └── 28
-│           ├── image.png
-│           ├── fichier.txt
-│           └── image.png
```
