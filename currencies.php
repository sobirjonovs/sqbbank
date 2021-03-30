<?php

require_once "CbrXmlParser.php";

$currency = new \Database\Currency();

$xml = new CbrXmlParser();

$xml->set("http://www.cbr.ru/scripts/XML_dynamic.asp", [
    'date_req1' => '07/07/2007',
    'date_req2' => '07/08/2007',
    'VAL_NM_RQ' => 'R01235'
]);

foreach ($xml->get('Record') as $record) {
    $xml->set("http://www.cbr.ru/scripts/XML_daily.asp", [
        'date_req' => $record->attributes()['Date'],
        'd' => 0
    ]);
    foreach ($xml->get('Valute') as $valute) {
        $currency->create([
            'valuteID' => $valute->attributes()['ID'],
            'codeNum' => $valute->NumCode,
            'codeChar' => $valute->CharCode,
            'name' => $valute->Name,
            'value' => $valute->Value,
            'date' => $record->attributes()['Date']
        ]);
    }
}