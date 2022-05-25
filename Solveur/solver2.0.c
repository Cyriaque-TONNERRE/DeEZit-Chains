#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <stdbool.h>
#include <ctype.h>

typedef struct coord_{
    int x;
    int y;
    char value;
    bool is_visited;
} coord;

// DEFINITION VARIABLE
    coord r;
    bool r_exist = false;
    coord g;
    bool g_exist = false;
    coord b;
    bool b_exist = false;
    coord y;
    bool y_exist = false;
    coord p;
    bool p_exist = false;
//

// 0 North 1 East 2 West 3 South
// 000g1 00001 00022 00033 00044

int solveur(coord *grille, coord color, int size/*, coord avant*/);
void display_coord(coord pos);


int main(int argc,char *argv[]) {
    if (argc > 11) {
        return 1;
    }
    else {
        char *l1,*l2,*l3,*l4,*l5,*l6,*l7,*l8,*l9,*l10;
        coord *tableauCoord;
        if (argc == 2) {l1 = argv[1];};
        if (argc == 3) {l1 = argv[1]; l2 = argv[2];};
        if (argc == 4) {l1 = argv[1]; l2 = argv[2]; l3 = argv[3];};
        if (argc == 5) {l1 = argv[1]; l2 = argv[2]; l3 = argv[3]; l4 = argv[4];};
        if (argc == 6) {l1 = argv[1]; l2 = argv[2]; l3 = argv[3]; l4 = argv[4]; l5 = argv[5];};
        if (argc == 7) {l1 = argv[1]; l2 = argv[2]; l3 = argv[3]; l4 = argv[4]; l5 = argv[5]; l6 = argv[6];};
        if (argc == 8) {l1 = argv[1]; l2 = argv[2]; l3 = argv[3]; l4 = argv[4]; l5 = argv[5]; l6 = argv[6]; l7 = argv[7];};
        if (argc == 9) {l1 = argv[1]; l2 = argv[2]; l3 = argv[3]; l4 = argv[4]; l5 = argv[5]; l6 = argv[6]; l7 = argv[7]; l8 = argv[8];};
        if (argc == 10) {l1 = argv[1]; l2 = argv[2]; l3 = argv[3]; l4 = argv[4]; l5 = argv[5]; l6 = argv[6]; l7 = argv[7]; l8 = argv[8]; l9 = argv[9];};
        if (argc == 11) {l1 = argv[1]; l2 = argv[2]; l3 = argv[3]; l4 = argv[4]; l5 = argv[5]; l6 = argv[6]; l7 = argv[7]; l8 = argv[8]; l9 = argv[9]; l10 = argv[10];};
        tableauCoord = malloc(sizeof(coord) * strlen(l1) * strlen(l2));
        //verification de l'allocation
        if (tableauCoord == NULL) {
            return 1;
        }
        for (int j = 0; j < strlen(l1); j++) {
            for (int i = 0; i < strlen(l2); i++) {
                char inputValue;
                switch (j) {
                    case 0:
                        inputValue = l1[i];
                        break;
                    case 1:
                        inputValue = l2[i];
                        break;
                    case 2:
                        inputValue = l3[i];
                        break;
                    case 3:
                        inputValue = l4[i];
                        break;
                    case 4:
                        inputValue = l5[i];
                        break;
                    case 5:
                        inputValue = l6[i];
                        break;
                    case 6:
                        inputValue = l7[i];
                        break;
                    case 7:
                        inputValue = l8[i];
                        break;
                    case 8:
                        inputValue = l9[i];
                        break;
                    case 9:
                        inputValue = l10[i];
                        break;
                }
                tableauCoord[i * strlen(l2) + j].x = i;
                tableauCoord[i * strlen(l2) + j].y = j;
                tableauCoord[i * strlen(l2) + j].value = inputValue;
                if (!isdigit(inputValue)) {
                    switch (inputValue) {
                        case 'r':
                            r.x = tableauCoord[i * strlen(l1) + j].x;
                            r.y = tableauCoord[i * strlen(l1) + j].y;
                            r.value = tableauCoord[i * strlen(l1) + j].value;
                            r.is_visited = false;
                            r_exist = true;
                            break;
                        case 'g':
                            g.x = tableauCoord[i * strlen(l1) + j].x;
                            g.y = tableauCoord[i * strlen(l1) + j].y;
                            g.value = tableauCoord[i * strlen(l1) + j].value;
                            g.is_visited = false;
                            g_exist = true;
                            break;
                        case 'b':
                            b.x = tableauCoord[i * strlen(l1) + j].x;
                            b.y = tableauCoord[i * strlen(l1) + j].y;
                            b.value = tableauCoord[i * strlen(l1) + j].value;
                            b.is_visited = false;
                            b_exist = true;
                            break;
                        case 'y':
                            y.x = tableauCoord[i * strlen(l1) + j].x;
                            y.y = tableauCoord[i * strlen(l1) + j].y;
                            y.value = tableauCoord[i * strlen(l1) + j].value;
                            y.is_visited = false;
                            y_exist = true;
                            break;
                        case 'p':
                            p.x = tableauCoord[i * strlen(l1) + j].x;
                            p.y = tableauCoord[i * strlen(l1) + j].y;
                            p.value = tableauCoord[i * strlen(l1) + j].value;
                            p.is_visited = false;
                            p_exist = true;
                            break;
                        default :
                            return EXIT_FAILURE;
                            break;
                    }
                }
                tableauCoord[i * strlen(l1) + j].is_visited = false;
            }
        }
        if (!r_exist) {
            return EXIT_FAILURE;
        } else {
            solveur(tableauCoord, r, strlen(l1));
        }
    }
}

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
    if (sens == 3 && x > taille*taille - 1) {
        valid = false;
        return false;
    }
    return valid;
}

