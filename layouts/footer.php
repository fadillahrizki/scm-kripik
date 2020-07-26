	</div>
    </section>
    <!-- /.content -->
	</div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.5
    </div>
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= $current == "dashboard" || $current == "login" ? "plugins/jquery/jquery.min.js" : "../plugins/jquery/jquery.min.js" ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= $current == "dashboard" || $current == "login" ? "plugins/jquery-ui/jquery-ui.min.js" : "../plugins/jquery-ui/jquery-ui.min.js" ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= $current == "dashboard" || $current == "login" ? "plugins/bootstrap/js/bootstrap.bundle.min.js" : "../plugins/bootstrap/js/bootstrap.bundle.min.js" ?>"></script>
<!-- ChartJS -->
<script src="<?= $current == "dashboard" || $current == "login" ? "plugins/chart.js/Chart.min.js" : "../plugins/chart.js/Chart.min.js" ?>"></script>
<!-- Sparkline -->
<script src="<?= $current == "dashboard" || $current == "login" ? "plugins/sparklines/sparkline.js" : "../plugins/sparklines/sparkline.js" ?>"></script>
<!-- JQVMap -->
<script src="<?= $current == "dashboard" || $current == "login" ? "plugins/jqvmap/jquery.vmap.min.js" : "../plugins/jqvmap/jquery.vmap.min.js" ?>"></script>
<script src="<?= $current == "dashboard" || $current == "login" ? "plugins/jqvmap/maps/jquery.vmap.usa.js" : "../plugins/jqvmap/maps/jquery.vmap.usa.js" ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?= $current == "dashboard" || $current == "login" ? "plugins/jquery-knob/jquery.knob.min.js" : "../plugins/jquery-knob/jquery.knob.min.js" ?>"></script>
<!-- daterangepicker -->
<script src="<?= $current == "dashboard" || $current == "login" ? "plugins/moment/moment.min.js" : "../plugins/moment/moment.min.js" ?>"></script>
<script src="<?= $current == "dashboard" || $current == "login" ? "plugins/daterangepicker/daterangepicker.js" : "../plugins/daterangepicker/daterangepicker.js" ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= $current == "dashboard" || $current == "login" ? "plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js" : "../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js" ?>"></script>
<!-- Summernote -->
<script src="<?= $current == "dashboard" || $current == "login" ? "plugins/summernote/summernote-bs4.min.js" : "../plugins/summernote/summernote-bs4.min.js" ?>"></script>
<!-- overlayScrollbars -->
<script src="<?= $current == "dashboard" || $current == "login" ? "plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js" : "../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js" ?>"></script>
<!-- AdminLTE App -->
<script src="<?= $current == "dashboard" || $current == "login" ? "dist/js/adminlte.js" : "../dist/js/adminlte.js" ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= $current == "dashboard" || $current == "login" ? "dist/js/pages/dashboard.js" : "../dist/js/pages/dashboard.js" ?>"></script>

<!-- DataTables -->
<script src="<?= $current == "dashboard" || $current == "login" ? "plugins/datatables/jquery.dataTables.min.js" : "../plugins/datatables/jquery.dataTables.min.js" ?>"></script>
<script src="<?= $current == "dashboard" || $current == "login" ? "plugins/datatables-bs4/js/dataTables.bootstrap4.min.js" : "../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js" ?>"></script>
<script src="<?= $current == "dashboard" || $current == "login" ? "plugins/datatables-responsive/js/dataTables.responsive.min.js" : "../plugins/datatables-responsive/js/dataTables.responsive.min.js" ?>"></script>
<script src="<?= $current == "dashboard" || $current == "login" ? "plugins/datatables-responsive/js/responsive.bootstrap4.min.js" : "../plugins/datatables-responsive/js/responsive.bootstrap4.min.js" ?>"></script>

<script>

$('.table').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

</script>

</body>
</html>
