<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false) || $arResult["NavShowAll"])
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
$arResult["nEndPage"]--;
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-6 col-xs-4">
            <div class="text-center">
                <ul class="pagination">
                    <?if($arResult["bDescPageNumbering"] === true):?>
                        <?while($arResult["nStartPage"] >= $arResult["nEndPage"]):?>
                            <?$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;?>

                            <?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
                                <li class="active"><a href="#"><?=$NavRecordGroupPrint?></a></li>
                            <?elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):?>
                                <li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$NavRecordGroupPrint?></a></li>
                            <?else:?>
                                <li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$NavRecordGroupPrint?></a></li>
                            <?endif?>

                            <?$arResult["nStartPage"]--?>
                        <?endwhile?>
                    <?else:?>	
                        <?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>
                            <?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
                                <li class="active"><a href="#"><?=$arResult["nStartPage"]?></a></li>
                            <?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
                                <li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a></li>
                            <?else:?>
                                <li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a></li>
                            <?endif?>
                            <?$arResult["nStartPage"]++?>
                        <?endwhile?>
                    <?endif?>
                </ul>
            </div>
        </div>
    </div>
</div>