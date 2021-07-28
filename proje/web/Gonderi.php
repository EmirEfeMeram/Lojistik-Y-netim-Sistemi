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

$sorgu=mysqli_query($conn,"SELECT round(AVG(gonderim.Gonderim_Maliyeti),2)AS 'gonderim_ort' FROM gonderim");
$dizi=mysqli_fetch_assoc($sorgu);
$ortmaliyet=$dizi['gonderim_ort'];
$sorgu1=mysqli_query($conn,"SELECT round(SUM(gonderim.Gonderim_Maliyeti),2)AS 'gonderim_top' FROM gonderim");
$dizi1=mysqli_fetch_assoc($sorgu1);
$topmaliyet=$dizi1['gonderim_top'];
$sorgu2=mysqli_query($conn,"SELECT round(AVG(gonderim.Gonderim_Mesafe),2)AS 'gonderim_mesafe' FROM gonderim");
$dizi2=mysqli_fetch_assoc($sorgu2);
$ortmesafe=$dizi2['gonderim_mesafe'];
$alisorgu=mysqli_query($conn,"SELECT COUNT(gonderim.Gonderim_ID) as 'ali_toplam_gonderim' FROM gonderim,gonderimsure,suruculer WHERE gonderim.Gonderim_ID=gonderimsure.Gonderim_Sure_ID and suruculer.Surucu_ID=gonderim.Surucu_ID AND gonderim.Surucu_ID='6' ");
$alidizi=mysqli_fetch_assoc($alisorgu);
$alisayi=$alidizi['ali_toplam_gonderim'];
$fatihsorgu=mysqli_query($conn,"SELECT COUNT(gonderim.Gonderim_ID) as 'fatih_toplam_gonderim' FROM gonderim,gonderimsure,suruculer WHERE gonderim.Gonderim_ID=gonderimsure.Gonderim_Sure_ID and suruculer.Surucu_ID=gonderim.Surucu_ID AND gonderim.Surucu_ID='7' ");
$fatihdizi=mysqli_fetch_assoc($fatihsorgu);
$fatihsayi=$fatihdizi['fatih_toplam_gonderim'];
$enessorgu=mysqli_query($conn,"SELECT COUNT(gonderim.Gonderim_ID) as 'enes_toplam_gonderim' FROM gonderim,gonderimsure,suruculer WHERE gonderim.Gonderim_ID=gonderimsure.Gonderim_Sure_ID and suruculer.Surucu_ID=gonderim.Surucu_ID AND gonderim.Surucu_ID='8' ");
$enesdizi=mysqli_fetch_assoc($enessorgu);
$enessayi=$enesdizi['enes_toplam_gonderim'];
$tahasorgu=mysqli_query($conn,"SELECT COUNT(gonderim.Gonderim_ID) as 'taha_toplam_gonderim' FROM gonderim,gonderimsure,suruculer WHERE gonderim.Gonderim_ID=gonderimsure.Gonderim_Sure_ID and suruculer.Surucu_ID=gonderim.Surucu_ID AND gonderim.Surucu_ID='9' ");
$tahadizi=mysqli_fetch_assoc($tahasorgu);
$tahasayi=$tahadizi['taha_toplam_gonderim'];
$yigitsorgu=mysqli_query($conn,"SELECT COUNT(gonderim.Gonderim_ID) as 'yigit_toplam_gonderim' FROM gonderim,gonderimsure,suruculer WHERE gonderim.Gonderim_ID=gonderimsure.Gonderim_Sure_ID and suruculer.Surucu_ID=gonderim.Surucu_ID AND gonderim.Surucu_ID='10' ");
$yigitdizi=mysqli_fetch_assoc($yigitsorgu);
$yigitsayi=$yigitdizi['yigit_toplam_gonderim'];
$alisorgu1=mysqli_query($conn,"SELECT COUNT(gonderim.Gonderim_ID) as 'ali_basarili_gonderim' FROM gonderim,gonderimsure,suruculer WHERE gonderim.Gonderim_ID=gonderimsure.Gonderim_ID and suruculer.Surucu_ID=gonderim.Surucu_ID AND gonderim.Surucu_ID='6' AND gonderimsure.Gonderim_Basari='1' ");
$alidizi1=mysqli_fetch_assoc($alisorgu1);
$alibasari=$alidizi1['ali_basarili_gonderim'];
$fatihsorgu1=mysqli_query($conn,"SELECT COUNT(gonderim.Gonderim_ID) as 'fatih_basarili_gonderim' FROM gonderim,gonderimsure,suruculer WHERE gonderim.Gonderim_ID=gonderimsure.Gonderim_ID and suruculer.Surucu_ID=gonderim.Surucu_ID AND gonderim.Surucu_ID='7' AND gonderimsure.Gonderim_Basari='1' ");
$fatihdizi1=mysqli_fetch_assoc($fatihsorgu1);
$fatihbasari=$fatihdizi1['fatih_basarili_gonderim'];
$enessorgu1=mysqli_query($conn,"SELECT COUNT(gonderim.Gonderim_ID) as 'enes_basarili_gonderim' FROM gonderim,gonderimsure,suruculer WHERE gonderim.Gonderim_ID=gonderimsure.Gonderim_ID and suruculer.Surucu_ID=gonderim.Surucu_ID AND gonderim.Surucu_ID='8' AND gonderimsure.Gonderim_Basari='1' ");
$enesdizi1=mysqli_fetch_assoc($enessorgu1);
$enesbasari=$enesdizi1['enes_basarili_gonderim'];
$tahasorgu1=mysqli_query($conn,"SELECT COUNT(gonderim.Gonderim_ID) as 'taha_basarili_gonderim' FROM gonderim,gonderimsure,suruculer WHERE gonderim.Gonderim_ID=gonderimsure.Gonderim_ID and suruculer.Surucu_ID=gonderim.Surucu_ID AND gonderim.Surucu_ID='9' AND gonderimsure.Gonderim_Basari='1' ");
$tahadizi1=mysqli_fetch_assoc($tahasorgu1);
$tahabasari=$tahadizi1['taha_basarili_gonderim'];
$yigitsorgu1=mysqli_query($conn,"SELECT COUNT(gonderim.Gonderim_ID) as 'yigit_basarili_gonderim' FROM gonderim,gonderimsure,suruculer WHERE gonderim.Gonderim_ID=gonderimsure.Gonderim_ID and suruculer.Surucu_ID=gonderim.Surucu_ID AND gonderim.Surucu_ID='10' AND gonderimsure.Gonderim_Basari='1' ");
$yigitdizi1=mysqli_fetch_assoc($yigitsorgu1);
$yigitbasari=$yigitdizi1['yigit_basarili_gonderim'];

