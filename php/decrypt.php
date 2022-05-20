<?php
/*
void decrypt()
{
    long int pt,ct,key=d[0],k;
    i=0;
    while(en[i]!=-1)
    {
        ct=temp[i];
        k=1;
        for(j=0;j<key;j++)
        {
            k=k*ct;
            k=k%n;
        }
        pt=k+96;
        m[i]=pt;
        i++;
    }
    m[i]=-1;
    printf("\nTHE DECRYPTED MESSAGE IS\n");
    for(i=0;m[i]!=-1;i++)
        printf("%c",m[i]);
}
 */
setcookie("en","`�y6",time()+3600);

function decrypt()
{
    $key = "219341";
    $i = 0;
    $json = file_get_contents('../level.json');
    $data = json_decode($json, false);
    $tab = $data->Niv1->level;
    $tab = $_COOKIE['en'];
    print_r($tab);
    while ($tab[$i] != null) {
        $k = 1;
        for ($j = 0; $j < $key; $j++) {
            $k = $k * $ct;
            $k = $k % strlen($key);
        }
        $pt = $k + 96;
        $m[$i] = $pt;
        $i++;
    }
}

decrypt();