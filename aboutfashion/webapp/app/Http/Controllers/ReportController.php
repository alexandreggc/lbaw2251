<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    public function __construct(){
        $this->middleware('auth');
    }
    
    public function create(Request $request, $id_review){
        $user = Auth::user();
        $review = Review::find($id_review);
        $this->authorize('create', $user, $review);
        return view('pages.reports.create', ['review' => $review]);
    }

    public function store(Request $request){
        $report = new Report();
        $user = User::find($request->input('id_user'));
        $review = Review::find($request->input('id_review'));
        $this->authorize('store', $user, $review);

        //guardar os dados do novo report
        $report->id = $request->input('id');
        $report->id_user = $request->input('id_user');
        $report->id_review = $request->input('id_review');
        $report->report_date = $request->input('report_date');
        $report->resolved = $request->input('resolved');
        $report->description = $request->input('description');
        $report->save();
        return $report;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id){
        $user = Auth::user();
        $report = Report::find($id); 
        if(is_null($user)){
            return view('pages.report',['report' => $report]);   
        }
        return view('pages.report',[ 'report' => $report]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request  $request
     * @return Response
     */
    public function edit(Request $request){
        $report = update($request);
        return view('reports.edit', ['report' => $report]);    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request){
        $user = User::find($request->input('id_user'));
        $report = Report::find($request->input('id'));
        $this->authorize('update', $user, $report);

        //atualizar os dados do report editado
        $report->resolved = $request->input('resolved');
        $report->description = $request->input('description');
        $report->save();
        return $report;
    }

    /**
     * Show the form for deleting the specified resource.
     *
     * @param  Request  $request
     * @return Response
     */
    public function delete(Request $request){
        $review = destroy($request->input('id'));
        return view('reports.delete', ['report' => $report]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id){
        $report = Report::find($id);
        $user = User::find($report->id_user);
        $this->authorize('delete', $user, $report);

        //eliminar o report
        $report->delete();
        return $report;
    }

    public function changeReport(Request $request){
        $this->authorize('updateReport', Auth::guard('admin')->user());
        
        $report = Report::find($request['id']);
        if(is_null($report)){
            return Response::json(array('status' => 'error', 'message' => 'Report not found!'), 404);
        }
        
        $report->resolved = $report->resolved ? 0 : 1;
        if($report->save()){
            return Response::json(array('status' => 'success', 'message'=>'OK!', 'resolved'=>$report->resolved),200);
        }else{
            return Response::json(array('status' => 'error', 'message'=>'Something happens!'),500);
        } 
    }
}