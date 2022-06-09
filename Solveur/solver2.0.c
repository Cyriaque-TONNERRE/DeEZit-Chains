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

typedef struct point_{
    bool top;
    bool right;
    bool left;
    bool bottom;
} point;

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

coord *tableauCoord;

point *tableauPoint;

bool is_solved = false;


// 0 North 1 East 2 West 3 South
// 000g1 00001 00022 00033 00044

int solveur(coord *grille, coord actual, int size);
void prechargement(int taille);


int main(int argc,char *argv[]) {
    if (argc > 11 || argc < 3) {
        return EXIT_FAILURE;
    }
    else {
        char *l1,*l2,*l3,*l4,*l5,*l6,*l7,*l8,*l9,*l10;
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
        tableauCoord = calloc((argc - 1) * (argc - 1), sizeof(coord));
        tableauPoint = calloc((argc - 1) * (argc - 1), sizeof(point));
        //verification de l'allocation
        if (tableauCoord == NULL || tableauPoint == NULL) {
            return EXIT_FAILURE;
        }
        for (int j = 0; j < (argc - 1); j++) {
            for (int i = 0; i < (argc - 1); i++) {
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
                    default:
                        return EXIT_FAILURE;
                }
                tableauCoord[j * (argc - 1) + i].x = i;
                tableauCoord[j * (argc - 1) + i].y = j;
                tableauCoord[j * (argc - 1) + i].value = inputValue;
                if (!isdigit(inputValue)) {
                    switch (inputValue) {
                        case 'r':
                            r.x = tableauCoord[j * (argc - 1) + i].x;
                            r.y = tableauCoord[j * (argc - 1) + i].y;
                            r.value = 'r';
                            r.is_visited = false;
                            r_exist = true;
                            break;
                        case 'g':
                            g.x = tableauCoord[j * (argc - 1) + i].x;
                            g.y = tableauCoord[j * (argc - 1) + i].y;
                            g.value = tableauCoord[j * (argc - 1) + i].value;
                            g.is_visited = false;
                            g_exist = true;
                            break;
                        case 'b':
                            b.x = tableauCoord[j * (argc - 1) + i].x;
                            b.y = tableauCoord[j * (argc - 1) + i].y;
                            b.value = tableauCoord[j * (argc - 1) + i].value;
                            b.is_visited = false;
                            b_exist = true;
                            break;
                        case 'y':
                            y.x = tableauCoord[j * (argc - 1) + i].x;
                            y.y = tableauCoord[j * (argc - 1) + i].y;
                            y.value = tableauCoord[j * (argc - 1) + i].value;
                            y.is_visited = false;
                            y_exist = true;
                            break;
                        case 'p':
                            p.x = tableauCoord[j * (argc - 1) + i].x;
                            p.y = tableauCoord[j * (argc - 1) + i].y;
                            p.value = tableauCoord[j * (argc - 1) + i].value;
                            p.is_visited = false;
                            p_exist = true;
                            break;
                        default :
                            return EXIT_FAILURE;
                    }
                }
                if (inputValue == '0'){
                    tableauCoord[j * (argc - 1) + i].is_visited = true;
                } else {
                    tableauCoord[j * (argc - 1) + i].is_visited = false;
                }
            }
        }
        if (!r_exist) {
            return EXIT_FAILURE;
        } else {
            r.is_visited = true;
            tableauCoord[r.y * (argc - 1) + r.x].is_visited = true;
            prechargement(argc - 1);
            solveur(tableauCoord, r, (argc - 1));
            return is_solved;
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
    if (sens == 3 && x > taille*taille - taille - 1) {
        valid = false;
        return false;
    }
    return valid;
}

bool verif_solution(int taille) {
    for (int i = 0; i < taille * taille - 1; i++) {
        if (tableauCoord[i].is_visited == false) {
            return false;
        }
    }
    return true;
}


void prechargement(int taille){
    for (int i = 0; i < taille*taille; ++i) {
        if (tableauCoord[i].value != '0') {
            tableauPoint[i].top = atoi(&tableauCoord[i - taille].value) >= atoi(&tableauCoord[i].value) && not_wall(i, 0, taille) && isdigit(tableauCoord[i - taille].value);
            tableauPoint[i].right = atoi(&tableauCoord[i + 1].value) >= atoi(&tableauCoord[i].value) && not_wall(i, 1, taille) && isdigit(tableauCoord[i + 1].value);
            tableauPoint[i].left = atoi(&tableauCoord[i - 1].value) >= atoi(&tableauCoord[i].value) && not_wall(i, 2, taille) && isdigit(tableauCoord[i - 1].value);
            tableauPoint[i].bottom = atoi(&tableauCoord[i + taille].value) >= atoi(&tableauCoord[i].value) && not_wall(i, 3, taille) && isdigit(tableauCoord[i + taille].value);
        } else {
            tableauPoint[i].top = false;
            tableauPoint[i].right = false;
            tableauPoint[i].left = false;
            tableauPoint[i].bottom = false;
        }
    }
}

int solveur(coord *grille, coord actual, int size) {
    actual.is_visited = true;
    if (!isdigit(actual.value)) {
        if (!grille[actual.y * size + actual.x - size].is_visited && not_wall(actual.y * size + actual.x, 0, size) && grille[actual.y * size + actual.x - size].value != '0' && isdigit(grille[actual.y * size + actual.x - size].value)) {
            grille[actual.y * size + actual.x - size].is_visited = true;
            solveur(grille, grille[actual.y * size + actual.x - size], size);
            grille[actual.y * size + actual.x - size].is_visited = false;
        }
        if (!grille[actual.y * size + actual.x + 1].is_visited && not_wall(actual.y * size + actual.x, 1, size) && grille[actual.y * size + actual.x + 1].value != '0' && isdigit(grille[actual.y * size + actual.x + 1].value)) {
            grille[actual.y * size + actual.x + 1].is_visited = true;
            solveur(grille, grille[actual.y * size + actual.x + 1], size);
            grille[actual.y * size + actual.x + 1].is_visited = false;
        }
        if (!grille[actual.y * size + actual.x - 1].is_visited && not_wall(actual.y * size + actual.x, 2, size) && grille[actual.y * size + actual.x - 1].value != '0' && isdigit(grille[actual.y * size + actual.x - 1].value)) {
            grille[actual.y * size + actual.x - 1].is_visited = true;
            solveur(grille, grille[actual.y * size + actual.x - 1], size);
            grille[actual.y * size + actual.x - 1].is_visited = false;
        }
        if (!grille[actual.y * size + actual.x + size].is_visited && not_wall(actual.y * size + actual.x, 3, size) && grille[actual.y * size + actual.x + size].value != '0' && isdigit(grille[actual.y * size + actual.x + size].value)) {
            grille[actual.y * size + actual.x + size].is_visited = true;
            solveur(grille, grille[actual.y * size + actual.x + size], size);
            grille[actual.y * size + actual.x + size].is_visited = false;
        }
    } else {
        if (!grille[actual.y * size + actual.x - size].is_visited && tableauPoint[actual.y * size + actual.x].top) {
            grille[actual.y * size + actual.x - size].is_visited = true;
            solveur(grille, grille[actual.y * size + actual.x - size], size);
            grille[actual.y * size + actual.x - size].is_visited = false;
        }
        if (!grille[actual.y * size + actual.x + 1].is_visited && tableauPoint[actual.y * size + actual.x].right) {
            grille[actual.y * size + actual.x + 1].is_visited = true;
            solveur(grille, grille[actual.y * size + actual.x + 1], size);
            grille[actual.y * size + actual.x + 1].is_visited = false;
        }
        if (!grille[actual.y * size + actual.x - 1].is_visited && tableauPoint[actual.y * size + actual.x].left) {
            grille[actual.y * size + actual.x - 1].is_visited = true;
            solveur(grille, grille[actual.y * size + actual.x - 1], size);
            grille[actual.y * size + actual.x - 1].is_visited = false;
        }
        if (!grille[actual.y * size + actual.x + size].is_visited && tableauPoint[actual.y * size + actual.x].bottom) {
            grille[actual.y * size + actual.x + size].is_visited = true;
            solveur(grille, grille[actual.y * size + actual.x + size], size);
            grille[actual.y * size + actual.x + size].is_visited = false;
        }
    }
    if (g_exist && !g.is_visited) {
        g.is_visited = true;
        grille[g.y * size + g.x].is_visited = true;
        solveur(grille, g, size);
        grille[g.y * size + g.x].is_visited = false;
        g.is_visited = false;
    }
    if (b_exist && !b.is_visited) {
        b.is_visited = true;
        grille[b.y * size + b.x].is_visited = true;
        solveur(grille, b, size);
        grille[b.y * size + b.x].is_visited = false;
        b.is_visited = false;
    }
    if (y_exist && !y.is_visited) {
        y.is_visited = true;
        grille[y.y * size + y.x].is_visited = true;
        solveur(grille, y, size);
        grille[y.y * size + y.x].is_visited = false;
        y.is_visited = false;
    }
    if (p_exist && !p.is_visited) {
        p.is_visited = true;
        grille[p.y * size + p.x].is_visited = true;
        solveur(grille, p, size);
        grille[p.y * size + p.x].is_visited = false;
        p.is_visited = false;
    }
    if(verif_solution(size)){
        is_solved = true;
        return EXIT_SUCCESS;
    }
}