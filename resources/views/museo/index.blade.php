@extends('adminlte::page')

@section('title', 'Inicio | MuseoITC')

@section('content_header')
    <style>
        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
        }
    </style>

    @include('layouts.notificaciones')

    <h1 style="display: inline" class="m-0"><img width="50px" style="margin-bottom: 5px; margin-right: 5px; border-radius: 20px" src="{{asset('img/logo-itc.svg')}}" alt="img-logo">Museo</h1>
    <a href="{{url('museo/crear')}}"><button style="display: inline; float: right; margin-right: 2%; margin-top: 10px; width: 90px; font-size: 16px; height: 40px" class="btn btn-success btn-circle">Agregar <i class="fas fa-plus"></i></button></a>
@stop

@php
    $heads = [
        ['label' => 'ID', 'width' => 10],
        'Titulo',
        ['label' => 'Fecha de Creación', 'width' => 20],
        ['label' => 'Ultima Actualizacion', 'width' => 20],
        ['label' => 'Acciones', 'width' => 5],
    ];

    $config = [
        'language' => [
            'paginate' => [
                'next' => 'Siguiente',
                'previous' => 'Anterior'
            ],
            'search' => 'Buscar:',
            'emptyTable' => 'Sin información disponible',
            'info' => 'Mostrando _START_ a _END_ de _TOTAL_ registros',
            'infoEmpty' => 'Sin informacion para mostrar',
            'decimal' => '.',
            'thousands' => ',',
            'infoFiltered' => '',
            'zeroRecords' => 'No se encontraron datos',
            'lengthMenu' => 'Mostrar _MENU_ elementos'
        ],
        'aLengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]]
];
@endphp

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <x-adminlte-datatable id="table-museo" :heads="$heads" :config="$config" theme="light" striped hoverable>
                        @foreach($data as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->titulo }}</td>
                                <td>{{ $row->created_at }}</td>
                                <td>{{ $row->updated_at }}</td>
                                <td>
                                    <nobr class="d-flex">
                                        <a href="{{ $row->url_imagen }}" title="Ver Codigo QR" target="_blank" class="btn iconos-btn d-flex mx-1 btn-info shadow">
                                            <i class="fa fa-qrcode" aria-hidden="true"></i>
                                        </a>
                                        {!! Form::Open(array('action' => array('HomeController@museoEdit', $row->id), 'method' => 'get')) !!}
                                        <button class="btn iconos-btn btn-xs btn-default text-primary mx-1 p-1 shadow" title="Editar">
                                            <i class="fa fa-lg fa-fw fa-pen"></i>
                                        </button>
                                        {{ Form::Close() }}
                                        <button class="btn iconos-btn btn-xs btn-default text-danger mx-1 p-1 shadow" type="button" data-href="{{$row->id}}" data-toggle="modal" data-target="#modal-eliminar" title="Eliminar">
                                            <i class="fa fa-lg fa-fw fa-trash"></i>
                                        </button>
                                    </nobr>
                                </td>
                            </tr>
                        @endforeach
                    </x-adminlte-datatable>
                </div>
            </div>
        </div>
        <a href="{{url('museo')}}" style="display: none" id="redireccionar-museo"></a>
    </div>

    <div class="modal fade" id="modal-eliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">¿Desea eliminar el objeto?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <div class="modal-body">
                    <p>Eliminaras un objeto, este proceso es irreversible</p>
                    <p>¿Desear proceder?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button id="eliminar-museo" class="btn btn-danger btn-ok">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
@stop