$alioran=(($alibasari/$alisayi)*100);
$fatihoran=(($fatihbasari/$fatihsayi)*100);
$enesoran=(($enesbasari/$enessayi)*100);
$tahaoran=(($tahabasari/$tahasayi)*100);
$yigitoran=(($yigitbasari/$yigitsayi)*100);

?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <title>Gönderi Oluştur/Lojistik Yönetim Sistemi</title>
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
    <!-- //Meta Tags -->

    <!-- Style-sheets -->
    <!-- Bootstrap Css -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <!-- Bootstrap Css -->
    <link rel="stylesheet" type="text/css" href="css/pignose.calender.css" />

    <!-- Common Css -->
    <link href="css/gonderi.css" rel="stylesheet" type="text/css" media="all" />
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
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <!--
            Set your own API-key. Testing key is not valid for other web-sites and services.
            Get your API-key on the Developer Dashboard: https://developer.tech.yandex.ru/keys/
        -->
        <script src="https://api-maps.yandex.ru/2.1/?lang=tr_TR&amp;apikey=b2ec5e7a-cf22-496a-8a23-0c5e860f07db" type="text/javascript"></script>
        <script src="routes_to_point.js" type="text/javascript"></script>
        <style>
            body, html {
                padding: 0;
                margin: 0;
                width: 100%;
                height: 100%;
            }
            #map {
                width: 100%;
                height: 100%;
            }
        </style>
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
            <div id="map"style=" width: 100%; height: 500px;">
             
            </div>
             <div class="outer-w3-agile col-xl">
                        <h6>Yakıt Tüketimleri:</h6>
                        <div class="stat-grid p-3 d-flex align-items-center justify-content-between bg-primary">
                            <div class="s-l">
                                <h5> 9.0/100 lt/km</h5>
                                <p >Fiat Ducato</p>
                            </div>
                            <div class="s-2">
                                <h5> 11.4/100 lt/km</h5>
                                <p >Ford Transit</p>
                            </div>
                            <div class="s-3">
                                <h5> 11.2/100 lt/km</h5>
                                <p >MAN TGE</p>
                            </div>
                        </div>
                        <h6>Maliyetler:</h6>
                        <div class="stat-grid p-3 mt-3 d-flex align-items-center justify-content-between bg-success">
                            <div class="s-l">
                                <h5><?php echo $ortmaliyet." TL" ?> </h5>
                                <p>Aylık Ortalama Gönderim Maliyeti</p>
                            </div>
                            <div class="s-l">
                                <h5><?php echo round(($topmaliyet*2),2)." TL" ?></h5>
                                <p>Aylık toplam Yakıt Gideri</p>
                            </div>
                            <div class="s-l">
                                <h5><?php echo round(($ortmesafe),2)." KM" ?></h5>
                                <p>Aylık ortalama Mesafe</p>
                            </div>
                        </div>
                        <h6>Sürücü Başarı Oranları:</h6>
                        <div class="stat-grid p-3 mt-3 d-flex align-items-center justify-content-between bg-danger">
                            <div class="s-l">
                                <h5><?php echo"%". round($alioran,2) ?></h5>
                                <p >Ali Yılmaz</p>
                            </div>
                            <div class="s-l">
                                <h5><?php echo"%". round($fatihoran,2) ?></h5>
                                <p >Fatih Çetin</p>
                            </div>
                            <div class="s-l">
                                <h5><?php echo"%". round($enesoran,2) ?></h5>
                                <p >Enes Taşçı</p>
                            </div>
                            <div class="s-l">
                                <h5><?php echo"%". round($tahaoran,2) ?></h5>
                                <p >Taha Candan</p>
                            </div>
                            <div class="s-l">
                                <h5><?php echo"%". round($yigitoran,2) ?></h5>
                                <p >Yiğit Kılıç</p>
                            </div>
                       
                        </div>

                    </div>
            <form class="" action="veriekle.php" method="post"   style="margin: 70px; ">
               
                <div id="yersecimi">
                    <h4>Gonderim yapilacak sube</h4>
                   <select id="gonderim yeri" name="subeler">
                        
                        <option value="1">Konak</option>
                        <option value="2">Sirinyer</option>
                        <option value="3">Karsıyaka</option>
                        <option value="4">Bornova</option>
                        <option value="5">İnciraltı</option>
                        <option value="6">Diğer</option>
                    </select>    
                </div>
                <div id="surucuradio" name="surucuradio" >
                    <h4>Sürücü Seçin</h4>
                    <input type="radio" id="ali" name="Surucu" value="6">
                    <label for="ali">Ali Yılmaz</label><br>
                    <input type="radio" id="Veli" name="Surucu" value="7">
                    <label for="veli">Fatih Çetin</label><br>
                    <input type="radio" id="Ahmet" name="Surucu" value="8">
                    <label for="ahmet">Enes Taşçı</label>
                    <input type="radio" id="Ahmet" name="Surucu" value="9">
                    <label for="ahmet">Taha Candan</label>
                    <input type="radio" id="Ahmet" name="Surucu" value="10">
                    <label for="ahmet">Yiğit Kılıç</label>
                </div>
                <div id="aracradio" name="aracradio">
                    <h4>Araç Seçin</h4>
                    <input type="radio" id="ford" name="Arac" value="1">
                    <label for="ford">Fiat Ducato</label><br>
                    <input type="radio" id="ısuzu" name="Arac" value="2">
                    <label for="ısuzu">Ford Transit</label><br>
                    <input type="radio" id="renault" name="Arac" value="3">
                    <label for="renault">Man TGE</label>
                </div> 
              
                <div id="degerler">
                    <h4>Degerleri Girin</h4> 
                    <td>Tahmini Sure</td>
                    <input type="number" name="sure" id="sure" min="2" >
                    <td>Mesafe</td>    
                    <input type="number" name="mesafe" id="mesafe" min="2">
                </div>
                <input type="submit" name="gonder" value="gonder" />    

            </form>     
                       
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