
@extends('layouts.token')
@section('content')
@auth
    

  <div class="container">
    <form action="{{route('save')}}" method="post">
        @csrf
    
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
    </div>
    @endif
  <div id='naglowek'>DODAWANIE TRANSAKCJI</div>
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
        <div id = "lewa"> <input type="text" name="ilosc" id="pole_tekstowe_ilosc" class="form-control" placeholder="Ilość waluty kupowanej" ><br/></div>
      <div id = prawa class="search_select_box">
       
        <select name="kupiona" class="selectpicker form-control" data-live-search="true">
          @foreach ($dane as $item)
               <option >{{$item->symbol}}</option>
          @endforeach
        </select>
        </div> 
   
       
      </div>
      <div id="parent">
        <div id = "lewa"> <div id="lewa_tekst">Wybierz walutę która została sprzedana</div></div>

      <div id = prawa class="search_select_box">
        <select name ='sprzedana' class="selectpicker form-control" data-live-search="true">
          @foreach ($dane as $item)
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
  
          @endforeach
        </select>
        </div> 
      </div>

      <input type="text" name="cena" id="pole_tekstowe" class="form-control" placeholder="Cena" ><br/>
    
   


     

     <!-- <input type="text" name="sprzedana" id="" class="form-control" placeholder="Podaj skrót sprzedawanej " ><br/>
      <div class="alert-danger"></div>
      <input type="text" name="kupiona" id="" class="form-control" placeholder="Podaj skrót kupowanej " ><br/>
      <input type="text" name="cena" id="" class="form-control" placeholder="Cena " ><br/>
      <input type="text" name="ilosc" id="" class="form-control" placeholder="Ilość tokenów " ><br/>
      <input type="text" name="prowizja" id="" class="form-control" placeholder="Prowizja" ><br/>
      <input id="aktywna" name="status" type="hidden" value="aktywna"><br/>-->
        <button type="submit" class="btn btn-secondary form-control">Dodaj</button>
        <input id="aktywna" name="status" type="hidden" value="aktywna">
    </div>
    </form>
  </div>
  @endauth
  @guest
      Musisz być zalogowany
  @endguest
@endsection