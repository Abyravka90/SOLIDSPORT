<?php 
@session_start();
if(!isset($_SESSION['username'])){
    @header("location:../login");
}else{
    include "../../config/templates/header.php";
    include "../../config/templates/sidebar.php";
    include "../../config/templates/mainContent.php";
?>
    <!--disini blok jika session berjalan nya-->
    <!-- Card header -->
                    <div class="card-header border-0">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-icon"><i class="ni ni-notification-70"></i></span>
                            <span class="alert-text"><strong>Welcome <?= $_SESSION['username']; ?> </strong>&nbsp;periksa kembali data anda</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                  <h1 class="mb-0">Data Atlet</h1>
                </div>
            <!-- Se table -->
            <div class="card-body">
            <div class="col-md-12">
            <form action="">
                    <table table id="example" class="table table-striped table-bordered nowrap" cellspacing="0" width="1700px">
                        <thead class="thead-light">
                            <tr>
                                <th style="width:50px;"></th>
                                <th style="width:50px;">No</th>
                                <th style="width:200px;">Nama Atlet</th>
                                <th>Atribut</th>
                                <th style="width:200px;">Nama Kata</th>
                                <th style="width:120px;">Kontingen</th>
                                <th style="width:110px;">Grup</th>
                                <th>Bermain</th>
                                <th style="width:100px;">Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="checkbox" name="#" id="#"></td>
                                <td>1</td>
                                <td><input type="text" class="form-control" name="" id="" value="Galuh Najla"></td>
                                <td>
                                    <select class="form-control" name="" id="">
                                        <option value="A" selected><span class="badge badge-default"> Ao </span></option>
                                        <option value="A1" ><span class="badge badge-danger">Aka</span></option>
                                    </select>
                                </td>
                                
                                <td><input type="text" class="form-control" name="" id="" value="Popuren"></td>
                                <td><input type="text" class="form-control" name="" id="" value="Citra Indah"></td>
                                <td>
                                    <select class="form-control" name="" id="">
                                        <option value="A" selected>A</option>
                                        <option value="A1" >A1</option>
                                    </select>
                                </td>
                                <td>sudah</td>
                                <td><input type="text" class="form-control" name="" id="" value="Kadet Putri"></td>
                            </tr>
                        </tbody>
                    </table>
                <div class="pl-3">
                    <button type="submit" class="btn btn-primary" >simpan</button>
                </div>
                </form>
            </div> 
            </div>
<?php
    } 
    include "../../config/templates/footer.php";
?>
</body>
</html>