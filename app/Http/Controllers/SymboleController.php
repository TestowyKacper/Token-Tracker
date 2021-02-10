<?php

namespace App\Http\Controllers;

use App\Models\Pairs;
use Illuminate\Http\Request;
use App\Models\Symbol;
class SymboleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function pairs()
    {   
      
        
        // FUNKCJA TYLKO DO POBRANIA SYMBOLI Z BINANCE !!!!!!!!!!!!!!!!!
        $url = 'https://api.binance.com/api/v3/ticker/bookTicker';
        $json = file_get_contents($url);
        $json = json_decode($json);
       // dd($json);
       
        foreach($json as $dane)
        {    $symbole = new Pairs();
            
            $symbole->symbol=$dane->symbol;
           $symbole->save();
        }
        
    }
    public function symbole()
    {
         //Dodawnia pojedyńczych symboli
       $all =array(
           'BTC','ETH','USDT','XRP','LTC','ADA','BCH','DOT','XLM','LINK','BNB','BSV','WBTC','USDC','EOS','XMR','TRX','XEM','THETA','XTZ','VET','CRO','UNI','NEO','MKR','SNX','AAVE','DAI','ATOM','LEO','DOGE','CEL','MIOTA','BUSD','YFI','DASH','HT','FIL','REV','SOL','ETC','FTT','ZEC','ZIL','COMP','DCR','WAVES','SUSHI','EGLD','KSM','ALGO','UMA','AVAX','OMG','ONT','RENBTC','LRC','NANO','RSR','GRT','DGB','OKB','BAT','ZRX','ICX','BTT','REN','LUNA','STX','MANA','GNO','ENJ','IOST','HEDG','ABBC','UST','LSK','OCEAN','NXM','BTCB','QNT','BAND','SNT','REP','EWT','BTG','AMPL','SC','KNC','PAX','RUNE','SVG','XVG','TUSD','CELO','CHSB','HUSD','QTUM','NEXO','HBAR','NEAR'
                      );
        foreach($all as $dane)
        {    $symbole = new Symbol();
            
            $symbole->symbol=$dane;
           $symbole->save();
        }
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
        //
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
