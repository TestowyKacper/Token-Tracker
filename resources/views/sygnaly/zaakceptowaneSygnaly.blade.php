<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  @section('tittle','Sygnały')
  @include('nawigacja')
  
        @auth
        <div id="kontener">
          @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
              </div>
               @endif 
                 @if ($message = Session::get('error'))
               <div class="alert alert-danger alert-block">
                   <button type="button" class="close" data-dismiss="alert">×</button>	
                       <strong>{{ $message }}</strong>
                     </div>
                      @endif

                      @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                    @endif
                  
                      <h1>Sygnały użytkowników</h1>
                      <div id="Snaglowek">
                      <a name="" id="kup" href="{{ route('addsygnaly') }}"  class="btn btn-success"  role="button">Utwórz sygnał</a>
                    </div>
                      @if ($sygnaly->isEmpty())
                      <div id="Sbrak" >Brak nowych sygnałów</div>
                      @else 
          @foreach ($sygnaly as $item)
            <div id="Sbox">

                <div id="Sparent">
                  <div id = "Slewa"><div id="tytul">{{$item->tytul}} </div></div>
                  <div id = "Sprawa"> <div id="para">Para: &nbsp; {{$item->para}} </div> </div></div>
                <div id="opis"><div id="tekst_opisu">{{$item->opis}}</div> </div>
                <div id="nick">  <div id="nick_tekst">  Autor: &nbsp;{{$item->nick}} &nbsp;&nbsp; Godzina utworzenia&nbsp;{{$item->created_at}} </div></div>
              <div id="sygnal">
            <img id="myImg{{$item->id}}" src="{{ url('/images') }}/{{$item->img}}" alt="Sygnał użytkownika {{Auth::user()->name}}"   onclick="pokaz({{$item->id}})" style="width:100%;max-width:300px">

            <!-- The Modal -->
            <div id="myModal{{$item->id}}" class="Smodal">

              <!-- The Close Button -->
              <span class="Sclose" id="Sclose{{$item->id}}">&times;</span>

              <!-- Modal Content (The Image) -->
              <img class="Smodal-content" id="img{{$item->id}}">

              <!-- Modal Caption (Image Text) -->
              <div id="Scaption{{$item->id}}"></div>
            </div>
          </div>
            
       

</div><!-- koniec boxa -->

          @endforeach
           @endif
                    

    </div>
    
        
        @endauth
        @guest
         @include('pages.niezalogowany')
        @endguest
     
        <div id='stopka' class="footer">
          <p>Kacper Bury</p>
        </div>



    
</body>
</html>
