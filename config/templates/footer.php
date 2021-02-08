<footer class="footer pt-0">
  <div class="row align-items-center justify-content-lg-between">
    <div class="col-lg-6">
      <div class="copyright text-center  text-lg-right  text-muted">
        &copy; 2020 <a href="#" class="font-weight-bold ml-1">Solidsports-Organizer</a>
      </div>
    </div>
  </div>
</footer>
</div>
</div>

<!-- Core -->
<script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../../assets/vendor/js-cookie/js.cookie.js"></script>
<!-- data tables-->
<script src="../../assets/js/jquery-3.5.1.js"></script>
<script src="../../assets/js/jquery.dataTables.min.js"></script>
<script src="../../assets/js/dataTables.bootstrap4.min.js"></script>
<script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/argon.min.js"></script>
<script src="../../assets/js/awesomplete.js"></script>
<!-- <script src="https://cdn.rawgit.com/LeaVerou/awesomplete/gh-pages/awesomplete.min.js"></script> -->

<script>
  $(document).ready(function() {
    $('#example').DataTable({
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