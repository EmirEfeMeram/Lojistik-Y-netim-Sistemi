<?php
ob_start();
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
$Tsorgu=mysqli_query($conn,"SELECT araclar.Arac_Marka,araclar.Arac_Model,gonderim.Gonderim_T_Sure,gonderim.Gonderim_Mesafe,gonderim.Gonderim_Maliyeti,gonderim.Gonderim_Zamani,subeler.Sube_Ad,suruculer.Surucu_ad,suruculer.Surucu_soyad FROM gonderim,araclar,subeler,suruculer WHERE gonderim.Arac_ID=araclar.Arac_ID and subeler.Sube_ID=gonderim.Sube_ID AND suruculer.Surucu_ID=gonderim.Surucu_ID ORDER BY `gonderim`.`Gonderim_Zamani` DESC");
$Tdizi=mysqli_fetch_assoc($Tsorgu);
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <title>Geçmiş Gönderiler/Lojistik Yönetim Sistemi</title>
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Modernize Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <script
		src="https://code.jquery.com/jquery-3.5.0.js"
		integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc="
		crossorigin="anonymous">
    </script>
		
    <!-- //Meta Tags -->

    <!-- Style-sheets -->
    <!-- Bootstrap Css -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <!-- Bootstrap Css -->
    <link rel="stylesheet" type="text/css" href="css/pignose.calender.css" />

    <!-- Common Css -->
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <!--// Common Css -->
    <!-- Nav Css -->
    <link rel="stylesheet" href="css/style4.css">
    <!--// Nav Css -->
    <!-- Fontawesome Css -->
    <link href="css/fontawesome-all.css" rel="stylesheet">
    <!--// Fontawesome Css -->
    <!--// Style-sheets -->

    <!--web-fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Exo:ital,wght@1,300&display=swap" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!--//web-fonts-->
</head>
<body>
    <div class="se-pre-con"></div>
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h1>
                    <a href="index.html">Lojistik Yönetim Sistemi</a>
                </h1>
                <span>LYS</span>
            </div>
            <div class="profile-bg"></div>
            <ul class="list-unstyled components">
                <li class="active">
                    <a href="index3.php">
                        <i class="fas fa-th-large"></i>
                        Anasayfa
                    </a>
                </li>
                                <li>
                    <a href="maps.php">
                        <i class="far fa-map"></i>
                        Harita
                    </a>
                </li>
                <li>
                    <a href="Gonderi.php" >
                        <i class="fas fa-laptop"></i>
                        Gonderi Olustur
                        
                    </a>

                </li>
               
                <li>
                    <a href="GecmisGonderi.php">
                        <i class="fas fa-users"></i>
                        Geçmiş Gonderiler
                        
                    </a>
   
                </li>

            </ul>
        </nav>

        <!-- Page Content Holder -->
        <div id="content">
           
            <div class="container-fluid">
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
            echo '<form name="form1" action="GecmisGonderi.php" method="post" >';
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
                echo  '<td class="tg-fuxe"><input type="number" name="sure" id="sure" min="2" ></td>';
                echo '<td class="tg-fuxe"> <input type="submit" name="ekle" value="ekle" /> </td>';
                echo '</form>' ;  
                $bos = empty($_POST["sure"]);
                if(!$bos){
                    $gonderimsuresi = $_POST["sure"]; 
                    if($gonderimsuresi>=$gonderimtsure+11 && !empty($gonderimsuresi)){                                             
                        $gonderimbasari=0;
                        $sql = "INSERT INTO gonderimsure(Gonderim_ID,Gonderim_Suresi,Gonderim_Basari) values('$gonderimidsure','$gonderimsuresi','$gonderimbasari')";
                        if (mysqli_query($conn, $sql)) {
                            header("Location: GecmisGonderi.php");
                        }      
                        else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
                    }
                    else{
                        $gonderimbasari=1;
                        $sql = "INSERT INTO gonderimsure(Gonderim_ID,Gonderim_Suresi,Gonderim_Basari) values('$gonderimidsure','$gonderimsuresi','$gonderimbasari')";
                        if (mysqli_query($conn, $sql)) {
                            header("Location: GecmisGonderi.php");
                        }      
                        else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
ob_end_flush();        
?>

		
    </tbody>
	</table>

            </div>   
        </div>
    </div>


    <!-- Required common Js -->
    <script src='js/jquery-2.2.3.min.js'></script>
    <!-- //Required common Js -->
    
    <!-- loading-gif Js -->
    <script src="js/modernizr.js"></script>
    <script>
        //paste this code under head tag or in a seperate js file.
        // Wait for window load
        $(window).load(function () {
            // Animate loader off screen
            $(".se-pre-con").fadeOut("slow");;
        });
    </script>
    <!--// loading-gif Js -->

    <!-- Sidebar-nav Js -->
    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
    <!--// Sidebar-nav Js -->

  
    <!-- Js for bootstrap working-->
    <script src="js/bootstrap.min.js"></script>
    <!-- //Js for bootstrap working -->

</body>

</html>