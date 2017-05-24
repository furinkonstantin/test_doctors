<?php

    require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
    CModule::IncludeModule('iblock');    
    require_once(__DIR__ . "/../local/php_interface/classes/Excel/PHPExcel.php");

    class ChunkReadFilter implements PHPExcel_Reader_IReadFilter 
    {
        private $_startRow = 0; 
        private $_endRow = 0; 
        public function setRows($startRow, $chunkSize) { 
            $this->_startRow    = $startRow; 
            $this->_endRow      = $startRow + $chunkSize; 
        } 
        public function readCell($column, $row, $worksheetName = '') { 
            if (($row == 1) || ($row >= $this->_startRow && $row < $this->_endRow)) { 
                return true; 
            } 
            return false; 
        } 
    }

    $file =  __DIR__ . '/doctors.xlsx';
    set_time_limit(1800);
    ini_set('memory_liit', '128M');
    $chunkSize = 10;
    $startRow = 2;
    $exit = false;
    $empty_value = 0;
    if (!file_exists($file)) {
        exit();
    }

    $objReader = PHPExcel_IOFactory::createReaderForFile($file);
    $objReader->setReadDataOnly(true);

    $chunkFilter = new ChunkReadFilter(); 
    $objReader->setReadFilter($chunkFilter);
    $iblockId = 7;
    $properties = array(
        "NAME",
        "RATING",
        "EDUCATION",
        "PRICE",
        "SUBWAY",
        "CLINIC",
        "SPECIALITY",
        "COORDS"
    );
    while ( !$exit ) 
    {
        $chunkFilter->setRows($startRow,$chunkSize);
        $objPHPExcel = $objReader->load($file);
        $objPHPExcel->setActiveSheetIndex(0);
        $objWorksheet = $objPHPExcel->getActiveSheet();
        for ($i = $startRow; $i < $startRow + $chunkSize; $i++)
        {
            $nColumn = PHPExcel_Cell::columnIndexFromString($objWorksheet->getHighestColumn());
            $arFields = array();
            $arFields = array(
                "IBLOCK_ID" => $iblockId,
                "ACTIVE" => "Y"
            );
            $props = array();
            for ($j = 0; $j < $nColumn; $j++) {
                $value = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow($j, $i)->getValue()));
                $props[$properties[$j]] = $value;
            }

            if ( empty($value) ) {
                $empty_value++;
            } else {
                $el = new CIBlockElement;
                $arFields["NAME"] = $props[$properties[0]];
                $arFields["PROPERTY_VALUES"] = $props;
                $el->Add($arFields);
            }
            
            if ($empty_value == 3) {
                $exit = true;	
                continue;		
            }
        }
        $objPHPExcel->disconnectWorksheets();
        unset($objPHPExcel);
        $startRow += $chunkSize;
    }