int solveur(coord *grille, coord prev, int size/*, coord avant*/) {
    coord actual;
    actual.x = prev.x;
    actual.y = prev.y;
    actual.value = prev.value;
    actual.is_visited = true;

    if (grille[actual.y * size + actual.x - size].value >= actual.value && !grille[actual.y * size + actual.x - size].is_visited && not_wall(actual.y * size + actual.x - size, 0, size)) {
        grille[actual.y * size + actual.x - size].is_visited = true;
        return solveur(grille, grille[actual.y * size + actual.x - size], size);
    } else if (grille[actual.y * size + actual.x + 1].value >= actual.value && !grille[actual.y * size + actual.x + 1].is_visited && not_wall(actual.y * size + actual.x + 1, 1, size)) {
        grille[actual.y * size + actual.x + 1].is_visited = true;
        return solveur(grille, grille[actual.y * size + actual.x + 1], size);
    } else if (grille[actual.y * size + actual.x - 1].value >= actual.value && !grille[actual.y * size + actual.x - 1].is_visited && not_wall(actual.y * size + actual.x - 1, 2, size)) {
        grille[actual.y * size + actual.x - 1].is_visited = true;
        return solveur(grille, grille[actual.y * size + actual.x - 1], size);
    } else if (grille[actual.y * size + actual.x + size ].value >= actual.value && !grille[actual.y * size + actual.x + size].is_visited && not_wall(actual.y * size + actual.x + size, 3, size)) {
        grille[actual.y * size + actual.x + size].is_visited = true;
        return solveur(grille, grille[actual.y * size + actual.x + size], size);
    } else {
        if (g_exist && !g.is_visited) {
            return solveur(grille, g, size);
        } else if (b_exist && !b.is_visited) {
            return solveur(grille, b, size);
        } else if (y_exist && !y.is_visited) {
            return solveur(grille, y, size);
        } else if (p_exist && !p.is_visited) {
            return solveur(grille, p, size);
        } else if (r_exist && !r.is_visited) {
            return solveur(grille, r, size);
        } else {
            return EXIT_SUCCESS;
        }
    }
}


void display_coord(coord pos){
    printf("\n x: %d | y: %d | value: %c | used: %d",pos.x,pos.y,pos.value,pos.is_visited);
}

