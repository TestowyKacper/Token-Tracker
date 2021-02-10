<?php

namespace App\Http\Controllers;
use App\Models\Pairs;
use App\Models\Sygnaly;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use  App\Http\Controllers\PanelAdminaController;

  


class SygnalyController extends Controller
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
        
        $pary = Pairs::all();
        return view('sygnaly.addsygnaly',compact('pary'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        

        $this->validate($request,[
            'tytul'=>'required|max:30',
            'para'=>'required',
            'opis'=>'required|max:800',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          
        ],
        [   
            'tytul.required'=>'Podaj tytuł.',
            'tytul.max'=>'Tytuł może mieć maksymalnie 30 znaków.',
             'para.required' => 'Wybierz parę.',

            'opis.max'=>'Maksymalnie 800 znaków',
            'opis.required'=>'Podaj opis',

             'sprzedana.max:5'=>'Wybierz poprawnie sprzedaną walutę',
             'sprzedana.required'=>'Wybierz sprzedawaną walutę',

             

        ]);
        
      /*  $imageName = time().'.'.$request->img->extension();  
         $request->img->move(public_path('images'), $imageName);//Zapisanie obrazka w folderu public*/
            $image = $request->file('img');

           /* $image_name_m = time(). 'm.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/thumbnail');
            $resize_image = Image::make($image->getRealPath()); // pobranie obrazu do zmiennej 
            $resize_image->resize(150,150, function($constraint)//zmiana wymairów z zachowaniem proporcji
            {
                $constraint->aspectRatio();
            })->save($destinationPath. '/'. $image_name_m);*/

            $image_name = time(). '.' . $image->getClientOriginalExtension();
            $destinationPath=public_path('images');
            $image->move($destinationPath, $image_name);//zapisanie oryginalnego zdjecia w folderze public/images


         $sygnal = new Sygnaly();
         $sygnal->user_id=Auth::id();
         $sygnal->nick=Auth::user()->name ;
         $sygnal->tytul = $request->input('tytul');
        $sygnal->para=$request->input('para');
        $sygnal->opis=$request->input('opis');
        $sygnal->img=$image_name;
       // $sygnal->miniaturka=$image_name_m;
         $sygnal->save();
         return back()
         ->with('success','Twój sygnał czeka na zaakceptowanie przez administratora.');
        
           



    }

    public function zaakceptowany($id)
    {
        $sygnal = Sygnaly::find($id);
        $sygnal->status="zaakceptowany";
        $sygnal->save();
        
       return back()->with('success','Zaakceptowano sygnał');
    }
    public function odrzucony($id)
    {
        $sygnal = Sygnaly::find($id);
        $sygnal->status="odrzucony";
        $sygnal->save();
        
       return back()->with('success','Odrzucono sygnał');
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
    public function show()
    {
        $sygnaly= Sygnaly::where('status',"zaakceptowany")->orderBy('created_at', 'DESC')->get();

        return view('sygnaly.zaakceptowaneSygnaly',compact('sygnaly'));
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
