<?php 

Class FinancialMoviment {

    public $id;
    public $description;
    public $value;
    public $type;
    public $expense;
    public $create_at;
    public $update_at;
    public $users_id;

}

interface FinancialMovimentDAOInterface {
    public function buildFinancialMoviment($data); // Contrói o objeto
    public function findAll(); // traz todas as movimentações financeiras
    public function getLatestFinancialMoviment($id); // Traz as últimas movimentações financeiras
    public function getAllCashInflow($id); // traz a soma de todas as entradas
    public function getAllCashOutflow($id); // traz a soma de todas as saídas 
    public function getTotalBalance($id); // traz balanço total entre entradas e saídas
    public function getCashInflowReport($monthy); // traz todas as entradas do mês
    public function getOutReport($monthy); // traz todas as saídas do mês
    public function findById($id); // traz uma movimentação especifica através do ID
    public function create(FinancialMoviment $financialMoviment); // Insere a movimentação financeira no BD
    public function update(FinancialMoviment $financialMoviment); // Atualiza a movimentação financeira no BD
    public function destroy($id); // deleta uma movimentação financeira especifica no BD através do ID
}