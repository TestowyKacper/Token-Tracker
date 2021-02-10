<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  @section('tittle','Portfel')

  @include('nawigacja')
  
        @auth
        <div class="kontener">
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


                    <div class="table-responsive">
              <p id="naglowek" class="font-weight-bold naglowek">Aktywne transakcje</p>
              <a name="" id="kup" href="{{ route('kup') }}"  class="btn btn-success"  role="button">Dodaj nową transakcję</a>
            
              <table class="table table-hover">
              <tr id="head"><td>Data otworzenia </td><td>Para</td><td>Ilość tokenów</td><td>Wartość transakcji</td><td>Aktualna cena</td><td>Zysk / Strata</td><td colspan="4"></td></tr>
             @if ($dane->isEmpty())
            <tr><td colspan="6"><a  href="{{'kup'}}"> Portfel jest pusty. Dodaj transakcje</a></td></tr>
             @else
                @foreach ($dane as $item)
        
               <tr  >
                
                 <td data-toggle="modal" data-target="#center{{$item->id}}">{{ $item->created_at }}</td>
                  <td data-toggle="modal" data-target="#center{{$item->id}}">{{ $item->kupiona }}/ {{$item->sprzedana}}</td>
                  <td data-toggle="modal" data-target="#center{{$item->id}}">{{$item->ilosc}}</td>
                  <td data-toggle="modal" data-target="#center{{$item->id}}">{{$item->wartosc_transakcji}}</td>
                  <td data-toggle="modal" data-target="#center{{$item->id}}"> {{$item->price}} &nbsp;$</td>
                  @if ($item->profit>0)
                      <td  data-toggle="modal" data-target="#center{{$item->id}}" id="plus">+{{$item->profit}} &nbsp; @if($item->sprzedana=='USDT') $ @else {{$item->sprzedana}} @endif</td>
                  @else
                      @if ($item->profit<0)
                      <td data-toggle="modal" data-target="#center{{$item->id}}" id="minus">{{$item->profit}} &nbsp;@if($item->sprzedana=='USDT') $ @else {{$item->sprzedana}} @endif</td>
                      @else 
                      <td>{{$item->profit}} &nbsp;$</td>
                      @endif
                  @endif
                <td></td>
              <td> 







 <!-- Przycisk do zamknij pozycje modalny -->
 <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edytuj{{$item->id}}">
 Edytuj
 </button>
 <!-- Okienko wyskakujące -->
 <div class="modal fade" id="edytuj{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Zamykanie pozycji</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         Czy chcesz wprowadzić własną cenę zamknięcia ?
         <div class="form-group" >
          <form action="{{route('saveedit')}}" method="post">
            @csrf 
      <div id="parent">
        <div id = "lewa"> <input type="text" name="ilosc" id="pole_tekstowe_ilosc" class="form-control" placeholder="Ilość kupionej waluty"  value ={{$item->ilosc}}><br/></div>
      <div id = prawa class="search_select_box">
        <select name="kupiona" class="selectpicker form-control" data-live-search="true">
           <option >{{$item->kupiona}}</option>
          @foreach ($symbole_baza as $symbole)
          @if ($item->kupiona==$symbole->symbol)   
          @else <option >{{$symbole->symbol}}</option>
          @endif  
         
              
          @endforeach
        </select>
        </div> 
   
       
      </div>
      <div id="parent">
        <div id = "lewa"> <div id="lewa_tekst">Wybierz walutę która została sprzedana</div></div>

      <div id = prawa class="search_select_box">
      
        <select name ="sprzedana" class="selectpicker form-control" data-live-search="true">
          <option >{{$item->sprzedana}}</option>
          @foreach ($symbole_baza as $symbole)
         
          @if ($item->sprzedana == $symbole->symbol)
              
          @else
          <option >{{$symbole->symbol}}</option>

          @endif
          
  
          @endforeach
        </select>
        </div> 
      </div>

      <input type="text" name="cena" id="pole_tekstowe" class="form-control" placeholder="Cena" value={{$item->cena}} ><br/>
       
       
        <input id="aktywna" name="status" type="hidden" value="aktywna">
        <input id="aktywna" name="id" type="hidden" value={{$item->id}}>
       
         <button type="submit" class="btn btn-success form-control">Zapisz zmiany</button>
 
          </form>
      </div>
       </div>
       <div class="modal-footer">
       <a id ='anuluj' role="button" data-dismiss="modal" class="btn btn-danger form-control">Anuluj</a>
       </div>
     </div>
   </div>
 </div>








              </td>
               <td>
                                   <!-- Przycisk do zamknij pozycje modalny -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal{{$item->id}}">
    Zamknij pozycję
   </button>
   <!-- Okienko wyskakujące -->
   <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Zamykanie pozycji</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           Czy chcesz wprowadzić własną cenę zamknięcia ?
           <div class="form-group" >
           <form id="form{{$item->id}}" action="{{'cena/'.$item->id}}" method="post" style="display: none;"> 
            @csrf
            <input type="text" name="edit_cena"  class="form-control" placeholder="Podaj cenę zamknięcia" >
            <button type="submit" class="btn btn-secondary form-control">Zapisz</button>
          </form>
        </div>
         </div>
         <div class="modal-footer">
            <button type="submit"  class="btn btn-success form-control" id="formButton" onclick="funkcja({{$item->id}})">Tak</button>
            
            <a role="button" href="{{'zamknij/'.$item->id.'/'.$item->price}}"  class="btn btn-primary form-control">Zamknij pozycje po bieżącej cenie</a>
            <a id ='anuluj' role="button" data-dismiss="modal" class="btn btn-danger form-control">Anuluj</a>
         </div>
       </div>
     </div>
   </div>
 
                
                </td>
               <td>
<!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModall{{$item->id}}">
   Usuń
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModall{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Usuwanie pozycji</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Czy na pewno chcesz usunąć tę pozycję?
        </div>
        <div class="modal-footer">
            <a role="button" href="{{'usun/'.$item->id}}"   class="btn btn-success form-control">Tak</a>
          <button type="button" class="btn btn-secondary form-control" data-dismiss="modal">Anuluj</button>
         
        </div>
      </div>
    </div>
  </div>
               </td>
          
               
               </tr>

               <!-- Okno wyswietlajace szcegoly transakcji-->
                    
<div class="modal fade" id="center{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Szczegóły transakcji</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
          <div class="container">
                                  <div class="row">
                                    <div class="col">Cena kupna</div>
                                    <div class="col-5">Wartość transakcji</div>
                                    <div class="col">Zysk (%)</div>
                                  </div>
            <div class="row">
              <div class="col">{{$item->cena}}</div>
              <div class="col-5">{{$item->wartosc_transakcji}}</div>
             
                @if ($item->procent<=0)
            
                <div id="minus" class="col"> {{$item->procent}} &nbsp; % </div>
                @else
                <div id="plus" class="col">+{{$item->procent}} &nbsp; % </div>
                @endif
             </div>
         
           
           
          </div>

        
          </div> 
          
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
        </div>
        </div>
       
    </div>

           @endforeach 
             @endif
            
        </table>
          </div>
</div>
      </div>
        <div id='paginate'> {{$dane->links('pagination::bootstrap-4')}}</div>
        
    
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
