<footer class="footer pt-0">
  <div class="row align-items-center justify-content-lg-between">
    <div class="col-lg-6">
      <div class="copyright text-center  text-lg-right  text-muted">
        &copy; 2021 <a href="#" class="font-weight-bold ml-1">Solidsports-Organizer</a>
      </div>
    </div>
  </div>
</footer>
</div>
</div>
<!-- Sweet Alert -->
<script src="../../assets/js/sweetalert2.min.js"></script>
    
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

<script src="../../assets/js/dataTables.buttons.min.js"></script>
<script src="../../assets/js/jszip.min.js"></script>
<script src="../../assets/js/pdfmake.min.js"></script>
<script src="../../assets/js/vfs_fonts.js"></script>
<script src="../../assets/js/buttons.html5.min.js"></script>

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

  

  function checkMatchStatus() {
      const getProp = decodeURI(window.location.search)
      .replace('?', '')
      .split('&')
      .map(param => param.split('='))
      .reduce((values, [ key, value ]) => {
          values[ key ] = value
          return values
      }, {})

      return getProp;
  }

  const isPlay = checkMatchStatus();

  if(isPlay.idAtlet) {
      const {idAtlet} = isPlay;
      console.log("masuk gag", idAtlet)
      $(`#btn-stop-${idAtlet}`).prop("disabled", false);
      $(`#btn-stop-${idAtlet}`).prop("disabled", false);
      $(`#btn-reset-${idAtlet}`).prop("disabled", false);
  } else {

      const buttonPlay = $('[id^="btn-play"]');
      const buttonStop = $('[id^="btn-stop"]');
      const buttonReset = $('[id^="btn-reset"]');
      console.log(buttonPlay)
      for(let i in buttonStop) {
          buttonPlay[i].disabled = false;
          buttonStop[i].disabled = false;
          buttonReset[i].disabled = false;
      }
  }

  function handleURL(url) {
      console.log(url)
      window.location.href = url;
  }
</script>