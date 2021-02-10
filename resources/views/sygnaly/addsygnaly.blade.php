<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  @section('tittle','Portfel')
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
                    
                    <div id="addsygnal">
                  
                    <form action="{{ route('zapisz-sygnal') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label for="exampleFormControlInput1">Tytuł</label>
                          <input type="text" name="tytul" class="form-control" id="exampleFormControlInput1" placeholder="Tytuł sygnału">
                        </div>


                          
                        <div class="form-group">
                            <label for="para">Para walutowa</label>
                            <div id = prawa class="search_select_box">
       
                                <select id="para" name="para" class="selectpicker form-control" data-live-search="true">
                                  @foreach ($pary as $item)
                                       <option >{{$item->symbol}}</option>
                                  @endforeach
                                </select>
                                </div> 
                            <!--<input  class="form-control" name ="para" id="exampleFormControlInput1" placeholder="Para walut której dotyczy sygnał"> -->
                          </div>
                      
                       
                        <div class="form-group">
                          <label for="exampleFormControlTextarea1">Opis</label>
                          <textarea class="form-control" name="opis" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="image">Dodaj zdjęcie analizy</label>
                            <input type="file" id="image" name="img" class="form-control">
                            
                          </div> 
                          <button type="submit" class="btn btn-success form-control">Wyślij</button>

           
                     
                 
                        
                      </form>
                    
                </div>
                

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
