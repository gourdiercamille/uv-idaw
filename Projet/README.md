Pour utiliser ce code:

Regardez le fichier config dans le backend et entrez vos informations. Utilisez le fichier db_init.php dans backend pour copier notre base de données. Ajoutez votre lien vers l'interieur de votre dossier backend dans le dossier config du frontend.

Ensuite ouvrez simplement le dossier frontend du projet dans votre navigateur et connectez vous avec le login "fabluc".

En ce qui concerne la partie théorique:

La quantité de kcal par aliment est calculée par la formule suivante: kcal=9quantité_glucide + 4(quantité_proteine+quantitélipide)

Pour chaque utilisateur les besoins journaliers sont calculés via la formule suivante: Hommes=[(10 * POIDS) + (6.25 * TAILLE) - (5 * AGE_MOYENNE_DE_LA_TRANCHE8AGE) + 5] Femmes=[(10 * POIDS) + (6.25 * TAILLE) - (5 * AGE_MOYENNE_DE_LA_TRANCHE8AGE) - 161] Que l'utilisateur soit un homme ou une femme, le tout est multiplié par :

1.3 si l'intensité de la pratique sportive est faible
1.6 si l'intensité de la pratique sportive est modérée
1.75 si l'intensité de la pratique sportive est élevée (formule de Mittflin St Jeor adaptée)