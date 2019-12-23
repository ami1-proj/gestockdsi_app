<?php

namespace App\Http\Controllers;

use App\Affectation;
use Illuminate\Http\Request;

use App\Traits\AffectationTrait;
use App\TypeMouvement;
use App\Article;
use App\TypeAffectation;
use Illuminate\Support\Carbon;


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
        //$articles_disponibles = Article::disponibles()->get()->pluck('reference_complete', 'id');

        // return view('affectations.edit')
        //   ->with('affectation', $affectation)
        //   ->with('elem_arr', $elem_arr)
        //   ->with('type_mouvements', $type_mouvements)
        //   ->with('articles_disponibles', $articles_disponibles);

        $q = null;
        //$type_affectation = TypeAffectation::tagged($type_affectation_tag)->first();
        //$elem_arr = $this->getElemArr($type_affectation_tag, $elem_id);
        //$articles_disponibles = Article::disponibles()->get()->pluck('reference_complete', 'id')->toArray();

        $articles_disponibles = Article::disponibles()->get()->pluck('reference_complete', 'id')->toArray();

        $articles_a_affecter_ids = Article::join("affectation_article","affectation_article.article_id","=","articles.id")
            ->where("affectation_article.affectation_id", $affectation->id)
            ->get()
            ->pluck('article_id')->toArray();

        $articles_a_affecter = Article::whereIn('id', $articles_a_affecter_ids)->get()->pluck('reference_complete', 'id')->toArray();

        $nowdate = Carbon::now();

        //$articles_a_affecter = $affectation->affectationarticles->toArray();
        $articles_a_affecter_json = json_encode($articles_a_affecter);
        $articles_disponibles_json = json_encode($articles_disponibles);

        //dd($articles_a_affecter,$articles_a_affecter_json);

        return view('affectations.edit')
          ->with('articles_disponibles', $articles_disponibles)
          ->with('elem_arr', $elem_arr)
          ->with('articles_a_affecter', $articles_a_affecter)
          ->with('q', $q)
          ->with('nowdate', $nowdate)
          ->with('articles_a_affecter_json', $articles_a_affecter_json)
          ->with('articles_disponibles_json', $articles_disponibles_json)
          ->with('type_mouvements', $type_mouvements)
          ->with('affectation', $affectation)
          ;
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
            $formInput = $request->all();
            $nowdate = Carbon::now();
            $q = $request->has('q') ? $formInput['q'] : '';

            $type_mouvements = TypeMouvement::nonSystem()->get()->pluck('libelle', 'id');

            if ($request->has('articles_a_affecter'))
              $articles_a_affecter = $formInput['articles_a_affecter'];
            else
              $articles_a_affecter = null;

            if ($request['action'] == 'search-articles') {

                //$type_affectation = TypeAffectation::tagged($type_affectation_tag)->first();
                $elem_arr = $this->getElemArr($affectation->typeAffectation->tags, $affectation->elem()->id);

                $articles_a_affecter_json = $formInput['articles_a_affecter'];
                $articles_a_affecter = json_decode($articles_a_affecter_json, true);

                $articles_a_affecter_ids = $articles_a_affecter ? array_keys($articles_a_affecter) : [];

                // Recherche articles disponibles en fonction du critère fourni
                $articles_disponibles = Article::search($q)->disponibles()->whereNotIn('id', $articles_a_affecter_ids)->get()->pluck('reference_complete', 'id')->toArray();

                $articles_disponibles_json = json_encode($articles_disponibles);

                return view('affectations.edit')
                    ->with('articles_disponibles', $articles_disponibles)
                    ->with('articles_a_affecter', $articles_a_affecter)
                    ->with('articles_disponibles_json', $articles_disponibles_json)
                    ->with('articles_a_affecter_json', $articles_a_affecter_json)
                    ->with('elem_arr', $elem_arr)
                    ->with('q', $q)
                    ->with('nowdate', $nowdate)
                    ->with('type_mouvements', $type_mouvements)
                    ->with('affectation', $affectation)
                  ;
            } elseif ($request['action'] == 'add-articles') {

                //$type_affectation = TypeAffectation::tagged($type_affectation_tag)->first();
                $elem_arr = $this->getElemArr($affectation->typeAffectation->tags, $affectation->elem()->id);

                $articles_disponibles_json = $formInput['articles_disponibles'];
                $articles_a_affecter_json = $formInput['articles_a_affecter'];
                $articles_disponibles = json_decode($articles_disponibles_json, true);
                $articles_a_affecter = json_decode($articles_a_affecter_json, true);

                // Des articles à ajouter dans la liste d articles a affecter
                if(array_key_exists('articles_disponibles_selected', $formInput)) {
                    $new_lists = $this->addRemoveArticles($articles_disponibles, $articles_a_affecter, $formInput['articles_disponibles_selected']);

                    $articles_disponibles = $new_lists[0];
                    $articles_a_affecter = $new_lists[1];
                    $articles_disponibles_json = $new_lists[2];
                    $articles_a_affecter_json = $new_lists[3];
                }

                return view('affectations.edit')
                  ->with('articles_disponibles', $articles_disponibles)
                  ->with('articles_a_affecter', $articles_a_affecter)
                  ->with('articles_disponibles_json', $articles_disponibles_json)
                  ->with('articles_a_affecter_json', $articles_a_affecter_json)
                  ->with('elem_arr', $elem_arr)
                  ->with('q', $q)
                  ->with('nowdate', $nowdate)
                  ->with('type_mouvements', $type_mouvements)
                  ->with('affectation', $affectation)
                  ;
            } elseif($request['action'] == 'remove-articles') {
              if(array_key_exists('articles_a_affecter_selected', $formInput)) {
                  $liste_article_a_ajouter = $formInput['articles_disponibles'];
              }

                  //$type_affectation = TypeAffectation::tagged($type_affectation_tag)->first();
                  $elem_arr = $this->getElemArr($affectation->typeAffectation->tags, $affectation->elem()->id);

                  $articles_disponibles_json = $formInput['articles_disponibles'];
                  $articles_a_affecter_json = $formInput['articles_a_affecter'];
                  $articles_disponibles = json_decode($articles_disponibles_json, true);
                  $articles_a_affecter = json_decode($articles_a_affecter_json, true);

                  // Des articles à ajouter dans la liste d articles a affecter
                  if(array_key_exists('articles_a_affecter_selected', $formInput)) {
                      $new_lists = $this->addRemoveArticles($articles_a_affecter, $articles_disponibles, $formInput['articles_a_affecter_selected']);

                      $articles_a_affecter = $new_lists[0];
                      $articles_disponibles = $new_lists[1];
                      $articles_a_affecter_json = $new_lists[2];
                      $articles_disponibles_json = $new_lists[3];
                  }

                  return view('affectations.edit')
                    ->with('articles_disponibles', $articles_disponibles)
                    ->with('articles_a_affecter', $articles_a_affecter)
                    ->with('articles_disponibles_json', $articles_disponibles_json)
                    ->with('articles_a_affecter_json', $articles_a_affecter_json)
                    ->with('elem_arr', $elem_arr)
                    ->with('q', $q)
                    ->with('nowdate', $nowdate)
                    ->with('type_mouvements', $type_mouvements)
                    ->with('affectation', $affectation)
                    ;

            } else {
                // Validate the form
                $request->validate([
                  'objet' => 'required',
                  'type_mouvement_id' => 'required',
                  'details' => 'required',
                  'articles_a_affecter' => 'required',
                  'date_debut' => 'required|date',
                ]);
            }


            $liste_article_a_retirer = Article::join("affectation_article","affectation_article.article_id","=","articles.id")
                ->where("affectation_article.affectation_id", $affectation->id)
                ->get()
                ->pluck('article_id')->toArray();

            $articles_a_affecter = json_decode($articles_a_affecter_json, true);

        // Validate the form
        // $request->validate([
        //   'objet' => 'required',
        //   'type_mouvement_id' => 'required',
        //   'details' => 'required',
        // ]);
        //
        // $type_affectation = TypeAffectation::find($affectation->type_affectation_id);
        // $formInput = $request->all();
        //
        // $liste_article_a_ajouter = null;
        // $liste_article_a_retirer = null;
        //
        // if(array_key_exists('articles_disponibles', $formInput)) {
        //     $liste_article_a_ajouter = $formInput['articles_disponibles'];
        // }
        //
        // if(array_key_exists('liste_articles_affectes', $formInput)) {
        //     $liste_article_a_retirer = $formInput['liste_articles_affectes'];
        // }

        $type_mouvement_id = $formInput['type_mouvement_id'];
        $details = $formInput['details'];
        $elem_id = $formInput['elem_id'];

        dd($formInput,$articles_a_affecter,$liste_article_a_retirer);

        // Retrait des entrees non contenues dans la table affectation
        $formInput = $this->formatRequestInput($formInput);

        $upd_rst = $this->updateOne($affectation->id, $formInput, $type_mouvement_id, $details, $articles_a_affecter, $liste_article_a_retirer);

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
        $articles_disponibles = Article::disponibles()->get()->pluck('reference_complete', 'id')->toArray();
        $nowdate = Carbon::now();

        $articles_a_affecter = null;
        $articles_a_affecter_json = null;
        $articles_disponibles_json = json_encode($articles_disponibles);

        return view('affectations.elemcreate')
          ->with('articles_disponibles', $articles_disponibles)
          ->with('type_affectation', $type_affectation)
          ->with('elem_arr', $elem_arr)
          ->with('articles_a_affecter', $articles_a_affecter)
          ->with('q', $q)
          ->with('nowdate', $nowdate)
          ->with('articles_a_affecter_json', $articles_a_affecter_json)
          ->with('articles_disponibles_json', $articles_disponibles_json)
          ;
    }

    public function elemstore(Request $request, $type_affectation_tag, $elem_id)
    {
        // Validate the form
        $formInput = $request->all();
        $nowdate = Carbon::now();
        $q = $request->has('q') ? $formInput['q'] : '';

        if ($request->has('articles_a_affecter'))
          $articles_a_affecter = $formInput['articles_a_affecter'];
        else
          $articles_a_affecter = null;

        if ($request['action'] == 'search-articles') {

            $type_affectation = TypeAffectation::tagged($type_affectation_tag)->first();
            $elem_arr = $this->getElemArr($type_affectation_tag, $elem_id);

            $articles_a_affecter_json = $formInput['articles_a_affecter'];
            $articles_a_affecter = json_decode($articles_a_affecter_json, true);

            $articles_a_affecter_ids = $articles_a_affecter ? array_keys($articles_a_affecter) : [];

            // Recherche articles disponibles en fonction du critère fourni
            $articles_disponibles = Article::search($q)->disponibles()->whereNotIn('id', $articles_a_affecter_ids)->get()->pluck('reference_complete', 'id')->toArray();

            $articles_disponibles_json = json_encode($articles_disponibles);

            return view('affectations.elemcreate')
                ->with('articles_disponibles', $articles_disponibles)
                ->with('articles_a_affecter', $articles_a_affecter)
                ->with('articles_disponibles_json', $articles_disponibles_json)
                ->with('articles_a_affecter_json', $articles_a_affecter_json)
                ->with('type_affectation', $type_affectation)
                ->with('elem_arr', $elem_arr)
                ->with('q', $q)
                ->with('nowdate', $nowdate)
              ;
        } elseif ($request['action'] == 'add-articles') {

            $type_affectation = TypeAffectation::tagged($type_affectation_tag)->first();
            $elem_arr = $this->getElemArr($type_affectation_tag, $elem_id);

            $articles_disponibles_json = $formInput['articles_disponibles'];
            $articles_a_affecter_json = $formInput['articles_a_affecter'];
            $articles_disponibles = json_decode($articles_disponibles_json, true);
            $articles_a_affecter = json_decode($articles_a_affecter_json, true);

            // Des articles à ajouter dans la liste d articles a affecter
            if(array_key_exists('articles_disponibles_selected', $formInput)) {
        				$new_lists = $this->addRemoveArticles($articles_disponibles, $articles_a_affecter, $formInput['articles_disponibles_selected']);

                $articles_disponibles = $new_lists[0];
                $articles_a_affecter = $new_lists[1];
                $articles_disponibles_json = $new_lists[2];
                $articles_a_affecter_json = $new_lists[3];
        		}

            return view('affectations.elemcreate')
              ->with('articles_disponibles', $articles_disponibles)
              ->with('articles_a_affecter', $articles_a_affecter)
              ->with('articles_disponibles_json', $articles_disponibles_json)
              ->with('articles_a_affecter_json', $articles_a_affecter_json)
              ->with('type_affectation', $type_affectation)
              ->with('elem_arr', $elem_arr)
              ->with('q', $q)
              ->with('nowdate', $nowdate)
              ;
        } elseif($request['action'] == 'remove-articles') {
          if(array_key_exists('articles_a_affecter_selected', $formInput)) {
              $liste_article_a_ajouter = $formInput['articles_disponibles'];
          }

              $type_affectation = TypeAffectation::tagged($type_affectation_tag)->first();
              $elem_arr = $this->getElemArr($type_affectation_tag, $elem_id);

              $articles_disponibles_json = $formInput['articles_disponibles'];
              $articles_a_affecter_json = $formInput['articles_a_affecter'];
              $articles_disponibles = json_decode($articles_disponibles_json, true);
              $articles_a_affecter = json_decode($articles_a_affecter_json, true);

              // Des articles à ajouter dans la liste d articles a affecter
              if(array_key_exists('articles_a_affecter_selected', $formInput)) {
                  $new_lists = $this->addRemoveArticles($articles_a_affecter, $articles_disponibles, $formInput['articles_a_affecter_selected']);

                  $articles_a_affecter = $new_lists[0];
                  $articles_disponibles = $new_lists[1];
                  $articles_a_affecter_json = $new_lists[2];
                  $articles_disponibles_json = $new_lists[3];
              }

              return view('affectations.elemcreate')
                ->with('articles_disponibles', $articles_disponibles)
                ->with('articles_a_affecter', $articles_a_affecter)
                ->with('articles_disponibles_json', $articles_disponibles_json)
                ->with('articles_a_affecter_json', $articles_a_affecter_json)
                ->with('type_affectation', $type_affectation)
                ->with('elem_arr', $elem_arr)
                ->with('q', $q)
                ->with('nowdate', $nowdate)
                ;
        } else {
          //dd($request);
          $request->validate([
            'objet' => 'required',
            'articles_a_affecter' => 'required',
            'date_debut' => 'required|date',
          ]);
        }

        $type_affectation = TypeAffectation::tagged($type_affectation_tag)->first();
        $formInput = $request->all();
        $articles_a_affecter = json_decode($formInput['articles_a_affecter'], true);
        $articles_a_affecter_ids = $articles_a_affecter ? array_keys($articles_a_affecter) : [];

        $this->createNew($formInput['objet'], $formInput['date_debut'], $type_affectation_tag, $elem_id ,$articles_a_affecter_ids);

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.affectationCreated', ['affectationtype' => $type_affectation->libelle] ));

        $show_controller = $type_affectation_tag . 'Controller@' . 'show';

        return redirect()->action($show_controller, $elem_id);
    }
}
