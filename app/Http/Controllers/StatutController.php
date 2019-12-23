<?php

namespace App\Http\Controllers;

use App\Statut;
use Illuminate\Http\Request;
use App\Traits\StatutTrait;

class StatutController extends Controller
{
    use StatutTrait;

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
        return redirect()->action('ParametreController@index', ['active_tab' => 'statut']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('statuts.create')
          ->with('statut', (New Statut()));
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

        // Store the New Statut
        $statut = Statut::create($formInput);
        $this->unsetDefaultStatut($statut);

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelSaved', ['modelname' => 'Statut'] ));

        return $this->redirectToParametre();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Statut  $statut
     * @return \Illuminate\Http\Response
     */
    public function show(Statut $statut)
    {
        $statut = Statut::where('id', $statut->id)->first();
        return view('statuts.show', ['statut' => $statut]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Statut  $statut
     * @return \Illuminate\Http\Response
     */
    public function edit(Statut $statut)
    {
        $selectedtags = $this->getTags($statut->tags);

        return view('statuts.edit')
          ->with('selectedtags', $selectedtags)
          ->with('statut', $statut);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Statut  $statut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Statut $statut)
    {
        $formInput = $request->all();

        // Formattage des INPUT de la requete
        $formInput = $this->formatRequestInput($formInput);

        $statut->fill($formInput);

        $statut->save();
        $this->unsetDefaultStatut($statut);

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelUpdated', ['modelname' => 'Statut'] ));

        return $this->redirectToParametre();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Statut  $statut
     * @return \Illuminate\Http\Response
     */
    public function destroy(Statut $statut)
    {
        $statut->delete();

        session()->flash('msg_success',__('messages.modelDeleted', ['modelname' => 'Statut'] ));

        return $this->redirectToParametre();
    }
}
