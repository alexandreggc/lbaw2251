<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Review;
use App\Models\User;


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
        $validator = Validator::make($request->all(),[
            'report-type' => 'required',
            'description' => 'nullable|string|max:100',
        ]);
        
        if($validator->fails()){
            return Redirect::back()->withErrors(array('status' => 'error', 'message'=>'Error!'));
        }

        $report = new Report();
        $user = User::find($request->input('id_user'));
        $review = Review::find($request->input('id_review'));
        $report->id = $request->input('id');
        $report->id_user = $request->input('id_user');
        $report->id_review = $request->input('id_review');
        $report->report_date = $request->input('report_date');
        $report->resolved = $request->input('resolved');
        $report->description = $request->input('description');
        
        
        if($report->save()){
            return Redirect::route('successReport');
        }else{
            return redirect()->back();
        }
    }

    public function success(){
        return view('pages.reports.success');
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
        return view('pages.report',['report' => $report]);
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