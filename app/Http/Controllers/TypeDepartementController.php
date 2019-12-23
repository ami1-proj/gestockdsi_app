<?php

namespace App\Http\Controllers;

use App\TypeDepartement;
use Illuminate\Http\Request;
use App\Traits\TypeDepartementTrait;
use App\Statut;

class TypeDepartementController extends Controller
{
    use TypeDepartementTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->redirectToParametre();
    }

    private function redirectToParametre(){
        return redirect()->action('ParametreController@index', ['active_tab' => 'typedepartement']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuts = Statut::get()->pluck('libelle', 'id');

        return view('typedepartements.create')
          ->with('statuts', $statuts)
          ->with('typedepartement', (New TypeDepartement()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formInput = $request->all();
        // Formattage des INPUT de la requete
        $formInput = $this->formatRequestInput($formInput);

        // Store the New TypeDepartement
        $typedepartement = TypeDepartement::create($formInput);
        $this->unsetDefaultTypeDepartement($typedepartement);

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelSaved', ['modelname' => 'Type Affectation'] ));

        return $this->redirectToParametre();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TypeDepartement  $typedepartement
     * @return \Illuminate\Http\Response
     */
    public function show(TypeDepartement $typedepartement)
    {
        $typedepartement = TypeDepartement::with(['statut'])->where('id', $typedepartement->id)->first();
        return view('typedepartements.show', ['typedepartement' => $typedepartement]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypeDepartement  $typedepartement
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeDepartement $typedepartement)
    {
        $statuts = Statut::get()->pluck('libelle', 'id');
        $selectedtags = $this->getTags($typedepartement->tags);

        return view('typedepartements.edit')
          ->with('selectedtags', $selectedtags)
          ->with('statuts', $statuts)
          ->with('typedepartement', $typedepartement);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TypeDepartement  $typedepartement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeDepartement $typedepartement)
    {
        $formInput = $request->all();

        // Formattage des INPUT de la requete
        $formInput = $this->formatRequestInput($formInput);

        $typedepartement->fill($formInput); // $request->input()
        $typedepartement->save();
        $this->unsetDefaultTypeDepartement($typedepartement);

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelUpdated', ['modelname' => 'Type Affectation'] ));

        return $this->redirectToParametre();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TypeDepartement  $typedepartement
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeDepartement $typedepartement)
    {
        $typedepartement->delete();

        session()->flash('msg_success',__('messages.modelDeleted', ['modelname' => 'Type Affectation'] ));

        return $this->redirectToParametre();
    }
}
