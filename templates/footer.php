<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/showtime.js" type="text/javascript" async></script>
<script src="js/easy-number-separator.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.mask.js"></script>
<script src="js/functions.js"></script>

<script>
    // Abrir submenu
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
        });
    });

    // Fomartação de valores monetarios com ','
    easyNumberSeparator({
        selector: '.number-separator',
    })
</script>
</body>

</html>