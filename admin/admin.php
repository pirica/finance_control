<?php require_once("inc/header.php");?>
<body id="admin_home">

<div id="mySidebar" class="sidebar shadow">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <a href="dashboard-main.php" target="myAdmFrame"> Início </a>
  <a href="users.php" target="myAdmFrame"><i class="fa-solid fa-user-group"></i> Usuários</a>
  <a href="#" target="myAdmFrame"><i class="fa-solid fa-comments"></i> Popups</a>
  <a href="#" target="myAdmFrame"><i class="fa-solid fa-circle-exclamation"></i> Notificações Users</a>
  <a href="#" target="myAdmFrame"><i class="fa-solid fa-square-poll-vertical"></i> Finanças Rank</a>
  <a href="<?= $BASE_URL ?>logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Sair</a>
</div>

<div id="main">
  <button class="openbtn" onclick="openNav()">☰</button>
  <iframe src="dashboard-main.php" name="myAdmFrame" id="myAdmFrame" fullscreen="allow" frameborder="0" width="100%"></iframe>
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