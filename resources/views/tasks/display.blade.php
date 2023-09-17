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
                            Status
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
                                checkbox
                            </td>
                            <td>
                                icon edit/del
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endempty
@stop
