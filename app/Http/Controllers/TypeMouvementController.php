<?php

namespace App\Http\Controllers;

use App\TypeMouvement;
use Illuminate\Http\Request;
use App\Http\Requests\TypeMouvementRequest;
use App\Traits\TypeMouvementTrait;
use App\Statut;


class TypeMouvementController extends Controller
{
    use TypeMouvementTrait;
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
        return redirect()->action('ParametreController@index', ['active_tab' => 'typemouvement']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuts = Statut::get()->pluck('libelle', 'id');

        return view('typemouvements.create')
          ->with('statuts', $statuts)
          ->with('typemouvement', (New TypeMouvement()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeMouvementRequest $request)
    {
        $formInput = $request->all();
        // Formattage des INPUT de la requete
        $formInput = $this->formatRequestInput($formInput);

        // Store the New TypeMouvement
        $typemouvement = TypeMouvement::create($formInput);
        $this->unsetDefaultTypeMouvement($typemouvement);

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelSaved', ['modelname' => 'Type Mouvement'] ));

        return $this->redirectToParametre();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TypeMouvement  $typemouvement
     * @return \Illuminate\Http\Response
     */
    public function show(TypeMouvement $typemouvement)
    {
        $typemouvement = TypeMouvement::with(['statut'])->where('id', $typemouvement->id)->first();
        return view('typemouvements.show', ['typemouvement' => $typemouvement]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypeMouvement  $typemouvement
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeMouvement $typemouvement)
    {
        $statuts = Statut::get()->pluck('libelle', 'id');
        $selectedtags = $this->getTags($typemouvement->tags);

        return view('typemouvements.edit')
          ->with('selectedtags', $selectedtags)
          ->with('statuts', $statuts)
          ->with('typemouvement', $typemouvement);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TypeMouvement  $typemouvement
     * @return \Illuminate\Http\Response
     */
    public function update(TypeMouvementRequest $request, TypeMouvement $typemouvement)
    {
        $formInput = $request->all();

        // Formattage des INPUT de la requete
        $formInput = $this->formatRequestInput($formInput);

        $typemouvement->fill($formInput); // $request->input()
        $typemouvement->save();
        $this->unsetDefaultTypeMouvement($typemouvement);

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelUpdated', ['modelname' => 'Type Mouvement'] ));

        return $this->redirectToParametre();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TypeMouvement  $typemouvement
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeMouvement $typemouvement)
    {
        $typemouvement->delete();

        session()->flash('msg_success',__('messages.modelDeleted', ['modelname' => 'Type Mouvement'] ));

        return $this->redirectToParametre();
    }
}
