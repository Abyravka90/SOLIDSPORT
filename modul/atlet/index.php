<?php
@session_start();
if (!isset($_SESSION['username'])) {
    @header("location:../login");
} else {
    include "../../config/templates/header.php";
    include "../../config/templates/sidebar.php";
    include "../../config/templates/mainContent.php";
    include "../../config/database/koneksi.php";
    //jika tombol update ditekan
    if (isset($_POST['update'])) {
        $idAtlet = $_POST['idAtlet'];
        $namaAtlet = $_POST['namaAtlet'];
        $namaKata = $_POST['namaKata'];
        $kontingen = $_POST['kontingen'];
        $grup = $_POST['grup'];
        $atribut = $_POST['atribut'];
        $kelas = $_POST['kelas'];
        foreach ($idAtlet as $key => $val) {
            $sql = "UPDATE atlet SET namaAtlet = '$namaAtlet[$key]', namaKata = '$namaKata[$key]', kontingen = '$kontingen[$key]',
            grup = '$grup[$key]', atribut = '$atribut[$key]', kelas = '$kelas[$key]' WHERE idAtlet = $idAtlet[$key];";
            $sukses = mysqli_query($conn, $sql);
        }
    }
    //jika tombol hapus ditekan
    if (isset($_GET['idAtlet'])) {
        $idAtlet = $_GET['idAtlet'];
        mysqli_query($conn, "DELETE FROM atlet WHERE idAtlet = '$idAtlet'");
    }

    //jika tombol reset data ditekan
    if (isset($_GET['reset'])) {
        $reset = $_GET['reset'];
        if ($reset == '6512bd43d9caa6e02c990b0a82652dca') {
            mysqli_query($conn, "DELETE FROM atlet");
            mysqli_query($conn, "ALTER TABLE atlet auto_increment=0");
        }
    }

?>

    <!--disini blok jika session berjalan nya-->
    <div class="card-header border-0">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-icon"><i class="ni ni-notification-70"></i></span>
            <span class="alert-text"><strong>Welcome <?= $_SESSION['username']; ?> </strong>&nbsp;periksa kembali data anda</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    </div>
    <!-- Se table -->
    <div class="card-body">
        <div class="col-md-12">
            <form action="#" method="POST" enctype="multipart/form-data">
                <table table id="example" class="table table-striped table-bordered nowrap" cellspacing="0" width="120%">
                    <thead class="thead-light">
                        <tr>
                            <th>Delete</th>
                            <th>No</th>
                            <th>Nama Atlet</th>
                            <th>Nama Kata</th>
                            <th>Kontingen</th>
                            <th style="width:100px;">Grup</th>
                            <th>Atribut</th>
                            <th>Bermain</th>
                            <th>Kelas</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php
                        $i = 1;
                        $sql = mysqli_query($conn, "SELECT * FROM atlet");
                        while ($data = mysqli_fetch_array($sql)) {
                        ?>
                            <tr>
                                <td><a class="btn btn-danger" href="?idAtlet=<?= $data['idAtlet'] ?>"><i class="fas fa-trash"></i></a></td>
                                <td><?= $i ?></td>
                                <td><textarea class="form-control" name="namaAtlet[]" id="" cols="10" rows="3"><?= $data['namaAtlet']; ?></textarea></td>
                                <td><input type="text" class="form-control awesomplete" name="namaKata[]" id="kata" cols="10" rows="3" value="<?= $data['namaKata']; ?>"></td>
                                <td><textarea class="form-control" name="kontingen[]" id="" cols="10" rows="3"><?= $data['kontingen']; ?></textarea></td>
                                <td>
                                    <input class="form-control" type="text" name="grup[]" value="<?= $data['grup'] ?>">
                                </td>
                                <td>
                                    <select class="form-control" name="atribut[]">
                                        <option value="Aka" <?php if ($data['atribut'] == "Aka") {
                                                                echo "selected";
                                                            } ?>><span class="badge badge-default"> Aka</span></option>
                                        <option value="Ao" <?php if ($data['atribut'] == "Ao") {
                                                                echo "selected";
                                                            } ?>><span class="badge badge-danger">Ao</span></option>
                                    </select>
                                </td>
                                <td><?= $data['bermain']; ?></td>
                                <td><textarea class="form-control" name="kelas[]" id="" cols="10" rows="3"><?= $data['kelas']; ?></textarea></td>
                                <input type="hidden" name="idAtlet[]" value=<?= $data['idAtlet']; ?>>
                            </tr>
                        <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
                <div class="pl-3">
                    <input type="submit" class="btn btn-warning" name="update" value="Ubah data"></input>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmResetModal">
                        Reset atlet
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
                                    Apakah anda yakin menghapus semua data atlet
                                </div>
                                <div class="modal-footer">
                                    <a href="?reset=<?= md5(11) ?>" class="btn btn-danger">ya</a>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php
}
include "../../config/templates/footer.php";
?>
</body>
<script>
    const input = document.querySelectorAll("[id='kata']");
    for(var i = 0; i < input.length; i++) {
        const awesomplete = new Awesomplete(input[i], {
            minChars: 1
        })
        awesomplete.list = ["ANAN"  ,   "JIIN"  ,   "PASSAI" ,
            "ANAN DAI"  ,   "JION"  ,   "PINAN SHODAN",
            "ANANKO"    ,   "JITTE" ,   "PINAN NIDAN",
            "AOYAGI"    ,   "JYUROKU"   ,   "PINAN SANDAN",
            "BASSAI"    ,   "KANCHIN"   ,   "PINAN YONDAN",
            "BASSAI DAI",   "KANKU DAI" ,   "PINAN GODAN",
            "BASSAI SHO"    ,   "KANKU SHO" ,   "ROHAI",
            "CHATANYARA KUSHANKU"   ,   "KANSHU"    ,   "SAIFA",
            "CHIBANA NO KUSHANKU"   ,   "KISHIMOTO NO KUSHANKU" ,   "SANCHIN",
            "CHINTE"    ,   "KOSOUKUN"  ,   "SANSAI",
            "CHINTO"    ,   "KOSOUKUN DAI"  ,   "SANSEIRU",
            "ENPI"  ,   "KOSOUKUN  SHO" ,   "SANSERU",
            "FUKYGATA ICHI" ,   "KURURUNFA" ,   "SEICHAN",
            "FUKYGATA NI"   ,   "KUSANKU",      "SEIENCHIN (SEIYUNCHIN)",
            "GANKAKU",      "KYAN NO CHINTO",       "SEIPAI",
            "GARYU" ,   "KYAN NO WANSHU",       "SEIRYU",
            "GEKISAI (GEKSAI) ICH",     "MATSUKAZE" ,   "SEISHAN",
            "GEKISAI (GEKSAI) NI"   ,   "MATSUMURA BASSAI",     "SEISAN (SESAN)",
            "GOJUSHIHO" ,   "MATSUMURA ROHAI"   ,   "SHIHO KOUSOUKUN",
            "GOJUSHIHO DAI" ,   "MEIKYO"    ,   "SHINPA",
            "GOJUSHIHO SHO" ,   "MYOJO" ,   "SHINSEI",
            "HAKUCHO"   ,   "NAIFANCHIN SHODAN" ,   "SHISOCHIN",
            "HANGETSU"  ,   "NAIFANCHIN NIDAN"  ,   "SOCHIN",
            "HAUFA (HAFFA)" ,   "NAIFANCHIN SANDAN" ,   "SUPARINPEI",
            "HEIAN SHODAN"  ,   "NAIHANCHIN",       "TEKKI SHODAN",
            "HEIAN NIDAN"   ,   "NIJUSHIHO" ,   "TEKKI NIDAN",
            "HEIAN SANDAN"  ,   "NIPAIPO",      "TEKKI SANDAN",
            "HEIAN YONDAN",     "NISEISHI",     "TENSHO",
            "HEIAN GODAN",      "OHAN",     "TOMARI BASSAI",
            "HEIKU",        "OHAN DAI",     "UNSHU",
            "ISHIMINE BASSAI",      "OYADOMARI NO PASSAI",      "UNSU",
            "ITOSU ROHAI SHODAN",       "PACHU" ,   "USEISHI",
            "ITOSU ROHAI NIDAN" ,   "PAIKU",        "WANKAN",
            "ITOSU ROHAI SANDAN",       "PAPUREN",      "WANSHU",

        ];
        awesomplete.evaluate();
        
    }
</script>
</html>
