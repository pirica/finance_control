<?php
require_once("templates/header_iframe.php");

$images = array(
    "-entry-out" => "finance_login.gif",
    "2" => "validate_register_form.gif",
    "3" => "finance_logo.png",
);

?>

<div class="container-fluid my-5" id="first-steps">
    <h1 class="text-center">Primeiros Passos <i class="fa-solid fa-money-bill-trend-up text-success"></i></h1>
    <div class="row my-3 text-center d-flex flex-column">
        <h4>Ta em dúvida de como usar a plataforma?</h4>
        <span>Comece sua jornada de sucesso aprendendo a fazer as tarefas abaixo!</span>
    </div>
    <div class="row my-3 lessons_container text-center">
        <div class="col-md-6">
            <!-- Editar perfil -->
            <div class="lessons_div my-3">
                <a href="#!" data-toggle="modal" data-target="#lesson">
                    <div>
                        <h4 class="font-weight-normal"><i class="fa-solid fa-user-pen"></i> Editar perfil </h4>
                        <span> Veja a seguir como editar o seu perfil.</span>
                    </div>
                    <button class="btn btn-outline-success" data-toggle="modal" data-target=".bd-lessons-entry-out">
                        ver
                    </button>
                </a>
            </div>
            <!-- Cadastrar entradas e saídas -->
            <div class="lessons_div my-3">
                <a href="#!" data-toggle="modal" data-target="#lesson">
                    <div>
                        <h4 class="font-weight-normal"> <i class="fa-solid fa-arrows-up-down"></i> Cadastrar entradas e saídas</h4>
                        <span> Veja a seguir como fazer cadastro de entradas e saídas.</span>
                    </div>
                    <button class="btn btn-outline-success" data-toggle="modal" data-target=".bd-lessons-entry-out">
                        ver
                    </button>
                </a>
            </div>
            <!-- Alterar entrada ou saída -->
            <div class="lessons_div my-3">
                <a href="#!" data-toggle="modal" data-target="#lesson">
                    <div>
                        <h4 class="font-weight-normal"><i class="fa-solid fa-file-pen"></i> Alterar entrada ou saída </h4>
                        <span> Veja a seguir como fazer a alteração de entradas e saídas.</span>
                    </div>
                    <button class="btn btn-outline-success" data-toggle="modal" data-target=".bd-lessons-entry-out">
                        ver
                    </button>
                </a>
            </div>

        </div>
        <div class="col-md-6">
            <!-- Verificar relatórios -->
            <div class="lessons_div my-3">
                <a href="#!" data-toggle="modal" data-target="#lesson">
                    <div>
                        <h4 class="font-weight-normal"><i class="fa-solid fa-square-poll-vertical"></i> Relatórios </h4>
                        <span> Veja a seguir como entrar e pesquisar nos relatórios.</span>
                    </div>
                    <button class="btn btn-outline-success" data-toggle="modal" data-target=".bd-lessons-entry-out">
                        ver
                    </button>
                </a>
            </div>

            <!-- Cadastrar Lembretes -->
            <div class="lessons_div my-3">
                <a href="#!" data-toggle="modal" data-target="#lesson">
                    <div>
                        <h4 class="font-weight-normal"><i class="fa-solid fa-solid fa-bell"></i> Cadastrar lembretes</h4>
                        <span> Veja a seguir como cadastrar lembretes.</span>
                    </div>
                    <button class="btn btn-outline-success" data-toggle="modal" data-target=".bd-lessons-entry-out">
                        ver
                    </button>
                </a>
            </div>

            <!-- Cadastrar Lembretes -->
            <div class="lessons_div my-3">
                <a href="#!" data-toggle="modal" data-target="#lesson">
                    <div>
                        <h4 class="font-weight-normal"><i class="fa-solid fa-calendar-days"></i> Agendar receita ou despesa</h4>
                        <span> Veja a seguir como agendar uma receita ou despesa.</span>
                    </div>
                    <button class="btn btn-outline-success" data-toggle="modal" data-target=".bd-lessons-entry-out">
                        ver
                    </button>
                </a>
            </div>
        </div>

    </div>

    <div class="offset-md-4 col-md-4 mt-5">
        <h4 class="text-center">Aviso importante!</h4>
        <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/7wk2GJxhKog" allowfullscreen></iframe>
            </div>
            
    </div>


    <!-- Modal Lessons  -->
    <?php foreach ($images as $key => $item) :
        echo '<div class="modal fade bd-lessons' . $key . '" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <img class="animated-gif" src="' . $BASE_URL . 'assets/' . $item . '" alt="Example gif">
                            </div>
                        </div>
                        <div class="modal-footer mx-auto">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>';

    endforeach; ?>
    <!-- Modal Lessons  -->


</div>

<!-- TODO: colocar video apresentação -->
<!-- <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen></iframe>
            </div> -->

<?php require_once("templates/footer.php"); ?>