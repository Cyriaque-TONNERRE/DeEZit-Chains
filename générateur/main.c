#include <stdio.h>
#include <stdlib.h>
#include <stdbool.h>


bool not_wall(int x, int sens, int taille) {
    int valid = true;
    if (sens == 0 && x < taille) {
        return false;
        valid = false;
    }
    if (sens == 1 && x%taille == (taille - 1)) {
        return false;
        valid = false;
    }
    if (sens == 2 && x%taille == 0) {
        return false;
        valid = false;
    }
    if (sens == 3 && x > 0) {
        return false;
        valid = false;
    }
    return valid;
}

// Function: main avec 1 argument char*
int main(int argc, char* argv[]) {
    // Si le nombre d'arguments est différent de 1
    if (argc != 2) {
        // Affiche un message d'erreur
        printf("Aled\n");
    }
    // Sinon
    else {
        int position = 0;
        /* à faire
         - 6 couleurs
         - augmenter le chiffre
         - regler taille chenille
         - regler passage sur soit-même
        */
        // Initialise l'aléatoire avec l'argument
        srand(*argv[1]);
        // Taille de la grille
        int taille = rand() % 5 + 5;
        // Création de la grille
        char* grille = malloc(taille * taille * sizeof(char));
        // Choisir un point de départ
        int x = rand() % (taille * taille);
        position = x;
        // Choisir une direction de départ
        int sens = rand() % 4;
        // Initialise la grille
        for (int i = 0; i < taille * taille; i++) {
            grille[i] = '0';
        }
        // Initialise le point de départ
        grille[x] = 'r';
        // Initialise la direction de départ
        switch (sens) {
            // Front
            case 0:
                if (not_wall(x, sens, taille)) {
                    grille[x - taille ] = '1';
                    position = x - taille;
                }
                break;

            // Droite
            case 1:
                if (not_wall(x, sens, taille)) {
                    grille[x + 1] = '1';
                    position = x + 1;
                }
                break;
            // Gauche
            case 2:
                if (not_wall(x, sens, taille)) {
                    grille[x - 1] = '1';
                    position = x - 1;
                }
                break;
            // Back
            case 3:
                if (not_wall(x, sens, taille)) {
                    grille[x + taille] = '1';
                    position = x + taille;
                }
                break;
            // Par défaut
            default:
                grille[x + 1] = '1';
                position = x + 1;
                break;
        }
        for (int i = 0; i < rand()%taille + taille ; i++) {
            // Boucle sur la grille
            int sens2 = rand() % 3;
            if (sens == 0) {
                switch (sens2) {
                    case 0:
                        if (not_wall(position, 2, taille)) {
                            grille[position - 1] = '1';
                            position = position - 1;
                            sens = 2;
                        }
                        break;
                    case 1:
                        if (not_wall(position, 0, taille)) {
                            grille[position - taille] = '1';
                            position = position - taille;
                            sens = 0;
                        }
                        break;
                    case 2:
                        if (not_wall(position, 1, taille)) {
                            grille[position + 1] = '1';
                            position = position + 1;
                            sens = 1;
                        }
                        break;
                }
            } else if (sens == 1) {
                switch (sens2) {
                    case 0:
                        if (not_wall(position, 0,taille)) {
                            grille[position - taille] = '1';
                            position = position - taille;
                            sens = 0;
                        }
                        break;
                    case 1:
                        if (not_wall(position, 1, taille)) {
                            grille[position + 1] = '1';
                            position = position + 1;
                            sens = 1;
                        }
                        break;
                    case 2:
                        if (not_wall(position, 3, taille)) {
                            grille[position + taille] = '1';
                            position = position + taille;
                            sens = 3;
                        }
                        break;
                }
            } else if (sens == 2) {
                switch (sens2) {
                    case 0:
                        if (not_wall(position, 0, taille)) {
                            grille[position - taille] = '1';
                            position = position - taille;
                            sens = 0;
                        }
                        break;
                    case 1:
                        if (not_wall(position, 2, taille)) {
                            grille[position - 1] = '1';
                            position = position - 1;
                            sens = 2;
                        }
                        break;
                    case 2:
                        if (not_wall(position, 3, taille)) {
                            grille[position + taille] = '1';
                            position = position + taille;
                            sens = 3;
                        }
                        break;
                }
            } else if (sens == 3) {
                switch (sens2) {
                    case 0:
                        if (not_wall(position, 1, taille)) {
                            grille[position + 1] = '1';
                            position = position + 1;
                            sens = 1;
                        }
                        break;
                    case 1:
                        if (not_wall(position, 3, taille)) {
                            grille[position + taille] = '1';
                            position = position + taille;
                            sens = 3;
                        }
                        break;
                    case 2:
                        if (not_wall(position, 2, taille)) {
                            grille[position - 1] = '1';
                            position = position - 1;
                            sens = 2;
                        }
                        break;
                }
            }
        }
        // Affiche la grille
        for (int i = 0; i < taille; i++) {
            for (int j = 0; j < taille; j++) {
                printf("%c", grille[i * taille + j]);
            }
            printf("\n");
        }
    }
}