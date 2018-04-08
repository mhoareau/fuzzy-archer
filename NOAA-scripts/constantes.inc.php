<?php
# Fichier de configuration
# OBLIGATOIRE Entrez ici le nom de votre site
define ("NOM_SITE","");
# vous pouvez changer l'image de votre logo
define ("LOGO","");
# choisissez la langage que vous souhatez utiliser
# define ("LANGUE","IT");
# define ("LANGUE","ES");
 define ("LANGUE","FR");

# décommentez le style que vous souhaitez appliquer au rendu de ce script
#define ('THEME','<script type="text/javascript" src="./highchartsNOAA/themes/dark-blue.js"></script>');
#define ('THEME','<script type="text/javascript" src="./highchartsNOAA/themes/dark-green.js"></script>');
define ('THEME','<script type="text/javascript" src="./highchartsNOAA/themes/gray.js"></script>');
#define ('THEME','<script type="text/javascript" src="./highchartsNOAA/themes/grid.js"></script>');
#define ('THEME','<script type="text/javascript" src="./highchartsNOAA/themes/skies.js"></script>');

# OBLIGATOIRE Entrez ici le premier jour des enregistrements
define ("PREMIER_JOUR", "1");
define ("PREMIER_MOIS", "1");
define ("PREMIERE_ANNEE", "2015");


# OBLIGATOIRE Entrez ici la version de GW que vous utilisez ( V2 ou V3 ) respectez la casse
# define ('VER','V3'); 
# n'est plus nécessaire, détection par le programme de cette information



# OBLIGATOIRE Entrez ici le type de fichiers NOAA utilis&#65533;s
#   GW pour GraphWeather
#   WL pour WeatherLink
#   AUTRE pour un autre logiciel source
#   Si la source n'est pas GW, vous devez nommer vos fichiers NOAA mois-AAAA.TXT et AAAA.TXT
#     où mois est le nom du mois en clair (Janvier, Février, Mars, etc) avec majuscule et accent
#     où; AAAA est l'année en clair (2008, 2009, etc)
#     TXT doit &#65533;tre en majuscule
define ("TYPE_NOAA", "GW"); 

# OBLIGATOIRE Entrez ici si vous possédez une sonde solaire (TRUE ou FALSE)
define ("SONDE_SOL", "FALSE");
# define ("SONDE_SOL", "FALSE");

# OBLIGATOIRE Entrez ici le chemin du répertoire contenant les statistiques GW

define ("REP_GW", '../'.$_GET['station_id'].'/Statistics/');


# OBLIGATOIRE  si la source n'est pas GW Entrez ici le chemin du répertoire contenant les fichiers NOAA
# define ("REP_NOAA", "../NOAA/");

# OBLIGATOIRE Entrez ici si vous possédez un fichier contenant les Normales (TRUE ou FALSE)
#   Ce fichier doit s'appeller Normales.TXT et contenir les valeurs sous forme NOAA
#   Ces valeurs Normales et records sont disponibles sur le site de METEO FRANCE
#   COMMENT contient un commentaire décrivant la source des Normales.
define ("FICHE_NORMALES", "FALSE");
 # define ("FICHE_NORMALES", "TRUE");
 
 # option spéciale mistral
define ("MISTRAL", "FALSE");
 # define ("MISTRAL_V", 50);Non programmé
 # define ("MISTRAL_D", "N");Non programmé
  # define ("MISTRAL", "TRUE");
?>