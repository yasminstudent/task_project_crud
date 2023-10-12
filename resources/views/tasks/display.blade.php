@extends('components.template')

@section('activeList', 'active')

@section('content')
    <h1 class="text-purple text-center">Lista de Tarefas</h1>
    <div class="w-100 d-flex justify-content-center">
        <img src="{{asset('assets/images/people_and_tasks.jpg')}}" width="800"/>
    </div>

    @empty($tasks)
        <div class="alert alert-warning mb-4" role="alert">
            Não há tarefas para exibir
        </div>
    @else
        <div class="table-responsive mb-4">
            <table class="table table-hover text-center table-bordered">
                <thead class="bg-purple text-white">
                    <tr>
                        <td>
                            Título
                        </td>
                        <td>
                            Descrição
                        </td>
                        <td>
                            Data
                        </td>
                        <td>
                            Finalizada
                        </td>
                        <td>
                            Ações
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>
                                {{ $task['title'] }}
                            </td>
                            <td>
                                {{ $task['description'] }}
                            </td>
                            <td>
                                {{ date('d/m/Y H\hi', strtotime($task['created_at'])) }}
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           value=""
                                           id="is_done"
                                           @if($task['is_done']) checked @endif
                                    >
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center actions_icon_container">
                                    <div class="rounded mr-1" role="button">
                                        <img width="27" src="{{asset('assets/images/icons/pencil_icon.png')}}" />
                                    </div>

                                    <div class="rounded ml-1" role="button">
                                        <img width="27" src="{{asset('assets/images/icons/delete_icon.png')}}" />
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endempty
@stop
