<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{

    public function store(int $quantity,int $id_size,int $id_color,int $id_product)
    {
        $detail = new Detail();

        $this->authorize('create', Detail::class);
     
        $detail->quantity = $quantity;
        $detail->id_size = $id_size;
        $detail->id_color = $id_color;
        $detail->id_product = $id_product;
        $detail->save();

        return $detail;
        
    }


    public function update(Request $request)
    {
        $this->validate($request, [
            'id_detail' => 'required|integer',
            'quantity' => 'required|integer',
        ]);
        
        $detail = Detail::find($request['id_detail']);
        //$this->authorize('update', $detail); //TODO
        $detail->quantity = $request['quantity'];
        $detail->save();
        return $detail;
    }

    public function updateQuantityAux(int $quantity,int $id_size,int $id_color,int $id_product){
        $filters = array(array('id_size','=',$id_size),array('id_color','=',$id_color),array('id_product','=',$id_product));
        $details = Detail::where($filters)->get();
        if(count($details) == 0){
            return false;
        }else{
            foreach($details as $detail){
                $detailModel = Detail::find($detail['id']); 
                foreach($detailModel->orders()->user()->get() as $user){
                    if($user['id'] == Auth::user()->id){
                        //$this->authorize('update', $detailModel); //TODO
                        $detailModel->quantity = $quantity;
                        $detailModel->save();
                        return true;
                    }
                }
            }
        }
        return false;
        
    }
    
    public function delete(int $idDetail, int $idOrder){
        $detail = Detail::find($idDetail);
        //$this->authorize('delete', $detail); //TODO
        $detail->orders()->where('id', $idOrder)->detach($idDetail);
        $detail->delete();
        return $detail;
    }
}