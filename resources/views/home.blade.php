@extends('layouts.app')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="col-md-20">
                <h4>Enter the url to download!</h4>
                <div class="input-group">
                    <input type="text" class="form-control" aria-label="Text input with dropdown button">

                    <div class="input-group-append">
                        <select class="selectpicker" >
                            <option>MP4</option>
                            <option>MKV</option>
                            <option>WEBM</option>
                            <option>FLV</option>
                        </select>
                        
                    </div>
                    </div>
                    <button type="button" class="btn btn-success">Download <i class="fa fa-download"></i></button>
                </div>
            </div>
            

            <hr>
            <table class="table table-sm table-dark">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">URL</th>
                <th scope="col">State</th>
                <th scope="col">Format</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th>1</th>
                <td>jddjdj</td>
                <td>En proceso</td>
                <td>mp4</td>
                <td><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                </tr>
            </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
