<?php
  
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;  

use App\Fournisseur;  
use Illuminate\Http\Request;

use App\Http\Requests\FournisseurRequest;

use App\Traits\FournisseurTrait;

class FournisseurController extends Controller  

{     use FournisseurTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $recherche_cols = ['id', 'nom', 'prenom','raison_social'];

        $sortBy = 'id';
        $orderBy = 'asc';
        $perPage = 5;
        $q = null;
        if ($request->has('orderBy')) $orderBy = $request->query('orderBy');
        if ($request->has('sortBy')) $sortBy = $request->query('sortBy');
        if ($request->has('perPage')) $perPage = $request->query('perPage');
        if ($request->has('q')) $q = $request->query('q');

        $fournisseurs = Fournisseur::search($q)->orderBy($sortBy, $orderBy)->paginate($perPage);

        //dd($typearticles);

        return view('fournisseurs.index', compact('fournisseurs', 'recherche_cols', 'orderBy', 'sortBy', 'q', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuts = DB::table('statuts')->get()->pluck('libelle', 'id');
        $selectedtags = $this->getTags("r");
        return view('fournisseurs.create')
          ->with('selectedtags', $selectedtags)
          ->with('statuts', $statuts)
          ->with('fournisseur', (new Fournisseur()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FournisseurCreateRequest $request)
    {
        
        $formInput = $request->all();
        

        // Store the New fournisseur
        $fournisseur = Fournisseur::create($formInput); // $request->input()

        // Sessions Message
        $request->session()->flash('msg',__('messages.modelSaved', ['modelname' => 'Fournisseur'] ));

        return redirect()->action('FournisseurController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function show(Fournisseur $fournisseur)
    {
        $fournisseur =Fournisseur::with('statut')->where('id', $fournisseur->id)->first();
        return view('fournisseurs.show', ['fournisseur' => $fournisseur]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function edit(Fournisseur $fournisseur)
    {
        $statuts = DB::table('statuts')->get()->pluck('libelle', 'id');
        $selectedtags = $this->getTags($fournisseur->tags);
        return view('fournisseurs.edit')
          ->with('selectedtags', $selectedtags)
          ->with('statuts', $statuts)
          ->with('fournisseur', $fournisseur);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function update(FournisseurEditRequest $request, Fournisseur $fournisseur)
    {
        $fournisseur->fill($request->input());
        $fournisseur->save();

        // Sessions Message
        $request->session()->flash('msg',__('messages.modelUpdated', ['modelname' => 'Fournisseur'] ));

        return redirect()->action('FournisseurController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fournisseur $fournisseur)
    {
        session()->flash('msg',__('messages.modelDeleted', ['modelname' => 'Fournisseur'] ));

        return redirect()->action('FournisseurController@index');
    }
}
