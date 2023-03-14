
// Função que mostra div de qual tipo de despesa e categoria
function show_expense() {
  var div_expense = document.getElementById("expense"); // Pega id da div que está oculta
  var div_category = document.getElementById("category_div");
  var entry = document.getElementById("entry");
  var fixa = document.getElementById("fixa");
  var variavel = document.getElementById("variavel");
  var category = document.getElementById("category");


  if (entry.checked) {
    div_expense.style.display = "none";
    div_category.style.display = "none";

    fixa.disabled = true;
    fixa.checked = false;
    variavel.disabled = true;
    variavel.checked = false;
    category.disabled = true;
    
  } else if (out.checked) {
    div_expense.style.display = "block";
    div_category.style.display = "block";
    fixa.disabled = false;
    variavel.disabled = false;
    category.disabled = false;
    // expense_type.required = true;
  }
}
