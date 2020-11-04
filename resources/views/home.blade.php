@extends('layouts.app')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="col-md-20">
                <h4>Enter the url to download!</h4>
               
                
            <form action="{{ route('urls.store') }}" method="POST">

            @csrf
                <div class="input-group">
                    <input name='url'  type="text" class="form-control" aria-label="Text input with dropdown button">

                    <div class="input-group-append">
                        <select name='format' id='format' class="selectpicker" >
                            <option>MP4</option>
                            <option>MKV</option>
                            <option>WEBM</option>
                            <option>FLV</option>
                        </select>
                        
                    </div>
                    </div>
                    <button  type="submit"  id='agregar' class="btn btn-primary">Agregar</button>
                </div>
            </div>
            </form>
            

            <hr>
          
            <table id='tabla' class="table table-sm table-dark">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">URL</th>
                <th scope="col">State</th>
                <th scope="col">Format</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                </tr>
            </thead>

            <tr>
            <tbody>
            
                @foreach($urls  as $url)
                
               
                        

                    <td name='id'>{{$url->id }}</td>

                    <td name='url'>{{$url->url  }}</td>
                    <td>{{$url->state  }}</td>
                    <td name='format'>{{$url->format  }}</td>

                    <td><form method="POST" class="form-delete" action="{{ route('urls.destroy',$url->id)}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                       
                    </form>

                    <td><form method="POST" class="form-enviar" action="{{ route('cola.store', ['id' => $url->id,'url' => $url->url,'format' => $url->format])}}">
                    @csrf
                    <button type="submit" class="btn btn-success"><i class="fa fa-download"></i></button>
                       
                    </form>
                    </td>
                
                        
                                 
                   </tr>
                @endforeach
                   
                
            </tbody>
        </table>
        </div>
    </div>
    <div>
    </div>
</div>
@endsection