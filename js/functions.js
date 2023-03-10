
// Function to 
function show_expense() {
  var div_expense = document.getElementById("expense"); // Pega id da div que está oculta
  var entry = document.getElementById("entry");
  var out = document.getElementById("out");
  var fixa = document.getElementById("fixa");
  var variavel = document.getElementById("variavel");
  var expense_type = document.querySelector('input[name = "expense_type"]'); 

  if (entry.checked) {
    div_expense.style.display = "none";
    // expense_type.required = false;

    fixa.disabled = true;
    fixa.checked = false;
    variavel.disabled = true;
    variavel.checked = false;
    
  } else if (out.checked) {
    div_expense.style.display = "block";
    fixa.disabled = false;
    variavel.disabled = false;
    // expense_type.required = true;
  }
}
