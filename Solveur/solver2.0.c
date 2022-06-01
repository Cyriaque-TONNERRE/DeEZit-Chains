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

int solveur(coord *grille, coord actual, int size, coord prev);


int main(int argc,char *argv[]) {
    if (argc > 11) {
        return EXIT_FAILURE;
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
        tableauCoord = calloc((argc - 1) * (argc - 1), sizeof(coord));
        //verification de l'allocation
        if (tableauCoord == NULL) {
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
                        break;
                }
                tableauCoord[i * (argc - 1) + j].x = i;
                tableauCoord[i * (argc - 1) + j].y = j;
                tableauCoord[i * (argc - 1) + j].value = inputValue;
                if (inputValue == '0'){
                    tableauCoord[i * (argc - 1) + j].is_visited = true;
                }
                if (!isdigit(inputValue)) {
                    switch (inputValue) {
                        case 'r':
                            r.x = tableauCoord[i * (argc - 1) + j].x;
                            r.y = tableauCoord[i * (argc - 1) + j].y;
                            r.value = 'r';
                            r.is_visited = false;
                            r_exist = true;
                            break;
                        case 'g':
                            g.x = tableauCoord[i * (argc - 1) + j].x;
                            g.y = tableauCoord[i * (argc - 1) + j].y;
                            g.value = tableauCoord[i * (argc - 1) + j].value;
                            g.is_visited = false;
                            g_exist = true;
                            break;
                        case 'b':
                            b.x = tableauCoord[i * (argc - 1) + j].x;
                            b.y = tableauCoord[i * (argc - 1) + j].y;
                            b.value = tableauCoord[i * (argc - 1) + j].value;
                            b.is_visited = false;
                            b_exist = true;
                            break;
                        case 'y':
                            y.x = tableauCoord[i * (argc - 1) + j].x;
                            y.y = tableauCoord[i * (argc - 1) + j].y;
                            y.value = tableauCoord[i * (argc - 1) + j].value;
                            y.is_visited = false;
                            y_exist = true;
                            break;
                        case 'p':
                            p.x = tableauCoord[i * (argc - 1) + j].x;
                            p.y = tableauCoord[i * (argc - 1) + j].y;
                            p.value = tableauCoord[i * (argc - 1) + j].value;
                            p.is_visited = false;
                            p_exist = true;
                            break;
                        default :
                            return EXIT_FAILURE;
                            break;
                    }
                }
                tableauCoord[i * (argc - 1) + j].is_visited = false;
            }
        }
        if (!r_exist) {
            return EXIT_FAILURE;
        } else {
            solveur(tableauCoord, r, (argc - 1), r);
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

bool verif_solution(coord *tableauCoord, int taille) {
    //verifie si la solution est valide
    //tableauCoord -> tableau de coordonnees
    //taille -> taille du tableau
    for (int i = 0; i < taille * taille; i++) {
        if (tableauCoord[i].is_visited == false) {
            return false;
        }
    }
    return true;
}

int solveur(coord *grille, coord actual, int size, coord prev) {
    actual.is_visited = true;
    if(verif_solution(grille, size)){
        puts("Solution trouvée");
        return EXIT_SUCCESS;
    }

    printf("%d | %d | %c - %d | %d | %c\n",prev.x , prev.y, prev.value, actual.x, actual.y, actual.value);
    if (actual.x == r.x && actual.y == r.y && actual.value == r.value) {
        r.is_visited = true;
    }
    if (actual.x == g.x && actual.y == g.y && actual.value == g.value) {
        g.is_visited = true;
    }
    if (actual.x == b.x && actual.y == b.y && actual.value == b.value) {
        b.is_visited = true;
    }
    if (actual.x == y.x && actual.y == y.y && actual.value == y.value) {
        y.is_visited = true;
    }
    if (actual.x == p.x && actual.y == p.y && actual.value == p.value) {
        p.is_visited = true;
    }
    if (!isdigit(actual.value)) {
        if (!grille[actual.y * size + actual.x - size].is_visited && not_wall(actual.y * size + actual.x, 0, size) && grille[actual.y * size + actual.x - size].value != '0') {
            grille[actual.y * size + actual.x - size].is_visited = true;
            solveur(grille, grille[actual.y * size + actual.x - size], size, actual);
            grille[actual.y * size + actual.x - size].is_visited = false;
        }
        if (!grille[actual.y * size + actual.x + 1].is_visited && not_wall(actual.y * size + actual.x, 1, size) && grille[actual.y * size + actual.x + 1].value != '0') {
            grille[actual.y * size + actual.x + 1].is_visited = true;
            solveur(grille, grille[actual.y * size + actual.x + 1], size, actual);
            grille[actual.y * size + actual.x + 1].is_visited = false;
        }
        if (!grille[actual.y * size + actual.x - 1].is_visited && not_wall(actual.y * size + actual.x, 2, size) && grille[actual.y * size + actual.x - 1].value != '0') {
            grille[actual.y * size + actual.x - 1].is_visited = true;
            solveur(grille, grille[actual.y * size + actual.x - 1], size, actual);
            grille[actual.y * size + actual.x - 1].is_visited = false;
        }
        if (!grille[actual.y * size + actual.x + size].is_visited && not_wall(actual.y * size + actual.x, 3, size) && grille[actual.y * size + actual.x + size].value != '0') {
            grille[actual.y * size + actual.x + size].is_visited = true;
            solveur(grille, grille[actual.y * size + actual.x + size], size, actual);
            grille[actual.y * size + actual.x + size].is_visited = false;
        }
        if (g_exist && !g.is_visited) {
            solveur(grille, g, size, actual);
            g.is_visited = false;
        }
        if (b_exist && !b.is_visited) {
            solveur(grille, b, size, actual);
            b.is_visited = false;
        }
        if (y_exist && !y.is_visited) {
            solveur(grille, y, size, actual);
            y.is_visited = false;
        }
        if (p_exist && !p.is_visited) {
            solveur(grille, p, size, actual);
            p.is_visited = false;
        }
        if (r_exist && !r.is_visited) {
            return solveur(grille, r, size, actual);
            r.is_visited = false;
        }
    } else {
        if (atoi(&grille[actual.y * size + actual.x - size].value) >= atoi(&actual.value) && !grille[actual.y * size + actual.x - size].is_visited && not_wall(actual.y * size + actual.x, 0, size) && isdigit(grille[actual.y * size + actual.x - size].value)) {
            grille[actual.y * size + actual.x - size].is_visited = true;
            solveur(grille, grille[actual.y * size + actual.x - size], size, actual);
            grille[actual.y * size + actual.x - size].is_visited = false;
        }
        if (atoi(&grille[actual.y * size + actual.x + 1].value) >= atoi(&actual.value) && !grille[actual.y * size + actual.x + 1].is_visited && not_wall(actual.y * size + actual.x, 1, size) && isdigit(grille[actual.y * size + actual.x + 1].value)) {
            grille[actual.y * size + actual.x + 1].is_visited = true;
            solveur(grille, grille[actual.y * size + actual.x + 1], size, actual);
            grille[actual.y * size + actual.x + 1].is_visited = false;
        }
        if (atoi(&grille[actual.y * size + actual.x - 1].value) >= atoi(&actual.value) && !grille[actual.y * size + actual.x - 1].is_visited && not_wall(actual.y * size + actual.x, 2, size) && isdigit(grille[actual.y * size + actual.x - 1].value)) {
            grille[actual.y * size + actual.x - 1].is_visited = true;
            solveur(grille, grille[actual.y * size + actual.x - 1], size, actual);
            grille[actual.y * size + actual.x - 1].is_visited = false;
        }
        if (atoi(&grille[actual.y * size + actual.x + size].value) >= atoi(&actual.value) && !grille[actual.y * size + actual.x + size].is_visited && not_wall(actual.y * size + actual.x, 3, size) && isdigit(grille[actual.y * size + actual.x + size].value)) {
            grille[actual.y * size + actual.x + size].is_visited = true;
            solveur(grille, grille[actual.y * size + actual.x + size], size, actual);
            grille[actual.y * size + actual.x + size].is_visited = false;
        }
        if (g_exist && !g.is_visited) {
            solveur(grille, g, size, actual);
            g.is_visited = false;
        }
        if (b_exist && !b.is_visited) {
            solveur(grille, b, size, actual);
            b.is_visited = false;
        }
        if (y_exist && !y.is_visited) {
            solveur(grille, y, size, actual);
            y.is_visited = false;
        }
        if (p_exist && !p.is_visited) {
            solveur(grille, p, size, actual);
            p.is_visited = false;
        }
        if (r_exist && !r.is_visited) {
            solveur(grille, r, size, actual);
            r.is_visited = false;
        }

    }
}




