#include <stdlib.h>
#include <stdio.h>
#include <stdbool.h>
#include "functions.h"

char *tab[] = {"00111765","00102345","g1102222","00001200","000r1220","00000110","000001b0","00000000"};
//
coord tableau[sizeof(*tab) * sizeof(*tab)];

int main() {

    initialisation(tab,tableau);
    printf("\nvalue: %c",tableau[12].value);
    int taille;
    coord *couleur_tab;
    couleur_tab = couleur(tableau,tab,&taille);
   //printf("\ntaille : %d",taille);
    //printf("\nde couleur: %d", nb_cases(tableau));
    return EXIT_SUCCESS;
}