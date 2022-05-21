#include <stdio.h>
#include <stdlib.h>
#include <stdbool.h>

#include "fonctions.h"

Liste *NewListe() {
    Liste *tmp;
    tmp =(Liste*)malloc(sizeof(Liste));
    if (tmp != NULL) {
        tmp->head = NULL;
        tmp->tail = NULL;
        tmp->size = 0;
    }
    return tmp;
}
Maillon *NewLinkedListItem(coord value) {
    Maillon *tmp;
    tmp = (Maillon *) malloc(sizeof(Maillon));
    if (tmp != NULL) {
        tmp->data = value;
        tmp->next = NULL;
        tmp->previous=NULL;
    }
    return(tmp);
}

void DisplayListe(Liste* l){
    if(l==NULL || l->head==NULL || l->tail==NULL) return;
    Maillon *tmp=l->head;
    while(tmp!=NULL){
        printf("\nX : %d | Y : %d | Value : %c | Used : %d | Sens : %d",tmp->data.x,tmp->data.y,tmp->data.value,tmp->data.used, tmp->data.changeSens);
        tmp=tmp->next;
    }
    printf("\n");
}
void RevDisplayListe(Liste* l){
    if(l==NULL || l->head==NULL || l->tail==NULL) return;
    Maillon *tmp=l->tail;
    while(tmp!=NULL){
        printf("%d |",tmp->data);
        tmp=tmp->previous;
    }
    printf("\n");
}

int inserttail(Liste *l, Maillon *m){
    if(l==NULL || m==NULL) return 0;
    if(l->size==0){ l->head=m; l->tail=m;l->size++; return 1;}
    l->tail->next=m;
    m->previous=l->tail;
    l->tail=m;
    l->size++;
    return 1;
}
int inserthead(Liste *l, Maillon *m){
    if(l==NULL || m==NULL) return 0;
    if(l->size==0){ l->head=m; l->tail=m;l->size++; return 1;}
    l->head->previous=m;
    m->next=l->head;
    l->head=l->head->previous;
    l->size++;
    return 1;
}
int sizeofListe(Liste *l){
    if(l==NULL) return -1;
    int compt=0;
    Maillon * tmp = l->head;
    while(tmp!=NULL){
        compt++;
        tmp=tmp->next;
    }
    return compt;
}

int insert_after_elem(Liste *l,Maillon *cible,Maillon *item){
    if(cible==NULL || l==NULL || item==NULL) return 0;
    if(cible==l->tail){cible->next=item; l->tail=item; item->previous=cible;l->size++; return 0;}
    cible->next->previous=item;
    item->next=cible->next;
    cible->next=item;
    item->previous=cible;
    l->size++;
    return 0;
}
int insert_before_elem(Liste *l,Maillon *cible,Maillon *item){
    if(cible==NULL || l==NULL || item==NULL) return 0;
    if(cible==l->head){cible->previous=item; item->next=cible; l->head=item; l->size++; return 1;}
    cible->previous->next=item;
    item->next=cible;
    item->previous=cible->previous;
    cible->previous=item;
    l->size++;
    return 1;
}

int emptyListe(Liste *l){
    if(l==NULL || l->tail==NULL) return 0;
    Maillon * tmp=l->tail;
    while(tmp!=l->head){
        tmp=tmp->previous;
        free(tmp->next);
    }
    free(tmp);
    l->head=NULL;
    l->tail=NULL;
    l->size=0;
    return 1;
}
int Removefromliste(Liste *l, Maillon *m){
    if(l==NULL || m==NULL ||l->head==NULL || l->tail==NULL) return 0;
    if(m==l->head){//Si tete
        l->head=l->head->next;
        l->head->previous=NULL;
        free(m);
        l->size--;
        return 1;
    }
    if(l->tail==m){//si queue
        l->tail=l->tail->previous;
        l->tail->next=NULL;
        free(m);
        l->size--;
        return 1;
    }
    //Si au milieu
    m->previous->next=m->next;
    m->next->previous=m->previous;
    free(m);
    l->size--;
    return 1;

}


int setvalue(Liste *list, Maillon *item, coord value) {
    if(list==NULL || item==NULL) return 0;
    item->data = value;
    return 1;
}
int getvalue(Liste *l, Maillon *m, coord *v){
    if(m==NULL || l==NULL ) return 0;
    *v=m->data;
    return 1;
}

Maillon * getfromvalue(Liste *l, Maillon * start, coord valeur, int sens){
    if(l==NULL|| l->head==NULL||l->tail==NULL|| start==NULL) return NULL;
    Maillon * tmp=start;
    if(sens==1){
        while(tmp!=NULL){
            if (tmp->data.value==valeur.value) return tmp;
            tmp=tmp->next;
        }
        return NULL;
    }
    else{
        while(tmp!=NULL){
            if (tmp->data.value == valeur.value) return tmp;
            tmp=tmp->previous;
        }
        return NULL;
    }
}
Liste * createnewlistefromliste(Liste *l, int min, int max,int taille){
    if(max>l->size ) return NULL;
    if (max<min){ return createnewlistefromliste(l, max,  min, taille);}
    int compt=0;
    Maillon * tmp=l->head;
    Liste * New;
    New=NewListe();
    while(compt!=min){
        compt++;
        tmp=tmp->next;
    }
    while(compt!=max){
        inserttail(New, tmp);
        tmp=tmp->next;
        compt++;
    }
    return New;
}
Liste * clonageListe(Liste * l){
    if(l==NULL || l->head==NULL || l->tail==NULL) return NULL;
    Maillon * tmp=l->head;
    Liste * New;
    New=NewListe();
    while(tmp!=NULL){
        inserttail(New,tmp);
        tmp=tmp->next;
    }
    return New;
}
Maillon * getitemfromindex(Liste *l, int index){
    if(l==NULL || l->head==NULL || index>l->size) return NULL;
    Maillon *tmp=l->head;
    for(int i=1;i<index; ++i){
        tmp=tmp->next;
    }
    return tmp;
}
int insert_item_index_value(Liste *l,int index, coord value){
    if(l==NULL || l->head==NULL || index>l->size) return 0;
    insert_before_elem(l,getitemfromindex(l,index), NewLinkedListItem(value));
    return 1;
}