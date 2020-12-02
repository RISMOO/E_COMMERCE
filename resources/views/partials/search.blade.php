
<button type="button" class="btn btn-light caca"  data-toggle="modal" data-target="#myModal"><img src="{{asset('img/loupe.png')}}" alt="A 50x50 image"></button>





<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        </div>
        <div class="modal-body">

          <h1>Rechercher</h1>
          <form action="{{route('products.search')}}"  class="navbar-form " role="Rechercher">
            <div class="form-group">
              <input type="text" name="q" class="form-control" value="{{request()->q ?? ''}}" placeholder="rechercher...">
            </div>
            <button type="submit" class="btn btn-info">Rechercher</button>
          </form>
        </div>
      </div>
    </div>
    </div>
