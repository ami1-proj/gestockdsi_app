<?php

namespace App\Http\Controllers;

use App\EtatCommande;
use Illuminate\Http\Request;
use App\Traits\EtatCommandeTrait;
use App\Statut;


class EtatCommandeController extends Controller
{
    use EtatCommandeTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->action('ParametreController@index', ['active_tab' => 'etatcommande']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuts = Statut::get()->pluck('libelle', 'id');

        return view('etatcommandes.create')
          ->with('statuts', $statuts)
          ->with('etatcommande', (New EtatCommande()));
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

        // Store the New EtatCommande
        $etatcommande = EtatCommande::create($formInput);
        $this->unsetDefaultEtatCommande($etatcommande);

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelSaved', ['modelname' => 'Etat Commande'] ));

        return redirect()->action('ParametreController@index', ['active_tab' => 'etatcommande']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EtatCommande  $etatCommande
     * @return \Illuminate\Http\Response
     */
    public function show(EtatCommande $etatcommande)
    {
        $etatcommande = EtatCommande::with(['statut'])->where('id', $etatcommande->id)->first();
        return view('etatcommandes.show', ['etatcommande' => $etatcommande]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EtatCommande  $etatCommande
     * @return \Illuminate\Http\Response
     */
    public function edit(EtatCommande $etatcommande)
    {
        $statuts = Statut::get()->pluck('libelle', 'id');
        $selectedtags = $this->getTags($etatcommande->tags);

        return view('etatcommandes.edit')
          ->with('selectedtags', $selectedtags)
          ->with('statuts', $statuts)
          ->with('etatcommande', $etatcommande);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EtatCommande  $etatCommande
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EtatCommande $etatcommande)
    {
        $formInput = $request->all();

        // Formattage des INPUT de la requete
        $formInput = $this->formatRequestInput($formInput);

        $etatcommande->fill($formInput); // $request->input()
        $etatcommande->save();
        $this->unsetDefaultEtatCommande($etatcommande);

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelUpdated', ['modelname' => 'Etat Commande'] ));

        return redirect()->action('ParametreController@index', ['active_tab' => 'etatcommande']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EtatCommande  $etatCommande
     * @return \Illuminate\Http\Response
     */
    public function destroy(EtatCommande $etatcommande)
    {
        $etatcommande->delete();

        session()->flash('msg_success',__('messages.modelDeleted', ['modelname' => 'Etat Commande'] ));

        return redirect()->action('ParametreController@index', ['active_tab' => 'etatcommande']);
    }
}
