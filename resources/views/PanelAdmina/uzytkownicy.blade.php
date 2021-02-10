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
                    <p id="naglowek" class="font-weight-bold naglowek">Lista wszystkich użytkowników</p>
                    <table class="table table-hover">
                        
                        <tr style="font-weight: bold;"><td>ID</td> <td>Imię</td> <td>Adres e-mail</td> <td>Status</td> <td>Zmiana uprawnień</td></tr>
                      @if ($users->isEmpty())
                      <tr><td>Brak użytkowników</td></tr>
                      @else 

              @foreach ($users as $item)
                        <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>
                            @if ($item->status==1)
                            Użytkownik
                        @else
                            Administrator
                        @endif
                            </td>
                                <td>
                                    @if ($item->status==1)
                                    <button type="button"  class="btn btn-success" data-toggle="modal" data-target="#exampleModall{{$item->id}}">
                                        Administrator
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
                                               Czy na pewno chcesz przyznać temu użytkownikowi prawa administratora
                                             </div>
                                             <div class="modal-footer">
                                                 <a role="button" href="{{'zmiana-uprawnien/1/'.$item->id}}"   class="btn btn-success form-control">Tak</a>
                                               <button type="button" class="btn btn-secondary form-control" data-dismiss="modal">Anuluj</button>
                                              
                                             </div>
                                           </div>
                                         </div>
                                       </div>
                                    @else
                                       @if (Auth::id()==$item->id)
                                       <button type="button"   disabled  class="btn btn-danger" data-toggle="modal" data-target="#exampleModall{{$item->id}}">
                                        Użytkownik
                                       </button>
                                       @else
                                           
                                       
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModall{{$item->id}}">
                                        Użytkownik
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
                                               Czy na pewno chcesz odebrać temu użytkownikowi prawa administratora?
                                             </div>
                                             <div class="modal-footer">
                                                 <a role="button" href="{{'zmiana-uprawnien/0/'.$item->id}}"   class="btn btn-success form-control">Tak</a>
                                               <button type="button" class="btn btn-secondary form-control" data-dismiss="modal">Anuluj</button>
                                              
                                             </div>
                                           </div>
                                         </div>
                                       </div>
                                       @endif
                                    @endif
                                    
                        </tr>
          
               @endforeach
                    </table>
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
