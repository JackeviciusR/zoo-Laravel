@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-10">
           <div class="card">
               <div class="card-header">
               
                    <h2>ANIMALS List</h2>
               
                    <div class="make-inline">
                        <form action="{{route('animal.index')}}" method="get" class="make-inline">
                            
                            <div class="make-inline">
                                <div class="form-group make-inline">
                                    <label>Kind: </label>
                                    <select class="form-control" name="kind_id">
                                    <option value="0" disabled @if($kindFilterBy == 0) selected @endif>Select Kind</option>
                                        @foreach ($kinds as $kind)
                                            <option value="{{$kind->id}}" @if($kindFilterBy == $kind->id) selected @endif>
                                                {{$kind->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group make-inline">
                                    <label>Manager: </label>
                                    <select class="form-control" name="manager_id">
                                    <option value="0" disabled @if($managerFilterBy == 0) selected @endif>Select Manager</option>
                                        @foreach ($managers as $manager)
                                            <option value="{{$manager->id}}" @if($managerFilterBy == $manager->id) selected @endif>
                                                {{$manager->name}} {{$manager->surname}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="make-inline">
                                <label class="form-check-label" >Sort by animal name:</label>
                                
                                <label class="form-check-label" for="sortASC">ASC</label>
                                <div class="form-group make-inline column">
                                    <input type="radio" class="form-check-input" name="sort" value="asc" id="sortASC" @if($sortBy == 'asc') checked @endif>
                                </div>
                                
                                <label class="form-check-label" for="sortDESC">DESC</label>
                                <div class="form-group make-inline column">
                                    <input type="radio" class="form-check-input" name="sort" value="desc" id="sortDESC" @if($sortBy == 'desc') checked @endif>
                                </div>

                                <button type="submit" class="btn btn-info" style="margin: 0 10px;">Start</button>
                            </div>
                        </form>
                    
                        <a href="{{route('animal.index')}}"  class="btn btn-info">List</a>

                    </div>

                </div>

                <div class="card-body">

                    {{-- BLADE TURINYS --}}

                    <ul class="list-group">
                        @foreach ($animals as $animal)
                            <li class="list-group-item list-line">
                                <div class="list-line__animals">
                                    <div class="list-line__animals__name">
                                        {{$animal->name}}
                                    </div>
                                    <div class="list-line__animals__kind">
                                        {{$animal->animalKind->name}}
                                    </div>
                                    <div class="list-line__animals__manager">
                                        {{$animal->animalManager->name}} {{$animal->animalManager->surname}}
                                    </div>
                                </div>
                                <div class="list-line__buttons">
                                    {{-- <a href="{{route('animal.show',[$animal])}}" class="btn btn-info">SHOW</a> --}}
                                    <a href="{{route('animal.edit',[$animal])}}" class="btn btn-info">EDIT</a>
                                    <form method="POST" action="{{route('animal.destroy', [$animal])}}">
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
