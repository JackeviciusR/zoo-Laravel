<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

use App\Models\Manager;
use App\Models\Kind;
use Validator;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kinds = Kind::all();
        $managers = Manager::all();

        //FILTRAVIMAS
        if ($request->kind_id) {
            $animals = Animal::where('kind_id', $request->kind_id)->get();
            $kindFilterBy = $request->kind_id;
        }
        else {
            $animals = Animal::all();
        }

        if ($request->manager_id) {
            $animals = $animals->where('manager_id', $request->manager_id);
            $managerFilterBy = $request->manager_id;
        }

        //RUSIAVIMAS
        if ($request->sort && 'asc' == $request->sort) {
            $animals = $animals->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE); //nejautrus raidziu dydziui
            $sortBy = 'asc';
        }
        elseif ($request->sort && 'desc' == $request->sort) {
            $animals = $animals->sortByDesc('name', SORT_NATURAL|SORT_FLAG_CASE);
            $sortBy = 'desc';
        }
        
        return view('animal.index', [
            'animals' => $animals,
            'kinds' => $kinds,
            'managers' => $managers,
            'kindFilterBy' => $kindFilterBy ?? 0,
            'managerFilterBy' => $managerFilterBy ?? 0,
            'sortBy' => $sortBy ?? ''
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $managers = Manager::all();
        $kinds = Kind::all();

        // $managers = $managers->sortBy('kind_id', SORT_NATURAL|SORT_FLAG_CASE);
        $managers=$managers->sortBy(function($query) {
            return $query->managerKind->name;
        });
        return view('animal.create', ['managers' => $managers, 'kinds' => $kinds]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'animal_name' => ['required', 'min:3', 'max:64'],
            'animal_birth_year' => ['required', 'min:4', 'max:4'],
            'animal_book' => ['required', 'max:2000'],
            'kind_id' => ['required'],
            'manager_id' => ['required'],
        ],

        [
            'animal_name.required' => 'pridek vardą!',
            'animal_name.min' => 'per trumpas vardas!',
            'animal_name.max' => 'ar tikrai vardas tokio ilgumo?',

            'animal_book.max' => 'per ilgas textas, iki 2000 simbolių!',

            'kind_id.required' => 'nepasirinkta rūšis!',
            'manager_id.required' => 'nepasirinktas prižiūrėtojas!',

        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $manager = Manager::find($request->manager_id);
        if ($manager->kind_id != $request->kind_id) {
            $request->flash();
            return redirect()->back()->with('info_message', 'Animal kind manager is not correct!');
        }

        $animal = new Animal();
        $animal->name = $request->animal_name;
        $animal->birth_year = $request->animal_birth_year;
        $animal->animal_book = $request->animal_book;
        $animal->manager_id = $request->manager_id;
        $animal->kind_id = $request->kind_id;
        $animal->save();
        
        return redirect()->route('animal.index')->with('success_message', 'Sekmingai įrašytas.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function show(Animal $animal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function edit(Animal $animal)
    {
        $managers = Manager::all();
        $kinds = Kind::all();

        return view('animal.edit', ['animal' => $animal, 'managers' => $managers, 'kinds' => $kinds]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Animal $animal)
    {
        $validator = Validator::make($request->all(),
        [
            'animal_name' => ['required', 'min:3', 'max:64'],
            'animal_birth_year' => ['required', 'min:4', 'max:4'],
            'animal_book' => ['required', 'max:2000'],
            'kind_id' => ['required'],
            'manager_id' => ['required'],
        ],

        [
            'animal_name.required' => 'pridek vardą!',
            'animal_name.min' => 'per trumpas vardas!',
            'animal_name.max' => 'ar tikrai vardas tokio ilgumo?',

            'animal_book.max' => 'per ilgas textas, iki 2000 simbolių!',

            'kind_id.required' => 'nepasirinkta rūšis!',
            'manager_id.required' => 'nepasirinktas prižiūrėtojas!',

        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $manager = Manager::find($request->manager_id);
        if ($manager->kind_id != $request->kind_id) {
            $request->flash();
            return redirect()->back()->with('info_message', 'Animal kind manager is not correct!');
        }

        $animal->name = $request->animal_name;
        $animal->birth_year = $request->animal_birth_year;
        $animal->animal_book = $request->animal_book;
        $animal->manager_id = $request->manager_id;
        $animal->kind_id = $request->kind_id;
        $animal->save();
        
        return redirect()->route('animal.index')->with('success_message', 'Sekmingai įrašytas.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Animal $animal)
    {
        $animal->delete();

        return redirect()->route('animal.index')->with('success_message', 'Sekmingai istrinta');
    }
}
