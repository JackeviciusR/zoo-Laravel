<?php

namespace App\Http\Controllers;

use App\Models\Kind;
use Illuminate\Http\Request;

use Validator;

class KindController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

            $kinds = Kind::all();


            if ($request->sort && 'asc' == $request->sort) {
                $kinds = $kinds->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE); //nejautrus raidziu dydziui
                $sortBy = 'asc';
            }
            elseif ($request->sort && 'desc' == $request->sort) {
                $kinds = $kinds->sortByDesc('name', SORT_NATURAL|SORT_FLAG_CASE);
                $sortBy = 'desc';
            }
            
            return view('kind.index', [
                'kinds' => $kinds,
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
        return view('kind.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // VALIDATORIUS
        // Validatorius turi likti kotroleryje!!!!
        // https://laravel.com/docs/8.x/validation#available-validation-rules
        $validator = Validator::make($request->all(),
        [
            'kind_name' => ['required', 'min:3', 'max:64'],
        ],
        // optional argument'as/ai, naudojami pronesimui
        [
            'kind_name.required' => 'pridek rūšies pavadinimą!',
            'kind_name.min' => 'per trumpas pavadinimas!',
            'kind_name.max' => 'ar tikrai pavadinimas tokio ilgumo?',

        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $kind = new Kind();
        $kind->name = $request->kind_name;
        $kind->save();

        return redirect()->route('kind.index')->with('success_message', 'Sekmingai įrašytas');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kind  $kind
     * @return \Illuminate\Http\Response
     */
    public function show(Kind $kind)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kind  $kind
     * @return \Illuminate\Http\Response
     */
    public function edit(Kind $kind)
    {
        return view('kind.edit', ['kind' => $kind]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kind  $kind
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kind $kind)
    {
        $validator = Validator::make($request->all(),
        [
            'kind_name' => ['required', 'min:3', 'max:64'],
        ],
        // optional argument'as/ai, naudojami pronesimui
        [
            'kind_name.required' => 'pridek rūšies pavadinimą!',
            'kind_name.min' => 'per trumpas pavadinimas!',
            'kind_name.max' => 'ar tikrai pavadinimas tokio ilgumo?',

        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $kind->name = $request->kind_name;
        $kind->save();

        return redirect()->route('kind.index')->with('success_message', 'Sekmingai pakeistas');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kind  $kind
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kind $kind)
    {
        if($kind->kindManagers->count()){
            return redirect()->route('kind.index')->with('info_message', 'Trinti negalima, nes yra šios rūšies prižiūrėtojų!');
        } else if($kind->kindAnimals->count()){
            return redirect()->route('kind.index')->with('info_message', 'Trinti negalima, nes yra šios rūšies gyvūnų!');
        }

        $kind->delete();
        // return redirect()->route('kind.index');
        return redirect()->route('kind.index')->with('success_message', 'Sekmingai ištrintas.');

    }
}
