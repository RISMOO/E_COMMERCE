<form action="{{route('products.search')}}" class="d-flex mr-3 ">
    <div class="form-group mb-0 mr-1">
<input type="text" name="q"  class="form-control" value="{{request()->q ?? ''}}"><!--en valeur est ce que jai 'q' dans ma requete ?? sinon on affiche rien -->
    </div>
<button type="submit" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i></button>
</form>
