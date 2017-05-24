<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
CModule::IncludeModule("iblock");
global ${$arParams["FILTER_NAME"]};
$arrFilter = ${$arParams["FILTER_NAME"]};
$life_time = $arParams['CACHE_TIME'];
if ($arParams['CACHE_TYPE'] == 'N') {
	$life_time = 0;
}

$arParams["PAGER_SHOW_ALL"] = $arParams["PAGER_SHOW_ALL"]=="Y";
$arParams["PAGER_DESC_NUMBERING"] = $arParams["PAGER_DESC_NUMBERING"]=="Y";
$arNavParams = array(
    "nPageSize" => $arParams["COUNT_ELEMENTS"],
    "bDescPageNumbering" => $arParams["PAGER_DESC_NUMBERING"],
    "bShowAll" => $arParams["PAGER_SHOW_ALL"],
);
$arNavigation = CDBResult::GetNavParams($arNavParams);

if ($this->StartResultCache($life_time, array($arrFilter, $USER->GetGroups(), $arNavigation))) {
	$arSort = array($arParams['SORT_BY1']=>$arParams['ORDER_BY1'], $arParams['SORT_BY2']=>$arParams['ORDER_BY2']);
	foreach($arSort as $indexSort=>$itemSort) {
		if (empty($itemSort)) {
			unset($arSort[$indexSort]);
		}
	}
	$arFilterQuery = array('IBLOCK_TYPE'=>$arParams['IBLOCK_TYPE'],'IBLOCK_ID'=>$arParams['IBLOCK_ID'], 'ACTIVE'=>$arParams['ONLY_ACTIVE'], 'SECTION_ID'=>$arParams['SECTION_ID'], "SECTION_CODE"=>$arParams["SECTION_CODE"], "ID"=>$arParams["ELEMENT_ID"], "CODE"=>$arParams["ELEMENT_CODE"]);
	if (empty($arParams['ONLY_ACTIVE'])) {
		unset($arFilterQuery['ACTIVE']);
	}
	if (empty($arParams['ELEMENT_ID'])) {
		unset($arFilterQuery['ID']);
	}
	if (empty($arParams['ELEMENT_CODE'])) {
		unset($arFilterQuery['CODE']);
	}
	if (empty($arParams['SECTION_ID'])) {
		unset($arFilterQuery['SECTION_ID']);
	}
	if (empty($arParams['SECTION_CODE'])) {
		unset($arFilterQuery['SECTION_CODE']);
	}
	if (empty($arParams['IBLOCK_ID'])) {
		return false;
	}
	$arParams["COUNT_ELEMENTS"] = intval($arParams["COUNT_ELEMENTS"]);
    if($arParams["COUNT_ELEMENTS"]<=0) {
        $arParams["COUNT_ELEMENTS"] = 20;
    }
	
	$groupFields = $arParams['GROUP_FIELDS'];
	foreach($groupFields as $indexGroupField=>$groupItem) {
		if (empty($groupItem)) {
			unset($groupFields[$indexGroupField]);
		}
	}
	if (empty($groupFields)) {
		$groupFields = false;
	}
	
	$arSelectFields = $arParams['SELECTED_FIELDS'];
	foreach($arSelectFields as $indexSelectedField=>$selectedItem) {
		if (empty($selectedItem)) {
			unset($arSelectFields[$indexSelectedField]);
		}
	}
	if (empty($arSelectFields)) {
		$arSelectFields = array();
	}

	$arSelect = array_merge($arSelectFields, array(
        "ID",
        "IBLOCK_ID",
        "IBLOCK_SECTION_ID",
        "NAME",
        "DATE_CREATE",
        "ACTIVE_FROM",
        "DETAIL_PAGE_URL",
        "DETAIL_TEXT",
        "DETAIL_TEXT_TYPE",
        "PREVIEW_TEXT",
        "PREVIEW_TEXT_TYPE",
        "LIST_PAGE_URL",
        "PREVIEW_PICTURE",
        "DETAIL_PICTURE",
    ));
    
    if (!empty($arrFilter)) {
        $arFilterQuery = array_merge($arFilterQuery, $arrFilter);
    }

 	$query = CIBlockElement::GetList($arSort, $arFilterQuery, $groupFields, $arNavParams, $arSelect);
	$res = array();
	if (empty($arSelectFields)) {
		while($result = $query->GetNextElement()) {
			$fields = $result->GetFields();
			$props = $result->GetProperties();
			$fields["PROPERTIES"] = $props;
			$res[] = $fields;
		}
	} else {
		while($result = $query->GetNext()) {
			$res[] = $result;
		}
	}

	$navArray['NAV_STRING'] = $query->GetPageNavStringEx($navComponentObject, "Страницы:", $arParams['TEMPLATE_NAVIGATION']);
	$navArray["NavPageCount"] = $query->NavPageCount;
	$navArray["NavPageNomer"] = $query->NavPageNomer;
	$navArray["NavPageSize"] = $query->NavPageSize;
	$navArray["bShowAll"] = $query->bShowAll;
	$navArray["NavShowAll"] = $query->NavShowAll;
	$navArray["NavNum"] = $query->NavNum;
	$arResult["ITEMS"] = $res;
	$arResult["NAVIGATION"] = $navArray;

	$this->IncludeComponentTemplate();
}
?>