<?php
    include "veriliste1.php";
    $servername = "localhost";
    $database = "phpcalisma";
    $username = "root";
    $password = "";
    $conn = mysqli_connect($servername, $username, $password, $database);
    mysqli_query($conn,"SET CHARACTER SET 'utf8'");
    mysqli_query($conn,"SET SESSION collation_connection ='utf8_unicode_ci'");

    if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
    }   
    $gonderimsuresi = $_POST["sure"];
    if($gonderimsuresi>$gonderimtsure+10){                      
        $gonderimbasari=0;
        $sql = "INSERT INTO gonderimsure(Gonderim_ID,Gonderim_Suresi,Gonderim_Basari) values('$gonderimidsure','$gonderimsuresi','$gonderimbasari')";
        if (mysqli_query($conn, $sql)) {}      
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                
        }
    }
    else{
        $gonderimbasari=1;
        $sql = "INSERT INTO gonderimsure(Gonderim_ID,Gonderim_Suresi,Gonderim_Basari) values('$gonderimidsure','$gonderimsuresi','$gonderimbasari')";
        if (mysqli_query($conn, $sql)) {}      
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            echo $gonderimidsure;
        }
    }

     

    mysqli_close($conn);
        
?>