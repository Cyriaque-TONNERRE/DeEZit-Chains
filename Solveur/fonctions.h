//
// Created by Administrateur on 20/05/2022.
//

#include <stdio.h>
#include <stdlib.h>
#include <stdbool.h>
#include <math.h>

#ifndef UNTITLED1_FONCTIONS_H
#define UNTITLED1_FONCTIONS_H

typedef struct coord_{
    int x;
    int y;
    char value;
    bool used;
    bool changeSens;
}coord;

typedef struct Maillon{
    struct Maillon *next;
    struct Maillon * previous;
    coord data;
}Maillon;

typedef struct Liste{
    Maillon *head;
    Maillon *tail;
    int size;
}Liste;

Liste *NewListe();
Maillon *NewLinkedListItem(coord value);
void DisplayListe(Liste* l);
void RevDisplayListe(Liste* l);
int inserttail(Liste *l, Maillon *m);
int inserthead(Liste *l, Maillon *m);
int sizeofListe(Liste *l);
int insert_after_elem(Liste *l,Maillon *cible,Maillon *item);
int insert_before_elem(Liste *l,Maillon *cible,Maillon *item);
int emptyListe(Liste *l);
int Removefromliste(Liste *l, Maillon *m);
int setvalue(Liste *list, Maillon *item, coord value);
int getvalue(Liste *l, Maillon *m, coord *v);
Maillon * getfromvalue(Liste *l, Maillon * start, coord value, int sens);
Liste * createnewlistefromliste(Liste *l, int min, int max,int taille);
Liste * clonageListe(Liste * l);
Maillon * getitemfromindex(Liste *l, int index);
int insert_item_index_value(Liste *l,int index, coord value);



#endif //UNTITLED1_FONCTIONS_H
