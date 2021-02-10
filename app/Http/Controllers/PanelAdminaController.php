<?php

namespace App\Http\Controllers;
use App\Models\Sygnaly;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PanelAdminaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }


    public function sprawdzSygnaly()
    {
        $sygnaly= Sygnaly::where('status',"rozpatrywany")->get();

        return view('PanelAdmina.sprSygnaly',compact('sygnaly'));
    }

     public function uzytkownicy()
      {
          $users = User::all();

          return view('PanelAdmina.uzytkownicy',compact('users'));

      }
      public function zmiana_uprawnien($status,$id)
      {
          $user = User::find($id);
          if($status==0)
          {
            $user->status=1;
            $user->save();
          }
          else
          {
            
            $user->status=2;
            $user->save();  
          }

          return back()->with('success','Zmieniono uprawnienia użytkownika.');

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
