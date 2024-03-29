<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\TypeArticle;
use Illuminate\Http\Request;

use App\Http\Requests\TypeArticleRequest;
use App\Traits\ImageTrait;

class TypeArticleController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $recherche_cols = ['id', 'libelle', 'description'];

        $sortBy = 'id';
        $orderBy = 'asc';
        $perPage = 5;
        $q = null;
        if ($request->has('orderBy')) $orderBy = $request->query('orderBy');
        if ($request->has('sortBy')) $sortBy = $request->query('sortBy');
        if ($request->has('perPage')) $perPage = $request->query('perPage');
        if ($request->has('q')) $q = $request->query('q');
        $typearticles = TypeArticle::search($q)->orderBy($sortBy, $orderBy)->paginate($perPage);
        return view('typearticles.index', compact('typearticles', 'recherche_cols', 'orderBy', 'sortBy', 'q', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuts = DB::table('statuts')->get()->pluck('libelle', 'id');
        return view('typearticles.create')
          ->with('statuts', $statuts)
          ->with('typearticle', (new TypeArticle()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeArticleRequest $request)
    {
        // Upload the image
        $formInput = $request->all();
        $formInput['image'] = $this->verifyAndStoreImage($request, 'image', 'typearticle');

        // Store the New TypeArticle
        $typearticle = TypeArticle::create($formInput); // $request->input()

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelSaved', ['modelname' => 'Type Article'] ));

        return redirect()->action('TypeArticleController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TypeArticle  $typeArticle
     * @return \Illuminate\Http\Response
     */
    public function show(TypeArticle $typearticle)
    {
        $typearticle = TypeArticle::with(['statut'])->where('id', $typearticle->id)->first();
        return view('typearticles.show', ['typearticle' => $typearticle]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypeArticle  $typeArticle
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeArticle $typearticle)
    {
        $statuts = DB::table('statuts')->get()->pluck('libelle', 'id');
        return view('typearticles.edit')
            ->with('statuts', $statuts)
            ->with('typearticle', $typearticle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TypeArticle  $typeArticle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeArticle $typearticle)
    {
        $request_typearticle = New TypeArticleRequest(); // $request
        $request_typearticle->input = $request->input;

        // Upload the image
        $formInput = $request->all();
        $formInput['image'] = $this->verifyAndStoreImage($request, 'image', 'typearticle', $typearticle->image);

        $typearticle->fill($formInput); // $request->input()
        $typearticle->save();

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelUpdated', ['modelname' => 'Type Article'] ));

        return redirect()->action('TypeArticleController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TypeArticle  $typeArticle
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeArticle $typearticle)
    {
        $typearticle->delete();

        session()->flash('msg_success',__('messages.modelDeleted', ['modelname' => 'Type Article'] ));

        return redirect()->action('TypeArticleController@index');
    }
}
