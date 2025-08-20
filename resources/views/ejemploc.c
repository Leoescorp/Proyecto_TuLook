#include <stdio.h>
#include <stdlib.h>

int main(int argc, char*argv []){
    int F,C;
    int matriz[5][5];

    for(F=0; F<=4; F++){
        for(C=0; C<=4; C++){
            print("Ingresar el valor de la fila %d y la columna %d, ", F, C);
            scanf ("%d", &matriz[F][C]);
        }
    }

    system("pause");
    for(F=0; F<=4; F++){
        for(C=0; C<=4; C++){
            printf("%d\t", matriz[F][C]);
        }
        printf("\n");
    }
    return 0;
}