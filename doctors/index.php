<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Врачи");
?>
<?
    global $arrFilter;
    $arrFilter = $_GET["arrFilter"];
    $APPLICATION->IncludeComponent(
	"dev:elements.list", 
	"doctors", 
	array(
		"COMPONENT_TEMPLATE" => "doctors",
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "7",
		"NUMBER_PAGE" => "",
		"ELEMENT_ID" => "",
		"ELEMENT___ODE" => "",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"COUNT_ELEMENTS" => "1000",
		"SHOW_ALL" => "",
		"GROUP_FIELDS" => array(
		),
		"SELECTED_FIELDS" => array(
		),
		"FILTER_NAME" => "arrFilter",
		"TEMPLATE_NAVIGATION" => "doctors",
		"ONLY_ACTIVE" => "",
		"ORDER_BY1" => "ASC",
		"SORT_BY1" => "SORT",
		"ORDER_BY2" => "",
		"SORT_BY2" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"SELECTED_PROPERTIES" => array(
			0 => "NAME",
			1 => "RATING",
			2 => "EDUCATION",
			3 => "PRICE",
			4 => "SUBWAY",
			5 => "CLINIC",
			6 => "SPECIALITY",
			7 => "COORDS",
		),
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_DESC_NUMBERING" => "N"
	),
	false
);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>