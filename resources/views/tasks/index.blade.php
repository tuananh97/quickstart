@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body container">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Task Form -->
        {!! Form::open(['method' => 'POST', 'route' => 'tasks.store', 'class' => 'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('task-name', __('translate.task'), ['class' => 'col-sm-3 control-label']) !!}

                <div class="col-sm-6">
                    {!! Form::text('name', '', ['class' => 'form-control', 'id' => 'task-name']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    {!! Form::submit(__('translate.addtask'), ['class' => 'btn btn-default']) !!}
                </div>
            </div>
        {!! Form::close() !!}
    </div>

    <!-- Current Tasks -->
    <div class="container panel panel-default">
        @if (count($tasks) > 0)
            <div class="panel-heading h2 text-primany">
                {{ trans('translate.currentTask') }}
            </div>

            <div class="panel-body">
                <table class="table table-bordered table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>{{ trans('translate.task') }}</th>
                        <th>{{ trans('translate.action') }}</th>
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
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['tasks.destroy', 'task'=>$task->id]]) !!}
                                        {!! Form::submit(__('translate.delete'), [
                                            'class' => 'btn btn-danger',
                                            'id' => 'delete-task-'. $task->id,
                                            ]) !!}

                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @else
            <div class="panel-heading h2 text-primany">
                {{ trans('translate.noTask') }}
            </div>
        @endif
    </div>
@endsection
