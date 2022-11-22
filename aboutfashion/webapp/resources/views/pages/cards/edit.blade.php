@extends('layouts.app')

@section('content')

<div id="edit_form">
    <legend>Edit Card</legend>
    {{--definir outra routa--}}
    <form method="POST" action="{{ route('userRegister') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="nick_name" class="form-label mt-4">Nick Name</label>
            <input type="text" class="form-control" id="nick_name" placeholder="Nick Name" name="nick_name" required>
        </div>
        <div class="form-group">
            <label for="name" class="form-label mt-4">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Name" name="name" required>
        </div>
        <div class="form-group">
            <label for="number" class="form-label mt-4">Number</label>
            <input type="text" class="form-control" id="number" placeholder="Number" name="number" required>
        </div>
        <div class="form-group">
            <div class=" me-auto"></div>
            <label for="month_year" class="form-label mt-4">Month/Year:</label>
            <input type="month" id="month_year" class="form-control" name="month_year" min="2022-11" value="2022-11">
        </div>
        <div class="form-group">
            <label for="code" class="form-label mt-4">Code</label>
            <input type="number" class="form-control" id="code" placeholder="Code" name="code" required>
        </div>
        <div class="modal-footer">
            <span class="error-text me-auto" style="color:red"> </span>
            <button type="submit" class="btn btn-primary reg">Save</button>
        </div>
    </form>
    
</div>

@endsection
