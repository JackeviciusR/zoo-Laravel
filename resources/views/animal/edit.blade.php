@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">UPDATE ANIMAL</div>

               <div class="card-body">
                 
                    {{-- BLADE TURINYS --}}
                    <form method="POST" action="{{route('animal.update', [$animal] )}}">
                        
                        <div class="form-group">
                            <label>Name:</label>
                            <input class="form-control" type="text" name="animal_name" value="{{old('animal_name', $animal->name)}}">
                            <small class="form-text text-muted">Please enter animal name</small>
                        </div>
                        <div class="form-group">
                            <label>Birth year:</label>
                            <input class="form-control" type="text" name="animal_birth_year"  value="{{old('animal_birth_year', $animal->birth_year)}}"> {{-- po suzaibavimo, ivykus klaidai, seni parametrai erduodami is trumpalaikes atminties su old() funkcija --}}
                            <small class="form-text text-muted">Please enter animal birth year</small>
                        </div>
                        <div class="form-group">  
                            <label>Book:</label>
                            <textarea id="summernote" class="form-control" name="animal_book">{{old('animal_book', $animal->animal_book)}}</textarea>
                            <small class="form-text text-muted">About this animal</small>
                        </div>
                        
                        <div class="form-group"> 
                            <label>Kind:</label>
                            <select class="form-control" name="kind_id">
                            @foreach ($kinds as $kind)
                                <option value="{{$kind->id}}" @if($kind->id == $animal->kind_id) selected @endif>
                                    {{$kind->name}}
                                </option>
                            @endforeach
                            </select>
                            <small class="form-text text-muted">Please select kind (species) name</small>
                        </div>
                        <div class="form-group"> 
                            <label>Manager:</label>
                            <select class="form-control" name="manager_id">
                            @foreach ($managers as $manager)
                                <option value="{{$manager->id}}" @if($manager->id == $animal->manager_id) selected @endif >
                                    {{$manager->name}} {{$manager->surname}}
                                </option>
                            @endforeach
                            </select>
                            <small class="form-text text-muted">Please select manager name</small>
                        </div>

                        @csrf
                        <button type="submit" class="btn btn-primary">ADD</button>
                    
                    </form>

               </div>
           </div>
       </div>
   </div>
</div>

<script>
    // klausome event'o. Kai viskas uzsikrauna tuo tarpu ir javascript'as,
    // kreipiamias i summernote.
    window.addEventListener('DOMContentLoaded', (event)=> {
        $('#summernote').summernote();
    });

 
    //  Tam, kad summernote nesikrautu be javascripto (be jquery'io), mes ji
    // irgi sudefiriname, t.y. layouts->app.blade.php faile ne tik js padarom defer,
    // bet ir summernote krovima, kad pirma pasikrautu tinklapis, tada js, o tik tada summernote'as
</script>

@endsection