#include <stdlib.h>
#include <stdio.h>
#include "functions.h"
#include <stdbool.h>

int initialisation(char **tab, coord *tableau) {
    //printf("%d",sizeof(tab));
    for(int i = 0; i < sizeof(tab);i++){
        for(int j = 0; j < sizeof(tab);j++){
            tableau[j+i*sizeof(tab)].x = j;
            tableau[j+i*sizeof(tab)].y = i;
            tableau[j+i*sizeof(tab)].value = tab[i][j];
            tableau[j+i*sizeof(tab)].used = false;
            //printf("\nX : %d |",tableau[j+i*sizeof(tab)].x);
            //printf(" Y : %d |",tableau[j+i*sizeof(tab)].y);
            //printf(" Value : %c.",tableau[j+i*sizeof(tab)].value);
        }
    }
}

void display_coord(coord pos){
    printf("\n x: %d | y: %d | value: %c | used: %d",pos.x,pos.y,pos.value,pos.used);
}

void display_coordTab(coord *tableau,int taille){
    for(int i=0;i<taille;i++){
        printf("\n x: %d | y: %d | value: %c | used: %d",tableau[i].x,tableau[i].y,tableau[i].value,tableau[i].used);
    }
}

coord *couleur (coord *tableau, char *tab, int **nb_color) {
    static coord tab_couleur[5];
    int idx = 0;
    for (int i = 0; i < sizeof(tableau)*sizeof(tableau); i++) {
        // ON CHERCHE LES COORDONNEES DES POINTS DE DEPART DE CHAQUE COULEUR ET ON LES MET DANS UN TABLEAU
        if (tableau[i].value == 'r' || tableau[i].value == 'g' || tableau[i].value == 'b'|| tableau[i].value == 'y' || tableau[i].value == 'p'){
            tab_couleur[idx] = tableau[i];
            idx ++;
        }
    }
    //debug:affichage
//    for(int a=0;a<idx;a++){
//        display_coord(tab_couleur[a]);
//    }
    *nb_color = idx;
    return tab_couleur;
}

int nb_cases(coord *tableau) {
    int nb = 0;
    for (int i = 0; i < sizeof(tableau)*sizeof(tableau); i++) {
        if (tableau[i].value != '0') {
            nb++;
        }
    }
    return nb;
}


int solver_recursif(coord *tableau, coord *couleur, int nb_color, int x, int y, int complete_case, int complete_color, bool fin_color) {
    coord current;
    if (complete_case == nb_cases(tableau)) {
        printf("\nca marche !!");
        return EXIT_SUCCESS;
    }

    if (complete_case == 0 || (fin_color == true && complete_color < nb_color)) {
        current = couleur[complete_color];
        display_coord(current);
        current.used = true;
    }
    else if(fin_color==true){
        printf("\npas le bon chemin");
        return 0;
    }
    else {
        current = tableau[x + y * (int)sizeof(tableau)];
        current.used=true;
    }
    display_coord(current);

    solver_recursif(tableau, couleur, nb_color, x, y, complete_case+1, complete_color+1, true); // FIN

     //HAUT
    if (current.y > 0 && tableau[x + (y-1)*(int)sizeof(tableau)].value != '0' && tableau[x + (y-1)*(int)sizeof(tableau)].used == false) { //haut, pas 0, pas used
        solver_recursif(tableau,couleur, nb_color, x, y-1, complete_case+1, complete_color, false);
        //printf("\nhaut");
    }
    // DROITE
    if ((current.x < sizeof(tableau) - 1) && tableau[(x+1) + y*(int)sizeof(tableau)].value != '0' && tableau[x + (x+1)*(int)sizeof(tableau)].used == false) { //droite, pas 0, pas used
        solver_recursif(tableau,couleur, nb_color, x+1, y, complete_case+1, complete_color, false);
        //printf("\ndroite");
    }
    // BAS
    if ((current.y < sizeof(tableau) - 1) && tableau[x + (y+1)*(int)sizeof(tableau)].value != '0' && tableau[x + (y+1)*(int)sizeof(tableau)].used == false) { //haut, pas 0, pas used
        solver_recursif(tableau,couleur, nb_color, x, y+1, complete_case+1, complete_color, false);
        //printf("\nbas");
    }
    // GAUCHE
    if ((current.x > 0) && tableau[(x-1) + y*(int)sizeof(tableau)].value != '0' && tableau[x + (x-1)*(int)sizeof(tableau)].used == false) { //haut, pas 0, pas used
        solver_recursif(tableau,couleur, nb_color, x-1, y, complete_case+1, complete_color, false);
        //printf("\ngauche");
    }


}

int solver(coord *tableau, coord *couleur, int nb_color){
    solver_recursif(tableau,couleur,nb_color,0,0,0,0,false);
}