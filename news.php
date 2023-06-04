<?php
require_once("templates/header_iframe.php");
ini_set('max_execution_time', 10);


// HG Finance API
$url = 'https://newsapi.org/v2/top-headlines?sources=google-news-br&apiKey=27a753fdaaab471189742fb09cac21a3';
$config_user = $_SERVER["HTTP_USER_AGENT"];
// INICIALIZANDO O CURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_USERAGENT, $config_user);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_REFERER, $url);
$newsData = json_decode(curl_exec($ch));
curl_close($ch);


//print_r($newsData);

?>

<style>
html ::-webkit-scrollbar {
  width: 10px;
}
html ::-webkit-scrollbar-thumb {
  border-radius: 50px;
  background: #138496;
}
html ::-webkit-scrollbar-track {
  background: #ededed;
}

.scroll-imgs-container {
    margin-top: 5rem;
    max-height: 60rem;
    overflow-y: scroll;
    display: flex;
    flex-wrap: wrap;
    gap: 1.6rem 0;
    flex: 0 1 700px;
    font-size: 20px;
}


.scroll-img {
    transition: all 0.3s ease;
    filter: brightness(0.6);
}

.scroll-img-item {
    display: flex;
    align-items: flex-start;
    justify-content: flex-start;
    position: relative;
}

.scroll-img {
    position: relative;
    overflow: hidden;
    width: 100%;
    max-width: 20rem;
    min-height: 15.1rem;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}

.scroll-img-texts {
    display: flex;
    width: 100%;
    height: 100%;
    flex-wrap: wrap;
    flex-direction: column;
    justify-content: center;
    padding: 0rem 1.2rem 0rem 1.2rem;
    align-items: flex-start;
    text-align: justify;
}

.scroll-img-text {
    color: var(--white200);
    font-size: 1.1rem;
    line-height: 1.6rem;
}
.scroll-img-date {
    color: var(--white200);
    line-height: 2rem;
}

.responsive { width: 100%; height: auto;}
</style>

<body id="iframe-body">

    <div class="container">
        <h1 class="text-center my-5">News</h1>
        <div class="col-md-12">
            <div class="scroll-imgs-container">
                <div class="scroll-img-item">
                    <div class="scroll-img">
                        <a href="">
                            <img class="responsive" src="assets/finance_logo.png" alt="">
                        </a>
                    </div>
                    <div class="scroll-img-texts">
                        <p class="scroll-img-title">Titulo</p>
                        <p class="scroll-img-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet provident distinctio at velit nostrum, quaerat est tenetur pariatur consectetur dolore quo accusantium dolorum assumenda, rerum ea eaque, laboriosam quis similique.</p>
                        <p class="scroll-img-date">Data 06/10/2023</p>
                        <a class="btn btn-lg btn-outline-info" href="">Leia mais</a>
                    </div>
                </div>
                <div class="scroll-img-item">
                    <div class="scroll-img">
                        <a href="">
                            <img class="responsive" src="assets/finance_logo.png" alt="">
                        </a>
                    </div>
                    <div class="scroll-img-texts">
                        <p class="scroll-img-title">Titulo</p>
                        <p class="scroll-img-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet provident distinctio at velit nostrum, quaerat est tenetur pariatur consectetur dolore quo accusantium dolorum assumenda, rerum ea eaque, laboriosam quis similique.</p>
                        <p class="scroll-img-date">Data 06/10/2023</p>
                        <a class="btn btn-lg btn-outline-info" href="">Leia mais</a>
                    </div>
                </div>
                <div class="scroll-img-item">
                    <div class="scroll-img">
                        <a href="">
                            <img class="responsive" src="assets/finance_logo.png" alt="">
                        </a>
                    </div>
                    <div class="scroll-img-texts">
                        <p class="scroll-img-title">Titulo</p>
                        <p class="scroll-img-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet provident distinctio at velit nostrum, quaerat est tenetur pariatur consectetur dolore quo accusantium dolorum assumenda, rerum ea eaque, laboriosam quis similique.</p>
                        <p class="scroll-img-date">Data 06/10/2023</p>
                        <a class="btn btn-lg btn-outline-info" href="">Leia mais</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>



<?php require_once("templates/footer.php"); ?>
