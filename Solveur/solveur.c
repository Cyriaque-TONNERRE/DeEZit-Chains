#include <stdlib.h>
#include <stdio.h>
#include <stdbool.h>
#include "functions.h"

char *tab1[] = {"00111765","00102345","g1102222","00001200","000r1220","00000110","000001b0","00000000"};
char *tab2[] = {"r1000000","1100000","00000000","00000000","00000000","00000000","00000000","00000000"};
//
coord tableau[sizeof(*tab2) * sizeof(*tab2)];

int main() {
    int *arr;
    initialisation(tab2,tableau);
    coord current=tableau[1];
    //printf("\nvalue: %d",current.x);
    int nb_color;
    coord *couleur_tab;

    couleur_tab = couleur(tableau,*tab2,&nb_color);
    //printf("\nnb de couleur : %d",nb_color);
    //printf("\nnb de case: %d", nb_cases(tableau));

   //display_coordTab(couleur_tab,nb_color);

    solver(tableau,couleur_tab,nb_color);

    return EXIT_SUCCESS;
}