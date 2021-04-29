@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">
                    <h4>KINDS (species) LIST</h4>

                    {{-- RUSIAVIMO MYGTUKAI --}}

                    <div class="make-inline">
                        <form action="{{route('kind.index')}}" method="get" class="make-inline">
                            <label class="form-check-label" >Sort by name:</label>
                            
                            <label class="form-check-label" for="sortASC">ASC</label>
                            <div class="form-group make-inline column">
                                <input type="radio" class="form-check-input" name="sort" value="asc" id="sortASC" @if($sortBy == 'asc') checked @endif>
                            </div>
                            
                            <label class="form-check-label" for="sortDESC">DESC</label>
                            <div class="form-group make-inline column">
                                <input type="radio" class="form-check-input" name="sort" value="desc" id="sortDESC" @if($sortBy == 'desc') checked @endif>
                            </div>

                            <button type="submit" class="btn btn-info" style="margin: 0 10px;">Sort</button>
                        </form>

                    </div>

                    {{-- <a href="{{route('kind.index', ['sort' => 'name'])}}">Sort by name</a>
                    <a href="{{route('kind.index')}}">Default</a> --}}

               </div>

               <div class="card-body">
                    
                    {{-- BLADE TURINYS --}}
                    <ul class="list-group">
                        @foreach ($kinds as $kind)
                            <li class="list-group-item list-line"> {{-- list-line musu klase --}}
                                <div>
                                    {{$kind->name}}
                                </div>
                                <div class="list-line__buttons">
                                    <a href="{{route('kind.edit',[$kind])}}" class="btn btn-info">EDIT</a>
                                    <form method="POST" action="{{route('kind.destroy', [$kind])}}">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">DELETE</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>

               </div>
           </div>
       </div>
   </div>
</div>
@endsection