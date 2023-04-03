// Função que mostra div de qual tipo de despesa e categoria
function show_expense() {
    var div_expense = document.getElementById("expense"); // Pega id da div que está oculta
    var div_category = document.getElementById("category_div");
    var entry = document.getElementById("entry");
    var fixa = document.getElementById("fixa");
    var variavel = document.getElementById("variavel");
    var category_div_entry = document.getElementById("category_div_entry");
    var category_entry = document.getElementById("category_entry");
    var category_exit = document.getElementById("category_exit");


    if (entry.checked) {
        div_expense.style.display = "none";
        div_category.style.display = "none";

        category_div_entry.style.display = "block";
        fixa.disabled = true;
        fixa.checked = false;
        variavel.disabled = true;
        variavel.checked = false;
        category_entry.disabled = false;
        category_exit.disabled = true;

    } else if (out.checked) {
        div_expense.style.display = "block";
        div_category.style.display = "block";
        category_div_entry.style.display = "none";
        fixa.disabled = false;
        variavel.disabled = false;
        category_entry.disabled = true;
        category_exit.disabled = false;
    }
}

// Função que abre o tooltip de observação dos relatórios
function openTooltip(i) {
    // Mostrar tooltip
    $("#grupos" + i).click(function() {
        $("#tooltip_" + i).show();
    });

    // fechar tooltip
    $("#close" + i).click(function() {
        $("#tooltip_" + i).hide();
    });

    $(document).mouseup(function(e) {
        if ($(e.target).closest(".tooltip_" + i).length === 0) {
            $("#tooltip_" + i).hide();
        }
    });
}

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