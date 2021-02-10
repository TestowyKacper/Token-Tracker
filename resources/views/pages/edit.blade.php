
@extends('layouts.token')
@section('content')
@auth
    

  <div class="container">
 @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
    </div>
    @endif


    <form action="{{route('saveedit')}}" method="post">
        @csrf
    
   
  <div id='naglowek'>EDYCJA TRANSAKCJI</div>
  @if ($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif
    <div class="form-group">
      
      <div id="parent">
        <div id = "lewa"> <input type="text" name="ilosc" id="pole_tekstowe_ilosc" class="form-control" placeholder="Ilość kupionej waluty"  value ={{$transakcja['ilosc']}}><br/></div>
      <div id = prawa class="search_select_box">
       
        <select name="kupiona" class="selectpicker form-control" data-live-search="true">
           <option >{{$transakcja['kupiona']}}</option>
          @foreach ($dane as $item)
         
          @if ($transakcja['kupiona']==$item->symbol)
              
          @else
               <option >{{$item->symbol}}</option>
          @endif
              
          @endforeach
        </select>
        </div> 
   
       
      </div>
      <div id="parent">
        <div id = "lewa"> <div id="lewa_tekst">Wybierz walutę która została sprzedana</div></div>

      <div id = prawa class="search_select_box">
        <select name ='sprzedana' class="selectpicker form-control" data-live-search="true">
          <option >{{$transakcja['sprzedana']}}</option>
          @foreach ($dane as $item)
         
          @if ($transakcja['sprzedana'] == $item->symbol)
              
          @else
             @if ($item->symbol=='BTC')
          <option >USDT</option>
          @endif
          @if ($item->symbol=='USDT')
          {
            <option >BTC</option>
          }
          @else
          {
              <option >{{$item->symbol}}</option>
          }
          @endif 
          @endif
          
  
          @endforeach
        </select>
        </div> 
      </div>

      <input type="text" name="cena" id="pole_tekstowe" class="form-control" placeholder="Cena" value={{$transakcja['cena']}} ><br/>
        <button type="submit" class="btn btn-secondary form-control">Zapisz zmiany</button>
        <input id="aktywna" name="status" type="hidden" value="aktywna">
        <input id="aktywna" name="id" type="hidden" value={{$transakcja['id']}}>
    </div>
    </form>
  </div>
  @endauth
  @guest
      Musisz być zalogowany
  @endguest
@endsection