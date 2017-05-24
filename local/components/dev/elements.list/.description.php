<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); $arComponentDescription = array(
	"NAME" => GetMessage("LIST_ELEMENTS"),
	"DESCRIPTION" => GetMessage("LIST_ELEMENTS"),
	"PATH" => array(
	  "ID" => "content",
		"CHILD"=>array(
				"ID"=>"components_project",
				"NAME"=>GetMessage("COMPONENTS_PROJECT"),
		), 
  ),
	"ICON" => "/images/icon.gif",
);
?>