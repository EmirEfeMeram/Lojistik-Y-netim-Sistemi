<html>

<head>
	<meta charset="utf-8">
	<title>Notlar</title>
</head>

<body>
    <style type="text/css">
    .tg  {border-collapse:collapse;border-color:#aaa;border-spacing:0;}
    .tg td{background-color:#fff;border-color:#aaa;border-style:solid;border-width:0px;color:#333;
    font-family:Arial, sans-serif;font-size:14px;overflow:hidden;padding:10px 20px;word-break:normal;}
    .tg th{background-color:#f38630;border-color:#aaa;border-style:solid;border-width:0px;color:#fff;
    font-family:Arial, sans-serif;font-size:14px;font-weight:normal;overflow:hidden;padding:10px 20px;word-break:normal;}
    .tg .tg-fuxe{border-color:inherit;font-size:18px;text-align:left;vertical-align:top}
    .tg .tg-w0ug{border-color:inherit;font-family:Verdana, Geneva, sans-serif !important;;font-size:18px;text-align:center;
    vertical-align:top}

    </style>
    <table class="tg">
    <thead>
    <tr>
    <th class="tg-fuxe">Şube</th>
    <th class="tg-fuxe">Sürücü</th>
    <th class="tg-fuxe">Araç</th>
    <th class="tg-fuxe">Tahmini Süre</th>
    <th class="tg-fuxe">Mesafe</th>
    <th class="tg-fuxe">Maliyet</th>
    <th class="tg-fuxe">Gönderim Zamanı</th>
    <th class="tg-fuxe">Gönderim süresi</th>
    <th class="tg-fuxe">Başarı/Ekle</th>
    </tr>
    </thead>
    <tbody>
    
	
<?php

	
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
		$sonuc=mysqli_query($conn,"SELECT araclar.Arac_Marka,araclar.Arac_Model,gonderim.Gonderim_T_Sure,gonderim.Gonderim_Mesafe,gonderim.Gonderim_Maliyeti,gonderim.Gonderim_Zamani,subeler.Sube_Ad,suruculer.Surucu_ad,suruculer.Surucu_soyad,gonderim.Gonderim_ID FROM gonderim,araclar,subeler,suruculer WHERE gonderim.Arac_ID=araclar.Arac_ID and subeler.Sube_ID=gonderim.Sube_ID AND suruculer.Surucu_ID=gonderim.Surucu_ID ORDER BY `gonderim`.`Gonderim_Zamani` DESC");	

        $gonderimid=1;
        while($satir=mysqli_fetch_array($sonuc))
		{   
            echo '<form name="form1" action="veriliste1.php" method="post" >';
			echo '<tr>';
			echo '<td class="tg-w0ug">'.$satir['Sube_Ad'].'</td>';
			echo '<td class="tg-fuxe">'.$satir['Surucu_ad'].' '.$satir['Surucu_soyad'].'</td>';
            echo '<td class="tg-fuxe">'.$satir["Arac_Marka"]." ".$satir["Arac_Model"].'</td>';
            echo '<td class="tg-fuxe">'.$satir['Gonderim_T_Sure']." DK".'</td>';			
            echo '<td class="tg-fuxe">'.$satir['Gonderim_Mesafe']." KM" .'</td>';
            echo '<td class="tg-fuxe">'.round($satir["Gonderim_Maliyeti"],2)." TL".'</td>';
            echo '<td class="tg-fuxe">'.$satir['Gonderim_Zamani'].'</td>';
            $gonderimid=$satir["Gonderim_ID"];
            $gonderimidsure=$gonderimid;
            $gonderimsuretablo=mysqli_query($conn,"SELECT gonderimsure.Gonderim_Suresi,gonderimsure.Gonderim_Basari FROM gonderimsure WHERE gonderimsure.Gonderim_ID='$gonderimid'");
            $gonderimsuredizi=mysqli_fetch_array($gonderimsuretablo);
            $gonderimtsure=$satir['Gonderim_T_Sure'];
            $gonderimsabit=$gonderimsuredizi["Gonderim_Suresi"];
            $gonderimbool=$gonderimsuredizi["Gonderim_Basari"];
            if ($gonderimsabit==""){
                $gonderimidsure=$satir["Gonderim_ID"];
                echo  '<td class="tg-fuxe"><input type="number" name="sure" id="sure" min="5" ></td>';
                echo '<td class="tg-fuxe"> <input type="submit" name="ekle" value="ekle" /> </td>';
                echo '</form>' ;  
                $bos = empty($_POST["sure"]);
                if(!$bos){
                    $gonderimsuresi = $_POST["sure"]; 
                    if($gonderimsures>$gonderimtsure+10 && !empty($gonderimsuresi)){                                             
                        $gonderimbasari=0;
                        $sql = "INSERT INTO gonderimsure(Gonderim_ID,Gonderim_Suresi,Gonderim_Basari) values('$gonderimidsure','$gonderimsuresi','$gonderimbasari')";
                        if (mysqli_query($conn, $sql)) {
                            header("Location: veriliste1.php");
                        }      
                        else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                
                        }
                    }
                    else{
                        $gonderimbasari=1;
                        $sql = "INSERT INTO gonderimsure(Gonderim_ID,Gonderim_Suresi,Gonderim_Basari) values('$gonderimidsure','$gonderimsuresi','$gonderimbasari')";
                        if (mysqli_query($conn, $sql)) {
                            header("Location: veriliste1.php");
                        }      
                        else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                            echo $gonderimidsure;
                        }
                    }  
                }
                                        
            }
            else if ($gonderimbool=="1"){
                echo '<td class="tg-fuxe">'.$gonderimsabit.'</td>';
                echo '<td class="tg-fuxe">Başarılı</td>';
            }
            else if ($gonderimbool=="0"){
                echo '<td class="tg-fuxe">'.$gonderimsabit.'</td>';
                echo '<td class="tg-fuxe">Başarısız</td>';
            }

			
            echo '</tr>';
            echo '</form>';            
        }
        echo $gonderimid;
?>

		
    </tbody>
	</table>

</body>
</html>

<script language="JavaScript">
function uyari() {

	if (confirm("Bu kaydı silmek istediğinize emin misiniz?"))
		return true;
	else 
		return false;
}
</script>