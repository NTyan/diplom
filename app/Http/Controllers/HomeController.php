<?php

    namespace App\Http\Controllers;

    use App\Models\Price;
    use function view;

    class HomeController
    {
        public function show() {

            $ABS = Price::select('price')->where('plastic', 'ABS')->min('price');
            $PLA = Price::select('price')->where('plastic', 'PLA')->min('price');
            $Flex = Price::select('price')->where('plastic', 'Flex')->min('price');

            return view('welcome', ['ABS'=>$ABS, 'PLA'=>$PLA, 'Flex'=>$Flex]);
        }
    }
