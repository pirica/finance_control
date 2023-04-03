<html>
<head>
<!-- não esqueça de adicionar os js do jquery e do pluging !-->
<script src="js/jquery.min.js"></script>
<script src="js/jquery.mask.js"></script>
</head>
<body>
   <form>
      <input type="text"  class="money"/><br>
   </form>

<script>
    $(document).ready(function(){
    $('input').mask('000.000.000.000.000,00', {reverse: true});
    });
</script>
</body>
</html>