<?php require_once("inc/header.php"); ?>
<body id="admin_home">

<div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <a href="#">Usuários</a>
  <a href="#">Popups</a>
  <a href="#">Melhores Finanças</a>
</div>

<div id="main">
  <button class="openbtn" onclick="openNav()">☰</button>
  <h1>Iframe Aqui</h1>
</div>

<script>
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>
   
</body>
</html> 