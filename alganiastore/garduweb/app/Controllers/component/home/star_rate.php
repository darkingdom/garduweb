<?php
if ($data >= "5") :
    $star = "
    <ion-icon name=\"star\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star\" style=\"color: darkorange;\"></ion-icon>";
elseif ($data > "4" and $data <= "5") :
    $star = "
    <ion-icon name=\"star\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star-half\" style=\"color: darkorange;\"></ion-icon>";
elseif ($data == "4") :
    $star = "
    <ion-icon name=\"star\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star-outline\" style=\"color: darkorange;\"></ion-icon>";
elseif ($data > "3" and $data < "4") :
    $star = "
    <ion-icon name=\"star\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star-half\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star-outline\" style=\"color: darkorange;\"></ion-icon>";
elseif ($data == "3") :
    $star = "
    <ion-icon name=\"star\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star-outline\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star-outline\" style=\"color: darkorange;\"></ion-icon>";
elseif ($data > "2" and $data < "3") :
    $star = "
    <ion-icon name=\"star\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star-half\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star-outline\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star-outline\" style=\"color: darkorange;\"></ion-icon>";
elseif ($data == "2") :
    $star = "
    <ion-icon name=\"star\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star-outline\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star-outline\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star-outline\" style=\"color: darkorange;\"></ion-icon>";
elseif ($data > "1" and $data < "2") :
    $star = "
    <ion-icon name=\"star\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star-half\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star-outline\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star-outline\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star-outline\" style=\"color: darkorange;\"></ion-icon>";
elseif ($data == "1") :
    $star = "
    <ion-icon name=\"star\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star-outline\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star-outline\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star-outline\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star-outline\" style=\"color: darkorange;\"></ion-icon>";
else :
    $star = "
    <ion-icon name=\"star-outline\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star-outline\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star-outline\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star-outline\" style=\"color: darkorange;\"></ion-icon>
    <ion-icon name=\"star-outline\" style=\"color: darkorange;\"></ion-icon>";
endif;
echo $star;
