<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Valute;

class mainController extends Controller
{

    /*Вывод Курсов валют доллара и евро*/
    public function index() {
        
        $valute = new Valute();
        $time = date('d.m.Y');
        $time2 = date('d.m.Y',mktime(0, 0, 0, date('m'), date('d')-1, date("Y")));        
        if ($valute->loads($time)){                 /*Устанавливаем курс на текущий день*/
            $usd_curs = $valute->get('USD');
            $eur_curs = $valute->get('EUR');
        }
        else{
            return view ('error');                  /*Установить не удалось*/
        }
        if ($valute->loads($time2)){                /*Устанавливаем курс на прошлый день*/
            $usd_curs_old = $valute->get('USD');
            $eur_curs_old = $valute->get('EUR');
        }
        else{
            return view ('error');                  /*Установить не удалось*/
        }
        return view('new', compact('usd_curs','usd_curs_old', 'eur_curs', 'eur_curs_old'));
    }
}
