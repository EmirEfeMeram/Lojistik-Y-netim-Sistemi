<?php


    function getir($baslangic, $son, $cekilmek_istenen)
    {
        @preg_match_all('/' . preg_quote($baslangic, '/') .
        '(.*?)'. preg_quote($son, '/').'/i', $cekilmek_istenen, $m);
        return @$m[1];
    }

    $url = "https://www.opet.com.tr/izmir";
    $icerik = file_get_contents($url);
    $havaurl="https://www.havadurumux.net/izmir-hava-durumu/";
    $havaicerik= file_get_contents($havaurl);


    $VeriDizi = getir('<span>','</span>',$icerik);
    $MotorinFiyat= $VeriDizi[8];
    $havaVeriDizi= getir('<span>','</span>',$havaicerik);
    $bugunhava=$havaVeriDizi[0];
    $yarinhava=$havaVeriDizi[3];

    $servername = "localhost";
    $database = "phpcalisma";
    $username = "root";
    $password = "";
    $conn = mysqli_connect($servername, $username, $password, $database);
    mysqli_query($conn,"SET CHARACTER SET 'utf8'");
    mysqli_query($conn,"SET SESSION collation_connection ='utf8_unicode_ci'");

    $sth = mysqli_query($conn,"SELECT subeler.Sube_Ad,count(gonderim.Sube_ID) AS 'gonderim_sayi' FROM gonderim,subeler WHERE subeler.Sube_ID=gonderim.Sube_ID GROUP BY subeler.Sube_Ad");
    $dizi=mysqli_fetch_assoc($sth);
    $sth1 = mysqli_query($conn,"SELECT gonderim.Gonderim_Maliyeti,gonderim.Gonderim_T_Sure,gonderim.Gonderim_Zamani FROM `gonderim`  ORDER BY `gonderim`.`Gonderim_ID`  DESC LIMIT 10");
    $dizi1=mysqli_fetch_assoc($sth1);
    $sth2= mysqli_query($conn,"SELECT concat(araclar.Arac_Marka,' ',araclar.Arac_Model)AS 'arac_isim',COUNT(gonderim.Arac_ID) AS 'gonderim_sayi',round(AVG(gonderim.Gonderim_Maliyeti),2)AS'ortalama_arac_maliyet' FROM `gonderim`,araclar WHERE araclar.Arac_ID=gonderim.Arac_ID GROUP BY araclar.Arac_Marka ");
    $gsorgu=mysqli_query($conn,"SELECT count(gonderim.Gonderim_ID) as 'gonderim_sayisi' FROM `gonderim` ");
    $gdizi=mysqli_fetch_assoc($gsorgu);
    $gsayi=$gdizi["gonderim_sayisi"];
    $bsorgu=mysqli_query($conn,"SELECT count(gonderimsure.Gonderim_Basari) as 'basarili_gonderim_sayisi' FROM gonderim,gonderimsure WHERE gonderim.Gonderim_ID=gonderimsure.Gonderim_ID and gonderimsure.Gonderim_Basari='1' ");
    $bdizi=mysqli_fetch_assoc($bsorgu);
    $bsayi=$bdizi["basarili_gonderim_sayisi"];
    $gboran=(($bsayi/$gsayi)*100);
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <title>Anasayfa/Lojistik Yönetim Sistemi</title>
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">    <!--// Fontawesome Css -->
    <!--// Style-sheets -->

    <!--web-fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Exo:ital,wght@1,300&display=swap" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">

    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);

    function drawChart() {

      // Create our data table out of JSON data loaded from server.
      var data = google.visualization.arrayToDataTable([
            ['Subelere gelen gonderim sayisi', 'Toplam Gonderim sayisi'],
            <?php
                while($row = mysqli_fetch_assoc($sth)){
                    echo "['".$row["Sube_Ad"]."',".$row["gonderim_sayi"]."],";
                }
            ?>
            
                     
        ]);
      var options = {
            title: 'En Çok Gönderim Yapılan Yerler:',
            width: 700,
            height: 400
        };
      // Instantiate and draw our chart, passing in some options.
      // Do not forget to check your div ID
      var chart = new google.visualization.PieChart(document.getElementById('chart_div1'));
      chart.draw(data, options);
    }
    </script>

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
               
                <div class="tarih-maliyet-grafik">
                    <script type="text/javascript">
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawVisualization);

                    function drawVisualization() {
                        // Some raw data (not necessarily accurate)
                        var data = google.visualization.arrayToDataTable([
                        ['Gonderim Zamani','Gonderim suresi(DK)','Maliyet(TL)'],
                        <?php
                            while($row = mysqli_fetch_assoc($sth1)){
                                echo "['".$row["Gonderim_Zamani"]."',".$row["Gonderim_T_Sure"].",".$row["Gonderim_Maliyeti"]."],";
                            }
                        ?>
                        ]);

                        var options = {
                        title : 'Gonderim basina maliyet ve sure grafigi',
                        vAxis: {title: 'Zaman(Dk)-Maliyet(Tl)'},
                        hAxis: {title: 'Gonderim tarihi'},
                        seriesType: 'bars',
                        series: {5: {type: 'line'}}        };

                        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
                        chart.draw(data, options);
                    }
                    </script>
                </div>
                
                    <div id="chart_div" style=" width: 800px; height: 350px;" ></div>
                
                
                
  
                         <!-- Stats -->
                    <div class="outer-w3-agile col-xl">
                        <div class="stat-grid p-3 d-flex align-items-center justify-content-between bg-primary">
                            <div class="s-l">
                                <h5>İZMİR</h5>
                                <p >Opet/Motorin (Eco Force Eurodiesel) TL/LT</p>
                            </div>
                            <div class="s-r">
                                <h6><?php echo $MotorinFiyat?>
                                    <i class="fas fa-gas-pump"></i>
                                </h6>
                            </div>
                        </div>
                        <div class="stat-grid p-3 mt-3 d-flex align-items-center justify-content-between bg-success">
                        <div class="s-l">
                                <h5><?php echo $gsayi?></h5>
                                <p >Aylık Gönderim Sayısı</p>
                            </div>
                            <div class="s-l">
                                <h5><?php echo $bsayi?></h5>
                                <p >Aylık Başarılı Gönderim Sayısı</p>
                            </div>
                            <div class="s-l">
                                <h5><?php echo "%".round($gboran,1) ?></h5>
                                <p >Başarılı Gönderim Oranı</p>
                            </div>
                            <div class="s-r">
                                <i class="fas fa-truck"></i>
                            </div>
                        </div>
                        <div class="stat-grid p-3 mt-3 d-flex align-items-center justify-content-between bg-danger">
                            <div class="s-l">
                                <h5>İzmir Hava Durumu:</h5>
                            </div>
                            <div class="s-l">
                                <h5><?php echo $bugunhava?></h5>
                                <p >Anlık Hava Durumu</p>
                            </div>
                            <div class="s-l">
                                <h5><?php echo $yarinhava?></h5>
                                <p >Yarınki Hava Durumu</p>
                            </div>
                            <div class="s-r">
                                <i class="fas fa-temperature-low"></i>
                            </div>
                        </div>

                    </div>
                    <div id="chart_div1" style="width: 700px; height: 400px; position: relative; top: 20px;"></div>           
                    <div>
                        <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawStuff);

                        function drawStuff() {
                            var data = new google.visualization.arrayToDataTable([
                            ['Araç', 'Toplam Gönderim ', 'Gönderim Başına Ortalama Maliyet'],
                            <?php
                                while($row = mysqli_fetch_assoc($sth2)){
                                    echo "['".$row["arac_isim"]."',".$row["gonderim_sayi"].",".$row["ortalama_arac_maliyet"]."],";
                                }
                            ?>
                            ]);

                            var options = {
                            width: 800,
                            chart: {
                                title: 'Araçların Gönderim ve Ortalam Maliyet Tablosu',
                                subtitle: 'Araçların Gönderim Sayıları ve Gönderim Başına Ortalama Yakıt Maliyetleri'
                            },
                            bars: 'horizontal', // Required for Material Bar Charts.
                            series: {
                                0: { axis: 'distance' }, // Bind series 0 to an axis named 'distance'.
                                1: { axis: 'brightness' } // Bind series 1 to an axis named 'brightness'.
                            },
                            axes: {
                                x: {
                               
                                brightness: {side: 'top', label: 'Yapilan Gonderim Sayisi'} // Top x-axis.
                                }
                            }
                            };

                        var chart = new google.charts.Bar(document.getElementById('dual_x_div'));
                        chart.draw(data, options);
                        };
                        </script>
                    </div>
                   
                    <div id="dual_x_div" style="width: 900px; height: 400px;   float: right; position: relative; left: 100px; top: -390px"></div>

                  



                

           
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