# SAE 204

## 6-Gestion des projets tuteurés

Objectif :

L’organisation des projets tuteurés dans le département Réseaux et Télécoms est assez laborieuse (!).
L’enseignant responsable demande à ses collègues des sujets, les fusionne puis les propose aux étudiants.
Les étudiants remplissent les fiches de vœux. Le responsable des projets regroupe ses fiches de vœux dans
un tableur puis le logiciel d’attribution distribue les sujets et propose les combinaisons.
L’idée est de réaliser un site web sur lequel les enseignants déposeront leurs sujets qui seront validés par
l’administrateur. Ensuite les étudiants auront quelques jours pour faire leurs vœux. L’algorithme
d’optimisation actuellement utilisé sera repris [attribution de projets](https://jb.vioix.fr/attribution-de-projets/). A l’issue de ce
processus, l’administrateur réglera les cas équivalents.

---

### SQL/BBD

- Premiere page :
    - BBD -> Admin/Profs/Etudiants
    - BBD -> Sujet      


### Domaine de compétences : Informatique


3 types de profils :
- Admin :
    - définit les dates limites
       - dépôt de sujets pour les enseignants
       - voeux des étudiants
    - approuve les sujets proposés par les enseignants et les publie sur le site
    - lance l'attribution des sujets aux étudiants et publie les résultats
- Profs : proposent des sujets avec
   - titre
   - description
   - mots-clés (domaine de compétences)
   - niveau de difficulté
- Etudiants 
  - Se connecter avec leurs identifiants sur le site  
  - Choisir son binôme  
  - Faire une demande de sujet au binome, qui devra être approuvée par le binôme  
  - Choisir 5 sujets dans la liste et les classer par ordre de preference  
  - Attendre la validation des 2/3 etudiants sur l'attribution des sujets et de l'odre.  

