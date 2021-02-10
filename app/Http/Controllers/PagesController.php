<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransRequest;
use App\Models\Symbol;
use App\Models\Pairs;
use App\Models\Transakcje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\wBazie;

use Illuminate\Support\Facades\Validator;
class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.index');
    }
  
    public function home()
    {
        return view('pages.index');
    }
    public function kup()
    {
    $symbole = new Symbol();
    $dane = $symbole::all('symbol');
        
        return view('pages.kup',compact('dane'));
    }
    public function portfel()
    {    
        
        $symbole_baza = Symbol::all();
               $userid= Auth::id();
       $transakcje = new Transakcje();
       $para = new Pairs();
      $dane = Transakcje::where('user_id',$userid)->orderBy('created_at', 'DESC')->paginate(10);//pobranie wszystkich rekordow z tabeli transakcjes
    
        
      $pary = Transakcje::select('para')->distinct()->get();//pobranie bez duplikatów smboli z tabeli transakcjes
    $tab=[]; 

        foreach($pary as $k)//Wybranie z bazy symboli i przypisanie im aktualnych cen ( w pętli żeby nie ładowac ceny dla kazdego rekordu)
        {
            $tab[$k->para] =number_format(  (json_decode(file_get_contents('https://api.binance.com/api/v3/ticker/price?symbol='.$k->para))->price),6, '.', '');
    
        }
     foreach($dane as $trans) //pobranie rekordu z tabeli transakcja i zaktualizowanie ceny / zysku 
      {
          $prowizja_zakonczenia= 0.001*($tab[$trans->para]*$trans->ilosc);
        $wart_transakcji=$trans->ilosc*$trans->cena;// z bazy
        $prowizja= 0.001*$wart_transakcji+$prowizja_zakonczenia; 
        $trans->prowizja_w = $prowizja_zakonczenia;
        
        foreach ($tab as $tab_key => $tab_value) //Wyznaczenie dla rekordu ceny i profitu
        {
          if($trans->para == $tab_key)//sprawdzenie czy para z bazy == para w tablicy z danymi z binance 
          {     
              $trans->price=$tab_value;
              $trans->profit =number_format((($trans->ilosc*$tab_value - $wart_transakcji)-$prowizja) ,2, '.', '');
              $trans->procent = number_format(($trans->profit/$trans->wartosc_transakcji * 100), 2 , '.', '');
          }  
        }
       
      } 
      
        return view('layouts.portfel',compact('dane','symbole_baza'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
