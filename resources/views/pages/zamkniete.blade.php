<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @section('tittle','Zamknięte transakcje')
  @include('nawigacja')
</head>
<body>
  
      
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
              <p id="naglowek" class="font-weight-bold naglowek">Zamknięte transakcje</p>
              <a name="" id="kup" href="{{'/kup'}}"  class="btn btn-success"  role="button">Dodaj nową transakcję</a>
              
              <table class="table table-hover">
              <tr id="head"><td>Data zamknięcia</td><td>Para</td><td>Ilość tokenów</td><td>Cena zakupu</td><td>Cena sprzedaży</td><td>Zysk / Strata</td><td colspan="3"></td></tr>
             @if ($dane->isEmpty())
            <tr><td colspan="6"><a  href="{{'kup'}}"> Brak zakończoych transakcji. Dodaj transakcje</a></td></tr>
             @else
                @foreach ($dane as $item)
        
               <tr>
                   <td>{{$item->created_at}}</td>
                  <td>{{ $item->kupiona }}/ {{$item->sprzedana}}</td>
                  <td>{{$item->ilosc}}</td>
                  <td>{{$item->cena}}</td>
                  <td>{{$item->cena_zamkniecia}} &nbsp;$</td>
                  @if ($item->zysk>0)
                      <td id="plus">+{{$item->zysk}} &nbsp;$</td>
                  @else
                      @if ($item->zysk<0)
                      <td id="minus">{{$item->zysk}} &nbsp;$</td>
                      @else 
                      <td>{{$item->zysk}} &nbsp;$</td>
                      @endif
                  @endif
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
                                <a role="button" href="{{'usunZam/'.$item->id}}"   class="btn btn-success form-control">Tak</a>
                              <button type="button" class="btn btn-secondary form-control" data-dismiss="modal">Anuluj</button>
                             
                            </div>
                          </div>
                        </div>
                      </div>
                                   </td>
            
              
              
          
               
               </tr>
           @endforeach 
           <tr> <td></td> <td></td> <td></td> <td></td> <td></td> <td>
           @if ($profit>0)
               <div class="bg-success text-white">{{$profit}} </div>
               @else 
               <div class ="bg-danger text-white"> {{$profit}}</div>
           @endif
            
            
            </td> </tr>
             @endif
              
        </table>
                    <div class = "pag">
                    <div id='paginate'> {{$dane->links('pagination::bootstrap-4')}}</div>
                    </div>
    </div>
        </div>
        
        @endauth
        @guest
          <div class="container">Zaloguj sie</div>  
        @endguest
     
        <div class="footer">
            <p>Kacper Bury</p>
          </div>
</body>
</html>
