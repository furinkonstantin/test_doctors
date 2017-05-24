<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-6 col-xs-4">
            <h2 class="text-center">Фильтр</h2>
            <form class="form-horizontal" action="" method="get">
                <? foreach($arParams["SELECTED_PROPERTIES"] as $propCode):?>
                    <div class="form-group">
                        <label class="col-xs-2 control-label" for="<?=$propCode?>"><?=GetMessage($propCode . "_TITLE")?></label>
                        <div class="col-xs-10">
                            <input type="text" name="<? echo $arParams["FILTER_NAME"]. "[?PROPERTY_" . $propCode . "]";?>" value="<?=$_GET[$arParams["FILTER_NAME"]]["?PROPERTY_" . $propCode]?>"  id="<?=$propCode?>" placeholder="<?=GetMessage($propCode . "_TITLE")?>">
                        </div>
                    </div>
                <? endforeach;?>
                <div class="form-group">
                    <div class="col-xs-offset-2 col-xs-10">
                        <button type="submit" class="btn btn-primary">Поиск</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<? if (!empty($arResult['ITEMS'])):?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-6 col-xs-4">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <? foreach($arParams["SELECTED_PROPERTIES"] as $propCode):?>
                                    <th><?=GetMessage($propCode . "_TITLE")?></th>
                                <? endforeach;?>
                            </tr>
                        </thead>
                        <tbody>
                            <? foreach($arResult['ITEMS'] as $arItem):?>
                                <tr>
                                    <? foreach($arParams["SELECTED_PROPERTIES"] as $propCode):?>
                                        <td><?=htmlspecialchars_decode($arItem["PROPERTIES"][$propCode]["VALUE"])?></td>
                                    <? endforeach; ?>
                                </tr>
                            <? endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <? if (!empty($arResult["NAVIGATION"])):?>
        <?=$arResult["NAVIGATION"]["NAV_STRING"]?>
    <? endif;?>
<? endif;?>