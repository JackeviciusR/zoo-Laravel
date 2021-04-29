@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">CREATE NEW KIND (species)</div>
               <div class="card-body">
                    
                    {{-- BLADE TURINYS --}}
                    <form method="POST" action="{{route('kind.store')}}">
                        
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" name="kind_name" value="{{old('kind_name')}}"> 
                            <small class="form-text text-muted">Please enter new kind</small>
                        </div>
                                                
                        @csrf
                        <button type="submit" class="btn btn-primary">ADD</button>

                    </form>

               </div>
           </div>
       </div>
   </div>
</div>
@endsection