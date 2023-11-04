@extends('components.template')

@section('activeSave', 'active')

@section('content')
    <div class="row">
        <div class="col-6">
            <img src="{{asset("assets/images/boy_changing_tasks.jpg")}}"
                 class="img-fluid"
                 alt="boy changing tasks">
        </div>
        <div class="col-6">
            <div class="d-flex w-100 h-100 align-items-center">
                <form method="POST"
                      action="{{route($routeName, $routeParams)}}"
                      class="row">
                    @csrf
                    <div class="col-12 mb-3">
                        <h1 class="text-primary">{{$pageName}}</h1>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="title" class="form-label">Nome da Tarefa</label>
                        <input type="text"
                               class="form-control"
                               id="title" name="title"
                               placeholder="Ex: estudar"
                               value="{{$task['title'] ??  '' }}"
                               required>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="description" class="form-label">Descrição da Tarefa</label>
                        <textarea class="form-control"
                                  id="description"
                                  name="description"
                                  maxlength="250"
                                  rows="3">{{$task['description'] ?? '' }}</textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mt-3">{{$pageName}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
