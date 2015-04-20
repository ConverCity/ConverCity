<?php
    
    $page = [
        'id'    => 'citizen_upload',
        'name' => 'Citizen Upload',
        ]

?>

@extends('layouts.app')

@section('main')

    <h1> Upload Client Files </h1>
    <div class="alert alert-info">
        <p>CSV files should be organized in the following order</p>
        <p>phone number, email address, first name, last name, tag, tag, tag... </p>
    </div>
        <form action="{{action('CitizensUploadController@postUserCsv')}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
                <input type="file" name="file">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="upload file">
            </div>
    </form>
    
@stop