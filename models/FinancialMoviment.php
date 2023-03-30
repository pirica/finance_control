<?php 

Class FinancialMoviment {

    public $id;
    public $description;
    public $obs;
    public $value;
    public $type;
    public $expense;
    public $category;
    public $create_at;
    public $update_at;
    public $users_id;

}

interface FinancialMovimentDAOInterface {
    public function buildFinancialMoviment($data); // Contrói o objeto
    public function findAll(); // traz todas as movimentações financeiras
    public function getLatestFinancialMoviment($id); // Traz as últimas movimentações financeiras
    public function getAllOutFinancialMoviment($id); // Traz todas Saídas de movimentações financeiras
    public function getAllEntryFinancialMoviment($id); // Traz todas Saídas de movimentações financeiras
    public function getAllCashInflow($id); // traz a soma de todas as entradas dashboard
    public function getHighValueIncome($id); // traz a maior receita do mês
    public function getLowerValueIncome($id); // traz a menor receita do mês
    public function getAllCashOutflow($id); // traz a soma de todas as saídas dashboard
    public function getBiggestExpense($id); // traz a maior receita do mês
    public function getLowerExpense($id); // traz a menor receita do mês
    public function getTotalBalance($id); // traz balanço total entre entradas e saídas
    public function getReports($sql, $type, $id); // traz todas as entradas por mês relatório
    // public function getCashOutflowReport($monthy); // traz todas as saídas por mês relatório
    public function getCashInflowbyMonths ($id); // traz todas as entradas de cada mês até o mes vigente alimentando o gráfico
    public function getCashOutflowbyMonths ($id); // traz todas as entradas de cada mês até o mes vigente alimentando o gráfico
    public function findById($id); // traz uma movimentação especifica através do ID
    public function create(FinancialMoviment $financialMoviment); // Insere a movimentação financeira no BD
    public function update(FinancialMoviment $financialMoviment); // Atualiza a movimentação financeira no BD
    public function destroy($id); // deleta uma movimentação financeira especifica no BD através do ID
}