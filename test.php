<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
?><?$APPLICATION->IncludeComponent(
	"maxtm1:newsletter.subscription",
	"",
	Array(
		"BUTTON" => "Подписаться",
		"POLICY" => "/policy/",
		"SUBTITLE" => "Мы регулярно публикуем новую и интересную информацию, акции и специальные предложения",
		"TITLE" => "Подпишитесь на рассылку"
	)
);?>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>