@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">CREATE NEW MANAGER</div>

               <div class="card-body">
                 
                    {{-- BLADE TURINYS --}}
                    <form method="POST" action="{{route('manager.store')}}">
                        
                        <div class="form-group">
                            <label>Name:</label>
                            <input class="form-control" type="text" name="manager_name" value="{{old('manager_name')}}">
                            <small class="form-text text-muted">Please enter manager name</small>
                        </div>
                        <div class="form-group">
                            <label>Surname:</label>
                            <input class="form-control" type="text" name="manager_surname"  value="{{old('manager_surname')}}"> {{-- po suzaibavimo, ivykus klaidai, seni parametrai erduodami is trumpalaikes atminties su old() funkcija --}}
                            <small class="form-text text-muted">Please enter manager surname</small>
                        </div>
                        
                        <div class="form-group"> 
                            <label>Kind:</label>
                            <select class="form-control" name="kind_id">
                            @foreach ($kinds as $kind)
                                <option value="{{$kind->id}}">{{$kind->name}}</option>
                            @endforeach
                            </select>
                            <small class="form-text text-muted">Please select kind (species) name</small>
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


