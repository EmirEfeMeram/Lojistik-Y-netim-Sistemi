<?php
    $servername = "localhost";
    $database = "phpcalisma";
    $username = "root";
    $password = "";
    $conn = mysqli_connect($servername, $username, $password, $database);
    mysqli_query($conn,"SET CHARACTER SET 'utf8'");
    mysqli_query($conn,"SET SESSION collation_connection ='utf8_unicode_ci'");

    $sth = mysqli_query($conn,"SELECT gonderim.Gonderim_Maliyeti,gonderim.Gonderim_T_Sure,gonderim.Gonderim_Zamani FROM `gonderim`  ORDER BY `gonderim`.`Gonderim_ID`  DESC");

    /*
    ---------------------------
    example data: Table (Chart)
    --------------------------
    weekly_task     percentage gönderim zmani
    Sleep           30          01.10.2020
    Watching Movie  40
    work            44
    */

    //flag is not needed
    $flag = true;
    $table = array();
    $table['cols'] = array(

        // Labels for your chart, these represent the column titles
        // Note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage and string will be used for column title
        array('label' => 'Gonderim maliyeti', 'type' => 'float'),
        array('label' => 'gonderim_suresi', 'type' => 'number'),
        array('label' => 'gonderim_tarihi', 'type' => 'string')


    );

    $rows = array();
    while($r = mysqli_fetch_assoc($sth)) {
        $temp = array();
        // the following line will be used to slice the Pie chart
        $temp[] = array('v' => (float) $r['Gonderim_Maliyeti']); 
        $temp[] = array('v' => (int) $r['Gonderim_T_Sure']); 
        $temp[] = array('v' => (string) $r['Gonderim_T_Sure']); 

        $rows[] = array('c' => $temp);
    }

    $table['rows'] = $rows;
    $jsonTable = json_encode($table);
    echo $jsonTable;
?>