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
                                    <input class="form-check-input is_done"
                                           type="checkbox"
                                           value=""
                                           onclick="editTaskStatus({{$task['id']}})"
                                           @if($task['is_done']) checked @endif
                                    >
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center actions_icon_container">
                                    <a class="rounded mr-1" role="button" href="{{route('task.edit', $task['id'])}}">
                                        <img width="27" src="{{asset('assets/images/icons/pencil_icon.png')}}" />
                                    </a>

                                    <a class="rounded ml-1" role="button" href="{{route('task.destroy', $task['id'])}}">
                                        <img width="27" src="{{asset('assets/images/icons/delete_icon.png')}}" />
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endempty

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        function editTaskStatus(id){
            $.ajax({
                url: "http://127.0.0.1:8085/task/change_status/" + id,
                method: 'POST'
            });
        }
    </script>
@stop
