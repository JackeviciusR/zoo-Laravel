@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">UPDATE KIND (species)</div>

               <div class="card-body">

                    {{-- BLADE TURINYS --}}
                    <form method="POST" action="{{route('kind.update',[$kind->id])}}">
                        
                        <div class="form-group">
                            <label>Name</label>
                            {{-- Name: <input type="text" name="kind_name" value="{{$kind->name}}"> --}}
                            <input class="form-control" type="text" name="kind_name" value="{{old('kind_name', $kind->name)}}">
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