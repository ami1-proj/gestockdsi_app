<?php

namespace App\Http\Controllers;

use App\Affectation;
use Illuminate\Http\Request;

use App\Traits\AffectationTrait;
use App\TypeMouvement;
use App\Article;
use App\TypeAffectation;

class AffectationController extends Controller
{
    use AffectationTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Affectation  $affectation
     * @return \Illuminate\Http\Response
     */
    public function show(Affectation $affectation)
    {
        //dd($affectation);
        $affectation = Affectation::with(['statut','affectationarticles'])->where('id', $affectation->id)->first();
        $elem_arr = $this->getElemArr($affectation->typeAffectation->tags, $affectation->elem()->id);

        return view('affectations.show', ['affectation' => $affectation, 'elem_arr' => $elem_arr]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Affectation  $affectation
     * @return \Illuminate\Http\Response
     */
    public function edit(Affectation $affectation)
    {
        $type_mouvements = TypeMouvement::nonSystem()->get()->pluck('libelle', 'id');
        $affectation = Affectation::with(['statut','affectationarticles','typeAffectation'])->where('id', $affectation->id)->first();
        $elem_arr = $this->getElemArr($affectation->typeAffectation->tags, $affectation->elem()->id);
        $articles_disponibles = Article::disponibles()->get()->pluck('reference_complete', 'id');

        return view('affectations.edit')
          ->with('affectation', $affectation)
          ->with('elem_arr', $elem_arr)
          ->with('type_mouvements', $type_mouvements)
          ->with('articles_disponibles', $articles_disponibles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Affectation  $affectation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Affectation $affectation)
    {
        // Validate the form
        $request->validate([
          'objet' => 'required',
          'type_mouvement_id' => 'required',
          'details' => 'required',
        ]);

        $type_affectation = TypeAffectation::find($affectation->type_affectation_id);
        $formInput = $request->all();

        $liste_article_a_ajouter = null;
        $liste_article_a_retirer = null;

        if(array_key_exists('articles_disponibles', $formInput)) {
            $liste_article_a_ajouter = $formInput['articles_disponibles'];
        }

        if(array_key_exists('liste_articles_affectes', $formInput)) {
            $liste_article_a_retirer = $formInput['liste_articles_affectes'];
        }

        $type_mouvement_id = $formInput['type_mouvement_id'];
        $details = $formInput['details'];
        $elem_id = $formInput['elem_id'];

        // Retrait des entrees non contenues dans la table affectation
        $formInput = $this->formatRequestInput($formInput);

        $upd_rst = $this->updateOne($affectation->id, $formInput, $type_mouvement_id, $details, $liste_article_a_ajouter, $liste_article_a_retirer);

        // Sessions Message
        if ($upd_rst == 1) {
          $request->session()->flash('msg_success',__('messages.affectationUpdated', ['affectationtype' => $type_affectation->libelle] ));
        } else {
          $request->session()->flash('msg_danger',__('messages.affectationCantBeEmpty'));
        }

        $show_controller = $affectation->typeAffectation->tags . 'Controller@' . 'show';

        return redirect()->action($show_controller, $affectation->elem()->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Affectation  $affectation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Affectation $affectation)
    {
        $type_affectation = TypeAffectation::find($affectation->type_affectation_id);
        $this->delateOne($affectation->id);

        // Sessions Message
        session()->flash('msg_success',__('messages.affectationDelated', ['affectationtype' => $type_affectation->libelle] ));

        $show_controller = $affectation->typeAffectation->tags . 'Controller@' . 'show';

        return redirect()->action($show_controller, $affectation->elem()->id);
    }

    // Affectations Elem
    public function elemcreate($type_affectation_tag, $elem_id)
    {
        $q = null;
        $type_affectation = TypeAffectation::tagged($type_affectation_tag)->first();
        $elem_arr = $this->getElemArr($type_affectation_tag, $elem_id);
        $articles_disponibles = Article::disponibles()->get()->pluck('reference_complete', 'id');

        return view('affectations.elemcreate')
          ->with('articles_disponibles', $articles_disponibles)
          ->with('type_affectation', $type_affectation)
          ->with('elem_arr', $elem_arr)
          ->with('q', $q)
          ;
    }

    public function elemstore(Request $request, $type_affectation_tag, $elem_id)
    {
        // Validate the form
        $formInput = $request->all();
        
        if ($request['action'] == 'search-articles') {
            if ($request->has('q')) $q = $formInput['q'];

            $type_affectation = TypeAffectation::tagged($type_affectation_tag)->first();
            $elem_arr = $this->getElemArr($type_affectation_tag, $elem_id);
            $articles_disponibles = Article::search($q)->disponibles()->get()->pluck('reference_complete', 'id');

            $articles_a_affecter_disponibles = [];

            return view('affectations.elemcreate')
              ->with('articles_disponibles', $articles_disponibles)
              ->with('type_affectation', $type_affectation)
              ->with('elem_arr', $elem_arr)
              ->with('q', $q)
              ;
        } elseif ($request['action'] == 'down') {

        } elseif($request['action'] == 'down') {

        } else {
          $request->validate([
            'objet' => 'required',
            'liste_articles' => 'required',
          ]);
        }

        $type_affectation = TypeAffectation::tagged($type_affectation_tag)->first();
        $formInput = $request->all();
        $this->createNew($formInput['objet'], $type_affectation_tag, $elem_id ,$formInput['liste_articles']);

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.affectationCreated', ['affectationtype' => $type_affectation->libelle] ));

        $show_controller = $type_affectation_tag . 'Controller@' . 'show';

        return redirect()->action($show_controller, $elem_id);
    }
}
