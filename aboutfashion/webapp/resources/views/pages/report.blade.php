@extends('layouts.app')

@section('content')

<section class="vh-100" style="background-color: #ffffff;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center" >

                  <h3 class="mb-5 ">REPORT REVIEW</h3>

                  <form method="POST" action="{{ route('report.action') }}">
                    @csrf
                    
                    
                    <div class="form-group text-start">
                    <label for="report-type">Type of report:</label><br>
                    <input type="radio" id="report-type-1" name="report-type" value="spam">
                    <label for="report-type-1">Spam</label><br>
                    <input type="radio" id="report-type-2" name="report-type" value="inappropriate">
                    <label for="report-type-2">Hate speech or symbols</label><br>
                    <input type="radio" id="report-type-3" name="report-type" value="other">
                    <label for="report-type-3">Scam or fraud</label><br>
                    <input type="radio" id="report-type-4" name="report-type" value="other">
                    <label for="report-type-4">False information</label><br>
                    <input type="radio" id="report-type-5" name="report-type" value="other">
                    <label for="report-type-5">Violence or dangerous orgatizations</label><br>
                    <br>
                    <label for="report-description">Other:</label><br>
                    <textarea id="report-description" name="report-description"></textarea><br>
                    </div>
                    
                    <hr class="my-4">
                    <button type="submit" class="btn btn-primary" >
                    Send
                    </button>
                    
                    
                </form>

                  

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
@endsection
