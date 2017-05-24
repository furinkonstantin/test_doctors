<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arTypesEx = CIBlockParameters::GetIBlockTypes(Array("-"=>" "));

$arIBlocks=Array();
$db_iblock = CIBlock::GetList(Array("SORT"=>"ASC"), Array("SITE_ID"=>$_REQUEST["site"], "TYPE" => ($arCurrentValues["IBLOCK_TYPE"]!="-"?$arCurrentValues["IBLOCK_TYPE"]:"")));
while($arRes = $db_iblock->Fetch())
	$arIBlocks[$arRes["ID"]] = $arRes["NAME"];

$listActive = array();
$listActive[''] = 'Без учета активности';
$listActive['Y'] = 'Только активные элементы';
$listActive['N'] = 'Только неактивные элементы';
$arComponentParameters = array(
"GROUPS" => array(),
"PARAMETERS" => array(
	'IBLOCK_TYPE' => array(
		'NAME' => 'Тип инфоблока',
		'TYPE' => 'LIST',
		'MULTIPLE' => 'N',
		'VALUES'=>$arTypesEx,
		'PARENT' => 'BASE',
		'DEFAULT'=>"news",
		"REFRESH" => "Y",
	),
	'IBLOCK_ID' => array(
		'NAME' => 'ID инфоблока',
		'TYPE' => 'LIST',
		'MULTIPLE' => 'N',
		'VALUES'=>$arIBlocks,
		'PARENT' => 'BASE',
		"DEFAULT" => '={$_REQUEST["ID"]}',
		"REFRESH" => "Y",
	),
	'NUMBER_PAGE' => array(
		'NAME' => 'Номер страницы',
		'TYPE' => 'STRING',
		'MULTIPLE' => 'N',
		'PARENT' => 'BASE',
		'DEFAULT'=>"",
	),
	'ELEMENT_ID' => array(
		'NAME' => 'Идентификатор элемента',
		'TYPE' => 'STRING',
		'MULTIPLE' => 'N',
		'PARENT' => 'BASE',
		'DEFAULT'=>"",
	),
	'ELEMENT_СODE' => array(
		'NAME' => 'Код элемента',
		'TYPE' => 'STRING',
		'MULTIPLE' => 'N',
		'PARENT' => 'BASE',
		'DEFAULT'=>"",
	),
	'SECTION_ID' => array(
		'NAME' => 'Идентификатор раздела',
		'TYPE' => 'STRING',
		'MULTIPLE' => 'N',
		'PARENT' => 'BASE',
		'DEFAULT'=>"",
	),
	'SECTION_CODE' => array(
		'NAME' => 'Код раздела',
		'TYPE' => 'STRING',
		'MULTIPLE' => 'N',
		'PARENT' => 'BASE',
		'DEFAULT'=>"",
	),
	'COUNT_ELEMENTS' => array(
		'NAME' => 'Количество отображаемых элементов',
		'TYPE' => 'STRING',
		'MULTIPLE' => 'N',
		'PARENT' => 'BASE',
		'DEFAULT'=>"",
	),
	'PAGER_SHOW_ALL' => array(
		'NAME' => 'Показать все элементы',
		'TYPE' => 'CHECKBOX',
		'MULTIPLE' => 'N',
		'PARENT' => 'BASE',
		'DEFAULT'=>"",
	),
    'PAGER_DESC_NUMBERING' => array(
		'NAME' => 'Обратная навигация',
		'TYPE' => 'CHECKBOX',
		'MULTIPLE' => 'N',
		'PARENT' => 'BASE',
		'DEFAULT'=>"",
	),
	'GROUP_FIELDS' => array(
		'NAME' => 'Сгруппировать элементы по заданным полям',
		'TYPE' => 'STRING',
		'MULTIPLE' => 'Y',
		'PARENT' => 'BASE',
		'DEFAULT'=>"",
	),
	'SELECTED_FIELDS' => array(
		'NAME' => 'Отбираемые поля',
		'TYPE' => 'STRING',
		'MULTIPLE' => 'Y',
		'PARENT' => 'BASE',
		'DEFAULT'=>"",
	),
    'SELECTED_PROPERTIES' => array(
		'NAME' => 'Отбираемые свойства',
		'TYPE' => 'STRING',
		'MULTIPLE' => 'Y',
		'PARENT' => 'BASE',
		'DEFAULT'=>"",
	),
	'FILTER_NAME' => array(
		'NAME' => 'Фильтр',
		'TYPE' => 'STRING',
		'MULTIPLE' => 'N',
		'PARENT' => 'BASE',
		'DEFAULT'=>"",
	),
	'TEMPLATE_NAVIGATION' => array(
		'NAME' => 'Шаблон для постраничной навигации',
		'TYPE' => 'STRING',
		'MULTIPLE' => 'N',
		'PARENT' => 'BASE',
		'DEFAULT'=>".default",
	),
	'ONLY_ACTIVE' => array(
		'NAME' => 'Активность элементов',
		'TYPE' => 'LIST',
		'MULTIPLE' => 'N',
		'PARENT' => 'BASE',
		'VALUES'=>$listActive,
		'DEFAULT'=>"",
	),
	'AJAX_MODE'=>array(),
	"COUNT_ELEMENTS" => array(
		"PARENT" => "BASE",
		"NAME" => "Количество отображаемых элементов на странице",
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"DEFAULT" => "",
	),
	"CACHE_TIME" => array(
		"PARENT" => "BASE",
		"NAME" => "Кэш",
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"DEFAULT" => 3600,
	),
	"ORDER_BY1" => array(
		"PARENT" => "BASE",
		"NAME" => "Порядок сортировки 1",
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"DEFAULT" => "ASC",
	),
	"SORT_BY1" => array(
		"PARENT" => "BASE",
		"NAME" => "Сортировка по заданному полю 1",
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"DEFAULT" => "SORT",
	),
	"ORDER_BY2" => array(
		"PARENT" => "BASE",
		"NAME" => "Порядок сортировки 2",
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"DEFAULT" => "",
	),
	"SORT_BY2" => array(
		"PARENT" => "BASE",
		"NAME" => "Сортировка по заданному полю 2",
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"DEFAULT" => "",
	),
),
);
?>