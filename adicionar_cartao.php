<?php
require_once("templates/header_iframe.php");

// // 1. Create CSRF Token
// $token = md5(uniqid(mt_rand(), true));
// $_SESSION["csrf_token"] = $token;

// print_r($_SESSION);

// // 2. Adding CSRF Token to Form

// // Validating CSRF Token

?>

<div class="container-fluid">
    <h1 class="text-center my-5 text-secondary">Adicionar Cartão de Crédito</h1>
    <div class="actions p-5 mb-4 bg-light rounded-3 shadow-sm">
        <form action="<?= $BASE_URL ?>cards_process.php" method="POST">
            <!-- <input type="hidden" name="csrf_token" value="<?= $token ?>"> -->
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <h4 class="font-weight-normal">Titular do Cartão:</h4>
                        <input type="text" name="name_card" id="name_card" class="form-control" placeholder="Insira o nome como está no cartão">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <h4 class="font-weight-normal">Numero do Cartão:</h4>
                        <input type="tel" name="cc" id="cc" class="form-control" maxlength="19" placeholder="1234 5678 9876 5432">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <h4 class="font-weight-normal">Validade:</h4>
                        <input type="date" name="expired_card" id="expired_card" class="form-control">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <h4 class="font-weight-normal">Limite do Cartão:</h4>
                        <input type="text" name="credit_value" id="credit_value" class="form-control number-separator" placeholder="4.000">
                    </div>
                </div>
                <div class="col-md-1">
                    <input type="submit" class="btn btn-lg btn-success" value="Adicionar"></input>
                </div>
            </div>
        </form>
    </div>

    <!-- Card contaider auto fill -->
    <div class="card_example" id="cards-page">
        <div class="offset-md-4 col-md-4">
            <div class="card-credit bg-secondary" id="card-credit-bg">
                <div class="visa_logo">
                    <i class="text-light" id="flag_icon"></i>
                </div>
                <div class="visa_info">
                    <img src="<?= $BASE_URL ?>assets/home/dashboard-main/chip.png" alt="">
                    <p id="card_number">4586 7985 9271 6388</p>
                </div>
                
                <div class="visa_crinfo">
                    <p id="card_name">João Silva Costa</p>                  
                    
                    <div class="form-group">
                        <small class="text-light">Expira</small>
                        <p id="expired_date">05/23</p>
                    </div>
                </div>
            </div>
            <!-- <div class="text-center my-2">
                <a href="#" data-toggle="modal" data-target="#exampleModalCenter" title="Editar">
                    <i class="fa-solid fa-file-pen"></i>
                </a>
                <a href="#" data-toggle="modal" data-target="#modal_del_finance_moviment" title="Deletar">
                    <i class="fa-solid fa-trash-can"></i>
                </a>
            </div> -->
        </div>
    </div>
     <!-- Card contaider auto fill -->


</div>
<?php require_once("templates/footer.php"); ?>

<script type="text/javascript">
    /* Máscaras ER CC ex: 4321 5678 ...  */
    function mascara(o, f) {
        v_obj = o
        v_fun = f
        setTimeout("execmascara()", 1)
    }

    function execmascara() {
        v_obj.value = v_fun(v_obj.value)
    }

    function mcc(v) {
        v = v.replace(/\D/g, "");
        v = v.replace(/^(\d{4})(\d)/g, "$1 $2");
        v = v.replace(/^(\d{4})\s(\d{4})(\d)/g, "$1 $2 $3");
        v = v.replace(/^(\d{4})\s(\d{4})\s(\d{4})(\d)/g, "$1 $2 $3 $4");
        return v;
    }

    function id(el) {
        return document.getElementById(el);
    }
    window.onload = function() {
        id('cc').onkeypress = function() {
            mascara(this, mcc);
        }
    }
     /* Máscaras ER */


    // Imput nome do cartão aceitará apenas letras
    $("#name_card").on("input", function() {
        var regexp = /[^a-zA-Z]/g;
        if (this.value.match(regexp)) {
            $(this).val(this.value.replace(regexp, ' '));
        }
    });


    // Auto Preenchimento do cartão exemplo e identificação da bandeira do cartão
    $(document).ready(function(){

        $("input").keyup(function (){
            var card_name = $("#name_card").val();
            var account = $("#cc").val();
            var flag_number = account.substr(0, 1);

            $("#card_number").html(account);
            $("#card_name").html(card_name);
            
            
            if (flag_number == 4) {
                $( "#card-credit-bg" ).removeClass( "master-card" );
                $("#flag_icon").removeClass( "fa-brands fa-cc-mastercard fa-3x ");
                $("#flag_icon").addClass("fa-brands fa-cc-visa fa-3x ");
                $("#card-credit-bg").last().addClass("visa");
            }else if(flag_number == 5){
                $( "#card-credit-bg" ).removeClass( "visa" );
                $("#flag_icon").removeClass( "fa-brands fa-cc-visa fa-3x");
                $("#flag_icon").addClass("fa-brands fa-cc-mastercard fa-3x ");
                $("#card-credit-bg").last().addClass("master-card");
            }
            
            if( account == "") {
                //console.log("entrou no if");
                $( "#card-credit-bg" ).removeClass("master-card visa");
                $( "#flag_icon" ).removeClass("fa-brands fa-cc-mastercard fa-cc-visa fa-3x");

                var nome_ex = "Joao Silva Costa";
                var num_ex = "1234 5678 9876 5432";
                if(card_name == "") {
                    $("#card_number").append(num_ex);
                    $("#card_name").append(nome_ex);
                }
            }
            
        });

        $("input").click(function (){
            var expired_card = $("#expired_card").val();
            
            $("#expired_date").html(expired_card);
         });

    });

</script>
