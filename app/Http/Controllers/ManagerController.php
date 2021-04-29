<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Http\Request;

use App\Models\Kind;
use Validator;


class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kinds = Kind::all();

        //FILTRAVIMAS
        if ($request->kind_id) {
            $managers = Manager::where('kind_id', $request->kind_id)->get();
            $filterBy = $request->kind_id;
        }
        else {
            $managers = Manager::all();
        }

        //RUSIAVIMAS
        if ($request->sort && 'asc' == $request->sort) {
            $managers = $managers->sortBy('surname', SORT_NATURAL|SORT_FLAG_CASE); //nejautrus raidziu dydziui
            $sortBy = 'asc';
        }
        elseif ($request->sort && 'desc' == $request->sort) {
            $managers = $managers->sortByDesc('surname', SORT_NATURAL|SORT_FLAG_CASE);
            $sortBy = 'desc';
        }
        
        return view('manager.index', [
            'managers' => $managers,
            'kinds' => $kinds,
            'filterBy' => $filterBy ?? 0,
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
        $kinds = Kind::all();
        return view('manager.create', ['kinds' => $kinds]);
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
            'manager_name' => ['required', 'min:3', 'max:64'],
            'manager_surname' => ['required', 'min:3', 'max:64'],
        ],
        // optional argument'as/ai, naudojami pronesimui
        [
            'manager_name.required' => 'pridek vardą!',
            'manager_name.min' => 'per trumpas vardas!',
            'manager_name.max' => 'ar tikrai vardas tokio ilgumo?',

            'manager_surname.required' => 'pridek pavardę!',
            'manager_surname.min' => 'per trumpa pavardė!',
            'manager_surname.max' => 'ar tikrai pavardė tokio ilgumo?',

        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $manager = new Manager();
        $manager->name = $request->manager_name;
        $manager->surname = $request->manager_surname;
        $manager->kind_id = $request->kind_id;
        $manager->save();
        
        return redirect()->route('manager.index')->with('success_message', 'Sekmingai įrašytas.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function show(Manager $manager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function edit(Manager $manager)
    {
        $kinds = Kind::all();
        return view('manager.edit', ['manager' => $manager, 'kinds' => $kinds]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manager $manager)
    {
        $validator = Validator::make($request->all(),
        [
            'manager_name' => ['required', 'min:3', 'max:64'],
            'manager_surname' => ['required', 'min:3', 'max:64'],
        ],
        // optional argument'as/ai, naudojami pronesimui
        [
            'manager_name.required' => 'pridek vardą!',
            'manager_name.min' => 'per trumpas vardas!',
            'manager_name.max' => 'ar tikrai vardas tokio ilgumo?',

            'manager_surname.required' => 'pridek pavardę!',
            'manager_surname.min' => 'per trumpa pavardė!',
            'manager_surname.max' => 'ar tikrai pavardė tokio ilgumo?',

        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $manager->name = $request->manager_name;
        $manager->surname = $request->manager_surname;
        $manager->kind_id = $request->kind_id;
        $manager->save();
        
        return redirect()->route('manager.index')->with('success_message', 'Sekmingai pakeistas!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manager $manager)
    {

        if($manager->managerAnimals->count()) {
            return redirect()->route('manager.index')->with('info_message', 'Trinti negalima, nes turi priskirtų gyvūnų!');
        }


        $manager->delete();

        return redirect()->route('manager.index')->with('success_message', 'Sėkmingai ištrintas');
    }
}
