<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;  

use App\MarqueArticle;
use Illuminate\Http\Request;

class MarqueArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $recherche_cols = ['id', 'nom'];
        $sortBy = 'id';  
        $orderBy = 'asc';
        $perPage = 5;
        $q = null;
        if ($request->has('orderBy')) $orderBy = $request->query('orderBy');
        if ($request->has('sortBy')) $sortBy = $request->query('sortBy');
        if ($request->has('perPage')) $perPage = $request->query('perPage');
        if ($request->has('q')) $q = $request->query('q');
        $marquearticles = MarqueArticle::search($q)->orderBy($sortBy, $orderBy)->paginate($perPage);
        return view('marquearticles.index', compact('marquearticles', 'recherche_cols', 'orderBy', 'sortBy', 'q', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $statuts = DB::table('statuts')->get()->pluck('libelle', 'id');
        return view('marquearticles.create')
          ->with('statuts', $statuts)
          ->with('marquearticle', (new MarqueArticle()));
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
         // Store the New Etat commande
        $marquearticles = MarqueArticle::create($formInput); // $request->input()

        // Sessions Message
        $request->session()->flash('msg',__('messages.modelSaved', ['modelname' => 'Marque'] ));

        return redirect()->action('MarqueArticleController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MarqueArticle  $marqueArticle
     * @return \Illuminate\Http\Response
     */
    public function show(MarqueArticle $marquearticle)
    {
        $marquearticle = MarqueArticle::with('statut')->where('id', $marquearticle->id)->first();
        return view('marquearticles.show', ['marquearticle' => $marquearticle]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MarqueArticle  $marqueArticle
     * @return \Illuminate\Http\Response
     */
    public function edit(MarqueArticle $marquearticle)
    {
        $statuts = DB::table('statuts')->get()->pluck('libelle', 'id');
        return view('marquearticles.edit')
          ->with('statuts', $statuts)
          ->with('marquearticle', $marquearticle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MarqueArticle  $marqueArticle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MarqueArticle $marqueArticle)
    {
        $marquearticle->fill($request->input());
        $marquearticle->save();

        // Sessions Message
        $request->session()->flash('msg',__('messages.modelUpdated', ['modelname' => 'Etat Commande'] ));

        return redirect()->action('MarqueArticleControllerr@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MarqueArticle  $marqueArticle
     * @return \Illuminate\Http\Response
     */
    public function destroy(MarqueArticle $marquearticle)
    {
        $marquearticle->delete();

        // Sessions Message
        session()->flash('msg',__('messages.modelDeleted', ['modelname' => 'Marque Article'] ));

        return redirect()->action('MarqueArticleController@index');
    }
}
