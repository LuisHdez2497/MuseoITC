@extends('adminlte::page')

@section('title', 'Editar | MuseoITC')
@section('plugins.Select2', true)

@section('content_header')
    @include('layouts.notificaciones')

    <h1 style="display: inline" class="m-0"><img width="50px" style="margin-bottom: 5px; margin-right: 5px; border-radius: 20px" src="{{asset('img/logo-itc.svg')}}" alt="img-logo">Editar objeto: ({{ $data->titulo }})</h1>
@stop

@section('content')
    {!! Form::model($data, ['files' => true, 'method' => 'PATCH', 'route' =>['museo.update', $data->id]]) !!}
    {{Form::token()}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="formulario-tres">
                        <x-adminlte-input value="{{ $data->titulo }}" label="Titulo" placeholder="Titulo del objeto..." name="titulo"/>
                    </div>
                    <div class="formulario-tres">
                        @php
                            $config = ['format' => 'YYYY-MM-DD'];
                        @endphp
                        <x-adminlte-input-date value="{{ $data->fecha }}" label="Fecha" :config="$config" placeholder="dd/mm/aaaa" name="fecha">
                            <x-slot name="appendSlot">
                                <div class="input-group-text bg-gradient-danger">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-date>
                    </div>
                    <div class="formulario-tres">
                        <x-adminlte-input-file name="imagen" placeholder="Elige una imagen...">
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-lightblue">
                                    <i class="fas fa-upload"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-file>
                    </div>
                    <div class="formulario-uno">
                        <x-adminlte-text-editor name="descripcion">
                            {{ $data->descripcion }}
                        </x-adminlte-text-editor>
                    </div>
                    <hr>
                    <div class="form-group formulario-tres">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                        <a class="btn btn-danger" href="{{url('museo')}}">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop
