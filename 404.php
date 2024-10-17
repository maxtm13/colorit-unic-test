<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Ошибка 404");?>
 <section class="fault404">
 <div class="container">
 <h1> <? $APPLICATION->ShowTitle()?></h1>
  <div class="content-fault">
   <h2 class="title">404</h2>
   <div class="description">Такой страницы не существует. <br>
    Перейти на <a href="/" >Главную</a>
    </div>
  </div>

 </div>
 </section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>