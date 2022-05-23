
#ifndef SETTING_PHP_FUNCTIONS_H
#define SETTING_PHP_FUNCTIONS_H

#endif //SETTING_PHP_FUNCTIONS_H
#include <stdbool.h>
typedef struct coord_{
    int x;
    int y;
    char value;
    bool used;
}coord;

int initialisation(char **tab, coord *tableau);

coord *couleur(coord *tableau,char *tab,int **nb_color);

int nb_cases(coord *tableau);

int solver_recursif(coord *tableau,coord *couleur,int nb_color,int x,int y,int complete_case,int complete_color,bool fin_color,coord previous);

int solver(coord *tableau, coord *couleur, int nb_color);

void display_coord(coord pos);

void display_coordTab(coord *tableau, int taille);
