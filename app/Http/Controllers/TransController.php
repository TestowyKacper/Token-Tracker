<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transakcje;
use App\Models\Symbol;
use App\Models\Zamkniete;
use App\Rules\wBazie;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TransRequest;

class TransController extends Controller
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
        //
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
        $para=$request->input('kupiona'); 
        $request['para']="$para";

        $cena=str_replace(',', '.',$request->input('cena') );
        $request['cena']="$cena";
        $ilosc=str_replace(',', '.',$request->input('ilosc') );
        $request['ilosc']="$ilosc";

        $this->validate($request,[
            'ilosc'=>'required|numeric|gt:0',
            'cena'=>'required|numeric|gt:0',
            'kupiona'=>'required|max:5',
            'sprzedana'=>'required|max:5',
            'para'=> new wBazie($request->input('kupiona'),$request->input('sprzedana'))
          
        ],
        [   
            'ilosc.required'=>'Pole ilość jest wymagane.',
            'ilosc.numeric'=>'Podaj poprawną ilość tokenów.',
            'ilosc.gt'=>'Ilość musi być większa niż 0.',
           
            'cena.numeric' => 'Wprowadź poprawną cenę.',
            'cena.required' => 'Uzupełnij cenę.',
            'cena.gt'=>'Cena musi być większa niż 0.',

            'kupiona.max:5'=>'Wybierz poprawnie kupioną walute',
            'kupiona.required'=>'Wybierz kupowaną walutę',

             'sprzedana.max:5'=>'Wybierz poprawnie sprzedaną walutę',//zabezpieczenie przed 
             'sprzedana.required'=>'Wybierz sprzedawaną walutę',
        ]);

        
      $transakcja = new Transakcje();
      $transakcja->user_id = Auth::id();
      $transakcja->sprzedana = $request->input('sprzedana');
      $transakcja->kupiona = $request->input('kupiona');
      $transakcja->para =$request->input('kupiona'). $para=$request->input('sprzedana'); 
      $transakcja->cena = $request->input('cena');
      $transakcja->ilosc = $request->input('ilosc');
      $transakcja->status = $request->input('status');
      $transakcja->wartosc_transakcji= $request->input('ilosc')*$request->input('cena')  ;
      $transakcja->save();
      return redirect()->route('portfel')->with('success','Dodano transakcję!');;  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       // $transakcja= new Transakcje();
        $tranBaza = Transakcje::where('id',$id)->where('status','aktywna') ->get();
        $transakcja['id']=$id;
        foreach($tranBaza as $item)
        {
            $transakcja['kupiona'] = $item->kupiona;
            $transakcja['sprzedana'] = $item->sprzedana;
            $transakcja['cena'] = $item->cena;
            $transakcja['ilosc'] = $item->ilosc;
        }      
             $dane = Symbol::all('symbol');
            return view('pages.edit',compact('transakcja','dane'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) //aktualizowanie po edycji transakcji
    {
        
        $para=$request->input('kupiona'); 
        $request['para']="$para";
        $cena=str_replace(',', '.',$request->input('cena') );
        $request['cena']="$cena";
        $this->validate($request,[
            'ilosc'=>'required|numeric|gt:0',
            'cena'=>'required|numeric|gt:0',
            'kupiona'=>'required|max:5',
            'sprzedana'=>'required|max:5',
            'para'=> new wBazie($request->input('kupiona'),$request->input('sprzedana'))
        ],
        [
            'ilosc.required'=>'Pole ilość jest wymagane.',
            'ilosc.numeric'=>'Podaj poprawną ilość tokenów.',
            'ilosc.gt'=>'Ilość musi być większa niż 0.',

            'cena.numeric' => 'Wprowadź poprawną cenę.',
            'cena.required' => 'Uzupełnij cenę.',
            'cena.gt'=>'Cena musi być większa niż 0.',

            'kupiona.max:5'=>'Wybierz poprawnie kupioną walute',
            'kupiona.required'=>'Wybierz kupowaną walutę',

             'sprzedana.max:5'=>'Wybierz poprawnie sprzedaną walutę',//zabezpieczenie przed 
             'sprzedana.required'=>'Wybierz sprzedawaną walutę',
        ]);

        
      $transakcja = Transakcje::find($request->id);
      $transakcja->sprzedana = $request->input('sprzedana');
      $transakcja->kupiona = $request->input('kupiona');
      $transakcja->para =$request->input('kupiona'). $para=$request->input('sprzedana'); 
      $transakcja->cena = $request->input('cena');
      $transakcja->ilosc = $request->input('ilosc');
      $transakcja->status = $request->input('status');
      $transakcja->wartosc_transakcji= $request->input('ilosc')*$request->input('cena') ;
      $transakcja->save();
      return redirect()->route('portfel');  
    }

    public function zamknij_poz($id,$cena)
    {
        
     
        $transakcja = Transakcje::find($id); 
       $prowizja_zakonczenia=0.001*$cena*$transakcja->ilosc;
       $prowizja= 0.001*$transakcja->wartosc_transakcji+ $prowizja_zakonczenia;  
        $zysk=number_format((($transakcja->ilosc*$cena - $transakcja->wartosc_transakcji)-$prowizja) ,2, '.', '');
    $zamknieta = new Zamkniete();

    $zamknieta->user_id = $transakcja->user_id;
    $zamknieta->sprzedana = $transakcja->sprzedana;
    $zamknieta->kupiona= $transakcja->kupiona;
    $zamknieta->para = $transakcja->para;
    $zamknieta->cena= $transakcja->cena;
    $zamknieta->ilosc = $transakcja->ilosc;
    $zamknieta->status = 'zamknieta';
    $zamknieta->wart_transakcji = $transakcja->wartosc_transakcji;
    $zamknieta->cena_zamkniecia= $cena;
    $zamknieta->zysk=$zysk;
    $zamknieta->save();

    $transakcja->delete();
   
    return back()->with('success','Pomyślnie zamknięto pozycję!');


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transakcja = Transakcje::find($id);
        

        $transakcja->delete();        
       return  back()->with('info','Pomyślnie usunięto transakcję!');
    }

    public function edytuj_cene(Request $request , $id)
    {


        
        $edit_cena=str_replace(',', '.',$request->input('edit_cena') );
        $request['edit_cena']="$edit_cena";
        $this->validate($request,[      
            'edit_cena'=>'required|numeric|gt:0',
        ],
        [
            'edit_cena.required'=>'Wprowadź cenę zamknięcia pozycji.',
            'edit_cena.numeric'=>'Wprowadź poprawnie cenę.',
            'edit_cena.gt'   => 'Cena musi być większa niż 0.'
        ]);
        

       
        
      
           $transakcja = Transakcje::find($id);
          $prowizja_zakonczenia=0.001*($request['edit_cena']*$transakcja->ilosc);
            $prowizja= 0.001*$transakcja->wartosc_transakcji+ $prowizja_zakonczenia;  
          
           
           $zysk=number_format((($transakcja->ilosc*$request['edit_cena'] - $transakcja->wartosc_transakcji)-$prowizja) ,2, '.', '');
        $zamknieta = new Zamkniete();

        $zamknieta->user_id = $transakcja->user_id;
        $zamknieta->sprzedana = $transakcja->sprzedana;
        $zamknieta->kupiona= $transakcja->kupiona;
        $zamknieta->para = $transakcja->para;
        $zamknieta->cena= $transakcja->cena;
        $zamknieta->ilosc = $transakcja->ilosc;
        $zamknieta->status = 'zamknieta';
        $zamknieta->wart_transakcji = $transakcja->wartosc_transakcji;
        $zamknieta->cena_zamkniecia= $request['edit_cena'];
        $zamknieta->zysk=$zysk;
        $zamknieta->save();

        $transakcja->delete();
       
        return back()->with('success','Pomyślnie zamknięto pozycję!');
    }


    public function pokaz_zamkniete()
    {
        $profit=0;
        $dane = Zamkniete::where('user_id',Auth::id())->get();

        
        foreach($dane as $rekord)
        {
            $profit += $rekord->zysk;  
        }
        $dane=Zamkniete::where('user_id',Auth::id())->orderBy('created_at', 'DESC')->paginate(10);
     
        return view('pages.zamkniete',compact('dane','profit'));
    }
    public function usunZam($id)
    {
        $transakcja = Zamkniete::find($id);
        

        $transakcja->delete();        
       return  back()->with('info','Pomyślnie usunięto transakcję!');
    }
}
