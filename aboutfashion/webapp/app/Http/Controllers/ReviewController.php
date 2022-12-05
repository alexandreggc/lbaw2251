<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Review;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //lista de users útil para o admin panel
        //verificar nome da view
        return view('reviews.index', ['reviews' => Review::all()]);
    }

    /**
     * Display a listing of the reviews of a specific user
     *
     * @param int $id_user
     */
    public function listByUser($id_user){
        //lista de reviews de um user
        //verificar nome da view
        return view('reviews.list_by_user', 
        ['reviews' => Review::where('id_user', $id_user)->get()]);
    }

    /**
     * Display a listing of the reviews of a specific product
     *
     * @param int $id_product
     */
    public function listByProduct($id_product){
        //lista de reviews de um user
        //verificar nome da view
        return view('reviews.list_by_product', 
        ['reviews' => Review::where('id_product', $id_product)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request){
        $review = store($request);
        return view('reviews.create', ['review' => $review]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request){
        //rever forma de chamar as policies

        //verificar se é possível criar a review
        //de acordo com as business rules definidas
        $review = new Review();
        $user = User::find($request->input('id_user'));
        $product = Product::find($request->input('id_product'));
        $this->authorize('store', $user, $product);

        //guardar os dados da nova review
        $review->id_user = $request->input('id_user');
        $review->id_product = $request->input('id_product');
        $review->rating = $request->input('rating');
        $review->description = $request->input('description');
        $review->save();
        return $review;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id){
        $review = Review::find($id);
        return view('reviews.show', ['review' => $review]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request  $request
     * @return Response
     */
    public function edit($id){
        $review = Review::find($id);
        $this->authorize('update', $review);
        if(is_null($review)){
            return abort('404');
          }
        return view('pages.reviews.edit', ['review' => $review]);    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request, $id){
        //rever forma de chamar as policies

        //verificar se é possível editar a review
        //de acordo com as business rules definidas
        $user = Auth::user();
        $review = Review::find($id);
        $this->authorize('update', $user, $review);

        $validator = Validator::make($request->all(),[
            'title'=> 'string|max:100',
            'description' => 'string|max:100',
            'evaluation' => 'integer',
          ]);
        if($validator->fails()){
            return redirect()->back(); // adicionar mensagens de erro
        }

        //atualizar os dados da review editada
        $review['evaluation'] = $request->input('evaluation');
        $review['title'] = $request->input('title');
        $review['description'] = $request->input('description');
        $review->save();
        return Redirect::route('userView', array('id'=>Auth::user()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id){
        //rever forma de chamar as policies

        //verificar se é possível eliminar a review
        //de acordo com as business rules definidas
        $review = Review::find($id);
        $user = User::find($review->id_user);
        $this->authorize('delete', $user, $review);

        //eliminar a review
        $review->delete();
        return Redirect::route('userView', array('id'=>Auth::user()));
    }
}
