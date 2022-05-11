#include <stdio.h>
#include <stdlib.h>
#include <stdbool.h>


bool not_wall(int x, int sens, int taille) {
    //x -> position ds le tableau
    //sens -> direction (ON, 1D, 2G, 3S)
    //taille -> taille du tableau
    int valid = true;
    if (sens == 0 && x < taille) {
        valid = false;
        return false;
    }
    if (sens == 1 && x%taille == (taille - 1)) {
        valid = false;
        return false;
    }
    if (sens == 2 && x%taille == 0) {
        valid = false;
        return false;
    }
    if (sens == 3 && x > 0) {
        valid = false;
        return false;
    }
    return valid;
}

bool not_already_used(int x,int sens, int taille, char grille[]){
    /*
    La fonction renvoie false si le chemin repasse sur lui même lors de la génération,
    True sinon.
    int x -> Position dans le tableau
    int sens -> Direction (0 : Up, 1 : Right, 2 : Left, 3 : Down)
    int taille -> Taille du tableau
    char grille[] -> Tableau de char
    */
    switch(sens){
        case 0: //Up
            if(grille[x -  taille] != '0'){
               return false;
            }
            break;
        case 1: //Right
            if(grille[x + 1] != '0'){
                return false;
            }
            break;
        case 2: //Left
            if(grille[x - 1] != '0'){
                return false;
            }
            break;
        case 3: //Down
            if(grille[x + taille] != '0'){
                return false;
            }
            break;
    }
    return true;


}

unsigned hash_pjw (const void *str)
{
    const char *s = str;
    unsigned int g, h = 1234567u;
    while (*s != 0) {
        h = (h << 4) + *s++;
        if ((g = h & (unsigned int) 0xf0000000) != 0)
            h = (h ^ (g >> 24)) ^ g;
    }
    return h;
}

// Function: main avec 1 argument char*
int main(int argc,const char* argv[]) {
    // Si le nombre d'arguments est différent de 1
    if (argc != 3) {
        // Affiche un message d'erreur
        return EXIT_FAILURE;
    }
    // Sinon
    else {
        int position = 0;
        int nbcouleur = atoi(argv[2]);
        char colors[5] = {'r','g','b','y','p'};
        int chienDeGarde = 0;



        /* à faire
         - 6 couleurs
         - augmenter le chiffre
         - regler taille chenille
         - regler passage sur soit-même
        */
        // Initialise l'aléatoire avec l'argument
        srand(hash_pjw(argv[1]));
        // Taille de la grille
        int taille = rand() % 5 + 5;
        // Création de la grille
        char* grille = malloc(taille * taille * sizeof(char));
        //verifie si la grille est crée
        if(grille == NULL){
            return EXIT_FAILURE;
        }
        // Initialise la grille
        for (int i = 0; i < taille * taille; i++) {
            grille[i] = '0';
        }
        for(int couleur_trait = 0; couleur_trait < nbcouleur; couleur_trait++){

            // Choisir un point de départ
            anotherTime:;
            int x = rand() % (taille * taille);
            //on verifie que la case n'est pas déja occupée
            if (grille[x] != '0') {
                if(chienDeGarde >= 5){
                    chienDeGarde = 0;
                    break;
                }
                goto anotherTime;
                chienDeGarde++;

            }
            chienDeGarde = 0;
            position = x;
            // Choisir une direction de départ
            int sens = rand() % 4;
            // Initialise le point de départ
            grille[x] = colors[couleur_trait];
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
            int lvl = 1;
            for (int i = 0; i < rand()%(taille*(taille-1)) + taille ; i++) {
                bool mouvement = false;
                // Boucle sur la grille


                if(rand() % 6 == 3){
                    lvl++;
                }
                int sens2 = rand() % 3;
                if (sens == 0) {
                    switch (sens2) {
                        case 0:
                            if ((not_wall(position, 2, taille)) && (not_already_used(position,2,taille,grille))) {
                                grille[position - 1] = lvl + '0';
                                position = position - 1;
                                sens = 2;
                                mouvement = true;
                            }
                            break;
                        case 1:
                            if ((not_wall(position, 0, taille)) && (not_already_used(position,0,taille,grille))) {
                                grille[position - taille] = lvl + '0';
                                position = position - taille;
                                sens = 0;
                                mouvement = true;
                            }
                            break;
                        case 2:
                            if ((not_wall(position, 1, taille)) && (not_already_used(position,1,taille,grille))) {
                                grille[position + 1] = lvl + '0';
                                position = position + 1;
                                sens = 1;
                                mouvement = true;
                            }
                            break;
                    }
                } else if (sens == 1) {
                    switch (sens2) {
                        case 0:
                            if ((not_wall(position, 0, taille)) && (not_already_used(position,0,taille,grille))) {
                                grille[position - taille] = lvl + '0';
                                position = position - taille;
                                sens = 0;
                                mouvement = true;
                            }
                            break;
                        case 1:
                            if ((not_wall(position, 1, taille)) && (not_already_used(position,1,taille,grille))) {
                                grille[position + 1] = lvl + '0';
                                position = position + 1;
                                sens = 1;
                                mouvement = true;
                            }
                            break;
                        case 2:
                            if ((not_wall(position, 3, taille)) && (not_already_used(position,3,taille,grille))) {
                                grille[position + taille] = lvl + '0';
                                position = position + taille;
                                sens = 3;
                                mouvement = true;
                            }
                            break;
                    }
                } else if (sens == 2) {
                    switch (sens2) {
                        case 0:
                            if ((not_wall(position, 0, taille)) && (not_already_used(position,0,taille,grille))) {
                                grille[position - taille] = lvl + '0';
                                position = position - taille;
                                sens = 0;
                                mouvement = true;
                            }
                            break;
                        case 1:
                            if ((not_wall(position, 2, taille)) && (not_already_used(position,2,taille,grille))) {
                                grille[position - 1] = lvl + '0';
                                position = position - 1;
                                sens = 2;
                                mouvement = true;
                            }
                            break;
                        case 2:
                            if ((not_wall(position, 3, taille)) && (not_already_used(position,3,taille,grille))) {
                                grille[position + taille] = lvl + '0';
                                position = position + taille;
                                sens = 3;
                                mouvement = true;
                            }
                            break;
                    }
                } else if (sens == 3) {
                    switch (sens2) {
                        case 0:
                            if ((not_wall(position, 1, taille)) && (not_already_used(position,1,taille,grille))) {
                                grille[position + 1] = lvl + '0';
                                position = position + 1;
                                sens = 1;
                                mouvement = true;
                            }
                            break;
                        case 1:
                            if ((not_wall(position, 3, taille)) && (not_already_used(position,3,taille,grille))) {
                                grille[position + taille] = lvl + '0';
                                position = position + taille;
                                sens = 3;
                                mouvement = true;
                            }
                            break;
                        case 2:
                            if ((not_wall(position, 2, taille)) && (not_already_used(position,2,taille,grille))) {
                                grille[position - 1] = lvl + '0';
                                position = position - 1;
                                sens = 2;
                                mouvement = true;
                            }
                            break;
                    }
                }
                if (mouvement == false){
                    i--;
                    chienDeGarde++;
                    if(chienDeGarde == 5){
                        chienDeGarde = 0;
                        break;
                    }
                }
                else{
                    chienDeGarde = 0;
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
    return EXIT_SUCCESS;
}
