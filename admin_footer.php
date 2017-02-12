<style type="text/css">
    .footer {
  position:absolute;
  bottom: 0;
    width:100%;    
  /* Set the fixed height of the footer here */
  background-color: #f5f5f5;    
}
</style>

</body>
<div class="container-fluid">
    <footer style="text-align:center;" class="footer fixed-bottom">Copyright &copy; 2016-2017 All rights reserved.For any queries contact:<code>f2015010@goa.bits-pilani.ac.in</code></footer>
</div>
</html>
<script language = "javascript">
    function logout() {
    $.post("<?php echo $_SERVER['PHP_SELF'];?>",{name : "logout"});
    }
</script>