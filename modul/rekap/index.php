<?php
@session_start();
if (!isset($_SESSION['username'])) {
    @header("location:../login");
} else{
    include "../../config/templates/header.php";
    include "../../config/templates/sidebar.php";
    include "../../config/templates/mainContent.php";
    include "../../config/database/koneksi.php";
    //JIKA TOMBOL RESET DITEKAN
    if(isset ($_GET['reset'])){
        $reset = $_GET['reset'];
        if($reset == 1){
            mysqli_query($conn, 'TRUNCATE TABLE rekap');
            mysqli_query($conn, 'ALTER TABLE `rekap` auto_increment = 0');
        }
    }
    ?>
    
    <!-- Card header -->
    <!-- Se table -->
    <link rel="stylesheet" href="../../assets/css/buttons.dataTables.min.css" type="text/css">
    <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12 mt-3">
        <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Grup</th>
                <th>bermain</th>
                <th>Nama Atlet</th>
                <th>Kontingen</th>
                <th>TEC-J1</th>
                <th>TEC-J2</th>
                <th>TEC-J3</th>
                <th>TEC-J4</th>
                <th>TEC-J5</th>
                <th>ATH-J1</th>
                <th>ATH-J2</th>
                <th>ATH-J3</th>
                <th>ATH-J4</th>
                <th>ATH-J5</th>
                <th>TOTAL POINT</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $i = 1;
        //TAMPILKAN DATA DARI TABEL REKAP
        $sqlRekap = "SELECT * FROM `atlet` join `rekap` WHERE rekap.idAtlet = atlet.idAtlet";
        $result = mysqli_query($conn, $sqlRekap);
        while ($data = mysqli_fetch_object($result)){?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $data -> grup ?></td>
                <td><?= $data -> bermain ?></td>
                <td><?= $data -> namaAtlet ?></td>
                <td><?= $data -> kontingen ?></td>
                <td><?= $data -> T1 ?></td>
                <td><?= $data -> T2 ?></td>
                <td><?= $data -> T3 ?></td>
                <td><?= $data -> T4 ?></td>
                <td><?= $data -> T5 ?></td>
                <td><?= $data -> A1 ?></td>
                <td><?= $data -> A2 ?></td>
                <td><?= $data -> A3 ?></td>
                <td><?= $data -> A4 ?></td>
                <td><?= $data -> A5 ?></td>
                <td><?= number_format($data -> totalPoint, 2) ?></td>
            </tr>
        <?php
        $i++;
        }
        ?>
        </tbody>
        </table>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmResetModal">
                        Reset Rekap
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="confirmResetModal" tabindex="-1" role="dialog" aria-labelledby="confirmResetModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Reset Data</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah anda yakin menghapus semua data rekap
                                </div>
                                <div class="modal-footer">
                                    <a href="?reset=1" class="btn btn-danger">ya</a>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
        </div>
    </div>
    <br />
    <!-- Footer -->
    <?php
    include "../../config/templates/footer.php";
    ?>
    <script>
  $(document).ready(function() {
    $('#example1').DataTable({
      
      "scrollX": true,
      "language": {
        "paginate": {
          "previous": "&#8636;",
          "next": "&#8641;"
        }
      },

      dom : 'Bfrtip',
        buttons : [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]

    });
  });
</script>
    </body>
    
    </html>
<?php } ?>
