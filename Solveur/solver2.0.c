//
// Created by Administrateur on 25/05/2022.
//

//
// Created by cyriaquet on 25/05/22.
//

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <stdbool.h>

typedef struct coord_{
    int x;
    int y;
    char value;
    bool is_visited;
} coord;

// 0 North 1 East 2 West 3 South
// 000g1 00001 00022 00033 00044

int main(int argc,char *argv[]){
    if (argc > 11){
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
        if (tableauCoord == NULL){
            return 1;
        }
        for (int i = 0; i < strlen(l1); i++) {

        }
    }
}


