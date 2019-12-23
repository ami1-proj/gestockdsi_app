<?php

namespace App\Http\Controllers;

use App\EtatArticle;
use Illuminate\Http\Request;
use App\Traits\EtatArticleTrait;
use App\Statut;


class EtatArticleController extends Controller
{
    use EtatArticleTrait;

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
        return redirect()->action('ParametreController@index', ['active_tab' => 'etatarticle']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuts = Statut::get()->pluck('libelle', 'id');

        return view('etatarticles.create')
          ->with('statuts', $statuts)
          ->with('etatarticle', (New EtatArticle()));
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

        // Store the New Employe
        $etatarticle = EtatArticle::create($formInput);
        $this->unsetDefaultEtatArticle($etatarticle);

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelSaved', ['modelname' => 'Etat Article'] ));

        //return redirect()->action('ParametreController@index');
        return $this->redirectToParametre();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EtatArticle  $etatArticle
     * @return \Illuminate\Http\Response
     */
    public function show(EtatArticle $etatarticle)
    {
        $etatarticle = EtatArticle::with(['statut'])->where('id', $etatarticle->id)->first();
        return view('etatarticles.show', ['etatarticle' => $etatarticle]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EtatArticle  $etatArticle
     * @return \Illuminate\Http\Response
     */
    public function edit(EtatArticle $etatarticle)
    {
        $statuts = Statut::get()->pluck('libelle', 'id');
        $selectedtags = $this->getTags($etatarticle->tags);

        return view('etatarticles.edit')
          ->with('selectedtags', $selectedtags)
          ->with('statuts', $statuts)
          ->with('etatarticle', $etatarticle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EtatArticle  $etatArticle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EtatArticle $etatarticle)
    {
        $formInput = $request->all();

        // Formattage des INPUT de la requete
        $formInput = $this->formatRequestInput($formInput);

        $etatarticle->fill($formInput);
        $etatarticle->save();
        $this->unsetDefaultEtatArticle($etatarticle);

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelUpdated', ['modelname' => 'Etat Article'] ));

        //return redirect()->action('ParametreController@index');
        return $this->redirectToParametre();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EtatArticle  $etatArticle
     * @return \Illuminate\Http\Response
     */
    public function destroy(EtatArticle $etatarticle)
    {
        $etatarticle->delete();

        session()->flash('msg_success',__('messages.modelDeleted', ['modelname' => 'Etat Article'] ));

        //return redirect()->action('ParametreController@index');
        return $this->redirectToParametre();
    }
}
