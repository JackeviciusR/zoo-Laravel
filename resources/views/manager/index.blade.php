@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">
               
                    <h2>MANAGERS List</h2>
               
                    <div class="make-inline">
                        <form action="{{route('manager.index')}}" method="get" class="make-inline">
                            <div class="form-group make-inline">
                                <label>Kind: </label>
                                <select class="form-control" name="kind_id">
                                <option value="0" disabled @if($filterBy == 0) selected @endif>Select Kind</option>
                                    @foreach ($kinds as $kind)
                                        <option value="{{$kind->id}}" @if($filterBy == $kind->id) selected @endif>
                                            {{$kind->name}} {{$kind->surname}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <label class="form-check-label" >Sort by surname:</label>
                            
                            <label class="form-check-label" for="sortASC">ASC</label>
                            <div class="form-group make-inline column">
                                <input type="radio" class="form-check-input" name="sort" value="asc" id="sortASC" @if($sortBy == 'asc') checked @endif>
                            </div>
                            
                            <label class="form-check-label" for="sortDESC">DESC</label>
                            <div class="form-group make-inline column">
                                <input type="radio" class="form-check-input" name="sort" value="desc" id="sortDESC" @if($sortBy == 'desc') checked @endif>
                            </div>

                            <button type="submit" class="btn btn-info" style="margin: 0 10px;">Start</button>
                        </form>
                    
                        <a href="{{route('manager.index')}}"  class="btn btn-info">List</a>

                    </div>

                </div>

                <div class="card-body">

                    {{-- BLADE TURINYS --}}

                    <ul class="list-group">
                        @foreach ($managers as $manager)
                            <li class="list-group-item list-line">
                                <div class="list-line__managers">
                                    <div class="list-line__managers__name">
                                        {{$manager->name}} {{$manager->surname}}
                                    </div> 
                                    <div class="list-line__managers__kind">
                                        {{$manager->managerKind->name}}
                                    </div>
                                </div>
                                <div class="list-line__buttons">
                                    {{-- <a href="{{route('manager.show',[$manager])}}" class="btn btn-info">SHOW</a> --}}
                                    <a href="{{route('manager.edit',[$manager])}}" class="btn btn-info">EDIT</a>
                                    <form method="POST" action="{{route('manager.destroy', [$manager])}}">
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
