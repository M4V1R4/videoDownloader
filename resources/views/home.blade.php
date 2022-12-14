@extends('layouts.app')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="col-md-20">
                <h4>Enter the url to download!</h4>
               
                
            <form action="{{ route('colas.store') }}" method="POST">

            @csrf
                <div class="input-group">
                    <input name='url'  type="text" class="form-control" aria-label="Text input with dropdown button">

                    <div class="input-group-append">
                        <select name='format' id='format' class="selectpicker" >
                            <option>mp4</option>
                            <option>mkv</option>
                            <option>webm</option>
                            <option>flv</option>
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
            
                @foreach($colas  as $cola)
                
               
                        

                    <td name='id'>{{$cola->id }}</td>

                    <td name='url'>{{$cola->url  }}</td>
                    <td>{{$cola->state  }}</td>
                    <td name='format'>{{$cola->format  }}</td>

                    <td><form method="POST" class="form-delete" action="{{ route('colas.destroy',$cola->id)}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                       
                    </form>

                    <td><form method="POST" class="form-enviar" action="{{ route('cola.store', ['id' => $cola->id,'url' => $cola->url,'format' => $cola->format])}}">
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