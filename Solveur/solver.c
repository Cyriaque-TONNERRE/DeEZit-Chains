//
// Created by Administrateur on 20/05/2022.

#include <stdio.h>
#include <stdlib.h>
#include <stdbool.h>
#include <math.h>
#include <stddef.h>
#include "fonctions.h"


char *tab[] = {"44111765","44102345","g1102222","00001200","000r1220","00000110","000001b0","00000000"};


coord tableau[sizeof(*tab) * sizeof(*tab)];

int initialisation(char **tab, coord *tableau){
    printf("%d",sizeof(tab));

    for(int i = 0; i < sizeof(tab);i++){
        for(int j = 0; j < sizeof(tab);j++){
            tableau[j+i*sizeof(tab)].x = j;
            tableau[j+i*sizeof(tab)].y = i;
            tableau[j+i*sizeof(tab)].value = tab[i][j];
            //printf("\nX : %d |",tableau[j+i*sizeof(tab)].x);
            //printf(" Y : %d |",tableau[j+i*sizeof(tab)].y);
            //printf(" Used : %d |",tableau[j+i*sizeof(tab)].used);
            //printf(" Value : %c.",tableau[j+i*sizeof(tab)].value);
        }
    }
};

int voisin(coord *tableau, int x, int y, Liste * Myliste){
    int nb_chemins = 0;
    bool droite = false;
    bool gauche = false;
    bool haut = false;
    bool bas = false;
    coord box = tableau[x + y*(int)sizeof(tableau)];
    int vraiVoisins = 0;

    if(box.used == false){ //La box en argument n'appartient pas à une chaine
        box.used = true;


        //Haut
        if((box.y > 0) && (tableau[x + (y-1)*(int)sizeof(tableau)].value == box.value)){ //Si haut existe et pareil
            vraiVoisins++;
            if((box.y > 0) && (tableau[x + (y-1)*(int)sizeof(tableau)].value == box.value) && (tableau[x + (y-1)*(int)sizeof(tableau)].used == false)){ //Si haut existe et pareil
            //printf("\n Haut : %c",tableau[x + (y-1)*(int)sizeof(tableau)].value);
            nb_chemins++;
            haut = true;
            }
        }
        //Droite
        if(((box.x < sizeof(tableau) - 1)) && (tableau[(x+1) + y*(int)sizeof(tableau)].value == box.value)){ //Si Droite existe et pareil
            vraiVoisins++;
            if(((box.x < sizeof(tableau) - 1)) && (tableau[(x+1) + y*(int)sizeof(tableau)].value == box.value) && (tableau[(x+1) + y*(int)sizeof(tableau)].used == false)){ //Si Droite existe et pareil
            //printf("\n Droite : %c",tableau[(x+1) + y*(int)sizeof(tableau)].value);
            nb_chemins++;
            droite = true;
            }
        }
        //Bas
        if((box.y < sizeof(tableau) - 1) && (tableau[x + (y+1)*(int)sizeof(tableau)].value == box.value)){ //Si Bas existe
            vraiVoisins++;
            if((box.y < sizeof(tableau) - 1) && (tableau[x + (y+1)*(int)sizeof(tableau)].value == box.value) && (tableau[x + (y+1)*(int)sizeof(tableau)].used == false)){ //Si Bas existe
            //printf("\n Bas : %c",tableau[x + (y+1)*(int)sizeof(tableau)].value);
            nb_chemins++;
            bas = true;
            }
        }
        //Gauche
        if((box.x > 0) && (tableau[(x-1) + y*(int)sizeof(tableau)].value == box.value)){
            vraiVoisins++;
            //Si Gauche existe
            if((box.x > 0) && (tableau[(x-1) + y*(int)sizeof(tableau)].value == box.value) && (tableau[(x-1) + y*(int)sizeof(tableau)].used == false)){ //Si Gauche existe
               // printf("\n Gauche : %c",tableau[(x-1) + y*(int)sizeof(tableau)].value);
                nb_chemins++;
                gauche = true;
            }
        }


        if(vraiVoisins >= 3){
            if(Myliste->size == 0){
                inserthead(Myliste, NewLinkedListItem(box));
            }
            return 1;
        }
        else if(nb_chemins == 0){
            box.changeSens = true;
            tableau[x + y*(int)sizeof(tableau)] = box;
            inserttail(Myliste, NewLinkedListItem(box));
        }
        else{
            inserttail(Myliste, NewLinkedListItem(box));
        }
        if(nb_chemins <= 2){ //On ajoute à la chaîne
            if(haut){
                //printf("Nouvelle execution X : %d | Y : %d",box.x,box.y-1);
                tableau[x + y*(int)sizeof(tableau)] = box;
                voisin(tableau, (box.x), (box.y -1),Myliste);
            }
            if(droite){
                //printf("Nouvelle execution X : %d | Y : %d",box.x+1,box.y);
                tableau[x + y*(int)sizeof(tableau)] = box;
                voisin(tableau, (box.x+1), (box.y) ,Myliste);
            }
            if(bas){
                //printf("Nouvelle execution X : %d | Y : %d",box.x,box.y+1);
                tableau[x + y*(int)sizeof(tableau)] = box;
                voisin(tableau, (box.x), (box.y+1) ,Myliste);
            }
            if(gauche){
                //printf("Nouvelle execution X : %d | Y : %d",box.x-1,box.y);
                tableau[x + y*(int)sizeof(tableau)] = box;
                voisin(tableau, (box.x-1), (box.y) ,Myliste);
            }

        }




    }

}

int trier(Liste * Myliste){
    if(Myliste->size != 1){
        Maillon * tmp = Myliste->head;
        for(int i = 0; i < Myliste->size; i++){
            if(tmp->data.changeSens == 1){
                //Partie a supprimer après

                tmp = tmp->next;
                for(int j = 0; j < Myliste->size - i - 1; j++){
                    Maillon * previous = tmp;
                    tmp = tmp->next;
                    inserthead(Myliste, NewLinkedListItem(previous->data));
                    Removefromliste(Myliste,previous);
                }
                return 1;
            }
            else{
                tmp = tmp->next;
            }

        }
    }

}





//printf("no %d",sizeof(tableau));




int main(){
    Liste * Myliste;
    Myliste = NewListe();

    initialisation(tab,tableau);
    //voisin(tableau,5,2,Myliste);
    //printf(" Value : %c.",tableau[9].value);
    //DisplayListe(Myliste);
    //trier(Myliste);
    //DisplayListe(Myliste);
    Liste *  liste_liens[39];
    int indexliste = 0;

    /*
    for(int i = 0; i < sizeof(tab);i++) {
        for (int j = 0; j < sizeof(tab); j++) {
            if((tableau[j+i*sizeof(tab)].used != false) && (tableau[j+i*sizeof(tab)].value != '0')){
                printf("%c",tableau[j+i*sizeof(tab)].value);
                Myliste = NewListe();
                voisin(tableau,j,i,Myliste);
                trier(Myliste);
                liste_liens[indexliste] = Myliste;
                indexliste++;
               DisplayListe(Myliste);

            }

        }
    }
     */
    for(int i = 0; i < sizeof(tab);i++) {
        if((tableau[i].used == false) && (tableau[i].value != '0')){
            Myliste = NewListe();
            voisin(tableau,tableau[i].x,tableau[i].y,Myliste);
            trier(Myliste);
            liste_liens[indexliste] = Myliste;
            indexliste++;
            DisplayListe(Myliste);
        }
    }





        return EXIT_SUCCESS;
}

