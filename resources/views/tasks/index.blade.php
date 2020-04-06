@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">@lang('task.newTask')</div>

            <div class="card-body">
                <!-- Display Validation Errors -->
                @include('common.errors')

                <!-- New Task Form -->
                <form action="{{ url('tasks') }}" method="POST" class="form-horizontal">
                    @csrf

                    <!-- Task Name -->
                    <div class="form-group">
                        <label for="task" class="col-sm-3 control-label">@lang('task.name')</label>

                        <div class="col-sm-6">
                            <input type="text" name="name" id="task-name" class="form-control">
                        </div>
                    </div>

                    <!-- Add Task Button -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus"></i> @lang('task.addTask')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">@lang('task.currentTask')</div>

            <div class="card-body">
                @if (count($tasks) > 0)
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-striped task-table">

                                <!-- Table Headings -->
                                <thead>
                                    <th>@lang('task.name')</th>
                                    <th>&nbsp;</th>
                                </thead>

                                <!-- Table Body -->
                                <tbody>
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <!-- Task Name -->
                                            <td class="table-text">
                                                <div>{{ $task->name }}</div>
                                            </td>

                                            <td>
                                                <form action="{{ url('tasks/'.$task->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa fa-trash"></i> @lang('task.deleteTask')
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
