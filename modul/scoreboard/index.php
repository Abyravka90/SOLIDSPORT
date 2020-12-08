<?php 
    include "$_SERVER[DOCUMENT_ROOT]/config/templates/header.php";
    include "$_SERVER[DOCUMENT_ROOT]/config/templates/sidebar.php";
    include "$_SERVER[DOCUMENT_ROOT]/config/templates/mainContent.php";
?>
            <!-- Card header -->
                <div class="card-header border-0">
                  <h3 class="mb-0">Papan Score</h3>
                </div>
            <!-- Se table -->
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tiger Nixon</td>
                    </tr>
                </tbody>
                </table>
                <!-- Footer -->
<?php 
    include "$_SERVER[DOCUMENT_ROOT]/config/templates/footer.php";
?>
</body>
</html>