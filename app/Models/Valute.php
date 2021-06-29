<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valute extends Model
{
    use HasFactory;

    protected $list = array();

    /*ѕолучение курсов на заданный день*/
    public function loads($time)
    {
        $xml = new \DOMDocument();
        $url = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . $time;
 
        if (@$xml->load($url))
        {
            $this->list = array(); 
 
            $root = $xml->documentElement;
            $items = $root->getElementsByTagName('Valute');
 
            foreach ($items as $item)
            {
                $code = $item->getElementsByTagName('CharCode')->item(0)->nodeValue;
                $curs = $item->getElementsByTagName('Value')->item(0)->nodeValue;
                $this->list[$code] = floatval(str_replace(',', '.', $curs));
            }
 
            return true;
        } 
        else
            return false;
    }
    /*ѕолучение курса выбранной валюты из загруженной таблицы*/
    public function get($cur)
    {
        return isset($this->list[$cur]) ? $this->list[$cur] : 0;
    }
}
