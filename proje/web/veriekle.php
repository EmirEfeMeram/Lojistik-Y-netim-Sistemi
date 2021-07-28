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


    $SubeID = $_POST["subeler"];
    $SurucuID = $_POST["Surucu"];
    $AracID = $_POST["Arac"];
    $Gonderim_T_Sure = $_POST["sure"];
    $Gonderim_Mesafe = $_POST["mesafe"];
    
    function getir($baslangic, $son, $cekilmek_istenen)
    {
        @preg_match_all('/' . preg_quote($baslangic, '/') .
        '(.*?)'. preg_quote($son, '/').'/i', $cekilmek_istenen, $m);
        return @$m[1];
    }

    $url = "https://www.opet.com.tr/izmir";
    $icerik = file_get_contents($url);

    $VeriDizi = getir('<span>','</span>',$icerik);
    $MotorinFiyat= $VeriDizi[8];
    $FiyatAr=explode("/",$MotorinFiyat);
    $fiyat=$FiyatAr[0];
    $fiyat=(float)$fiyat;
    $sorgu=mysqli_query($conn,"SELECT Arac_Tuketim FROM araclar WHERE Arac_ID='$AracID'");
    $dizi=mysqli_fetch_assoc($sorgu);
    $yakıt_tuketim=$dizi["Arac_Tuketim"];
    $yakıt_tuketim=(float)$yakıt_tuketim;
    $Maliyet=($Gonderim_Mesafe*$yakıt_tuketim)*$fiyat;

     
    $sql = "INSERT INTO gonderim(Sube_ID,Surucu_ID,Arac_ID,Gonderim_T_Sure,Gonderim_Mesafe,Gonderim_Maliyeti) values('$SubeID','$SurucuID','$AracID','$Gonderim_T_Sure','$Gonderim_Mesafe','$Maliyet')";
    if (mysqli_query($conn, $sql)) {      
    } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  
    $Tsorgu=mysqli_query($conn,"SELECT araclar.Arac_Marka,araclar.Arac_Model,gonderim.Gonderim_T_Sure,gonderim.Gonderim_Mesafe,gonderim.Gonderim_Maliyeti,gonderim.Gonderim_Zamani,subeler.Sube_Ad,suruculer.Surucu_ad,suruculer.Surucu_soyad FROM gonderim,araclar,subeler,suruculer WHERE gonderim.Arac_ID=araclar.Arac_ID and subeler.Sube_ID=gonderim.Sube_ID AND suruculer.Surucu_ID=gonderim.Surucu_ID ORDER BY `gonderim`.`Gonderim_Zamani` DESC LIMIT 1");
    $Tdizi=mysqli_fetch_assoc($Tsorgu);
    mysqli_close($conn);
        
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <title>Gönderi Oluşturuldu/Lojistik Yönetim Sistemi</title>
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
    <link href="//fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
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
    
        <div id="content">
            
            <div class="container-fluid">
                <h1>Gönderiminiz Oluşturuldu</h1>
                <style type="text/css">
                .tg  {border-collapse:collapse;border-color:#aaa;border-spacing:0;}
                .tg td{background-color:#fff;border-color:#aaa;border-style:solid;border-width:0px;color:#333;
                font-family:Arial, sans-serif;font-size:14px;overflow:hidden;padding:10px 20px;word-break:normal;}
                .tg th{background-color:#f38630;border-color:#aaa;border-style:solid;border-width:0px;color:#fff;
                font-family:Arial, sans-serif;font-size:14px;font-weight:normal;overflow:hidden;padding:10px 20px;word-break:normal;}
                .tg .tg-fuxe{border-color:inherit;font-size:18px;text-align:left;vertical-align:top}
                .tg .tg-w0ug{border-color:inherit;font-family:Verdana, Geneva, sans-serif !important;;font-size:18px;text-align:center;
                vertical-align:top}
                .button {
                background-color:#008CBA;
                border: none;
                color: white;
                padding: 16px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                transition-duration: 0.4s;
                cursor: pointer;
                }

                .button:hover {
                background-color: #4CAF50; /* Green */
                color: white;
                } 
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
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="tg-w0ug"><?php echo $Tdizi["Sube_Ad"]?></td>
                    <td class="tg-fuxe"><?php echo $Tdizi["Surucu_ad"]." ".$Tdizi["Surucu_soyad"] ?></td>
                    <td class="tg-fuxe"><?php echo $Tdizi["Arac_Marka"]." ".$Tdizi["Arac_Model"] ?></td>
                    <td class="tg-fuxe"><?php echo $Tdizi["Gonderim_T_Sure"]." DK"?></td>
                    <td class="tg-fuxe"><?php echo $Tdizi["Gonderim_Mesafe"]." KM" ?></td>
                    <td class="tg-fuxe"><?php echo round($Tdizi["Gonderim_Maliyeti"],2)." TL" ?></td>
                    <td class="tg-fuxe"><?php echo $Tdizi["Gonderim_Zamani"]?></td>
                </tr>
                </tbody>
                </table>
                <button class="button" onclick="window.location.href='Gonderi.php'">Yeni Gönderi Oluştur</button>
                <button class="button" onclick="window.location.href='index3.php'">Anasayfaya Dön</button>
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
        