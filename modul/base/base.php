<?php
@session_start();
if (!isset($_SESSION['username'])) {
    @header("location:../login");
} else{
    include "../../config/templates/header.php";
    include "../../config/templates/sidebar.php";
    include "../../config/templates/mainContent.php";
    include "../../config/database/koneksi.php";
    ?>    
    <!-- Card header -->
    <!-- Se table -->
    <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12 mt-3">
        <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
            </tr>
        </tbody>
        </table>
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
      }
    });
  });
</script>
    </body>
    
    </html>
<?php } ?>
