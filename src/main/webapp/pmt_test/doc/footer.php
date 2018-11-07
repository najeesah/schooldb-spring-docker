<!-- jQuery -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.qtip.min.js"></script>
<script src="js/jquery.imagesloaded.pkg.min.js"></script>
<!-- Menu Toggle Script -->
<script>
  $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
  });
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>
