<!-- CSS only -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"  
integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<?php

    //konfigurasi database
    $host       = "localhost";
    $user       = "root";
    $password   = "";
    $database = "iot";
    

    $koneksi = mysqli_connect($host, $user, $password, $database); // menggunakan mysqli_connect
 
	if(mysqli_connect_errno()){ // mengecek apakah koneksi database error
		echo 'Gagal melakukan koneksi ke Database : '.mysqli_connect_error(); // pesan ketika koneksi database error
	}

?>

    <center>
    <h2>DATA SUHU</h2>
    </center>

    <table border="1" class="table table-striped">
        <thead class="thead-dark">
            <tr><th>TANGGAL</th><th> SUHU </th> <th>KETERANGAN</th></tr>
        </thead>
            <?php
            $data = mysqli_query($koneksi, "SELECT * from suhu");
            $no=1;
            foreach ($data as $row){
                echo "<tr>";
            if ($row['suhu'] > 30) 
            $ket="PANAS"; 
                else $ket="NORMAL";
            echo "
                    <td>".$row['jam']."</td> 
                    <td>".$row['suhu']."</td> 
                    <td>".$ket."</td> 
                    </tr>";
                $no++;

            $jamx[]=@$row['jam'];
            $suhux[]=@$row['suhu'];
            }

            $jam_json=json_encode($jamx);
            $suhu_json=json_encode($suhux);

        ?>
    </table>

    <div>
        <canvas id="myChart"></canvas>
    </div> -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
            labels: <?=$jam_json;?>,
                datasets: [{
                    label: '#SUHU',
            data: <?=$suhu_json;?>,
                    borderWidth: 1
                }]
            },
            options:{
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>