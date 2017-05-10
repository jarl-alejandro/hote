  <style>
  .Layout{width: 97%}
  </style>
  <section>
    <article class="table-kardex"></article>
    <article class="form-kardex u-none"></article>
  </section>
  <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a class="btn-floating btn-large red">
      <i class="large material-icons">attach_file</i>
    </a>
    <ul>
      <li><a class="btn-floating yellow darken-1 tooltipped" data-position="left" data-delay="50" data-tooltip="Reporte General" id="reporteGeneral"><i class="material-icons">picture_as_pdf</i></a></li>
    </ul>
  </div>
  <?php include 'partials/alert-ingresar.php'; ?>
  <script>
    $.getScript("kardex/static/js/componente.js")
  </script>
