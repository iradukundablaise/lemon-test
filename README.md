# TMDb Movie Search App - Lemon Interactive

## Prérequis

- Docker
- Docker Compose

---

## Installation et exécution

1. **Cloner le projet :**
   ```bash
   git clone https://github.com/iradukundablaise/lemon-test.git
   cd lemon-test
   ```
2. **Lancer l'application web:**
    ```bash
   docker compose up
    ```
3. **Tester l'application**

   Ouvrez l'adresse suivant dans votre navigateur : [http://localhost:8000](http://localhost:8000)

## Choix techniques
1. Architecture MVC : J’ai choisi MVC pour bien séparer les responsabilités dans le code. Ça rend l’application plus claire et plus facile à maintenir.
2. Composer pour les dépendances : J’utilise Composer pour gérer les packages externes, ça m’évite de réinventer la roue et me fait gagner du temps.
3. Twig pour les templates : J’ai opté pour Twig parce que c’est simple, efficace et que j’ai déjà l’habitude avec Symfony.

## Améliorations et optimisations

1. **Page dédiée par film**  
   Exemple : `http://localhost:8000/movies/{movieID}`  
   À partir de l’identifiant d’un film, afficher la fiche complète avec toutes les informations détaillées.


2. **Mise en cache**  
   Ajouter un système de cache pour conserver les résultats déjà recherchés et éviter des appels répétés à l’API TMDb.  
   Cela rend l’application plus rapide et améliore l’expérience utilisateur.  


