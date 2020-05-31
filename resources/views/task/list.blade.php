@extends('layouts.master')

@section('content')
    <style >
    td:hover{
		cursor:move;
		}
    </style>
    <h1>Task List <a href="{{ url('/task/create') }}" class="btn btn-primary pull-right btn-sm">Add New Task</a></h1>
    <hr/>

    @include('partials.flash_notification')

    <fieldset>
    <legend>Filter</legend>
    {!! Form::open(['route' => ['home'], 'class' => 'form-inline', 'method' => 'get']) !!}
        <div class="form-group }}">
            {!! Form::label('project_id', 'Project', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
            {!! Form::select('project_id', 
                $projects, 
                $selectedProject, 
                ['class' => 'control-label']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </fieldset>
    <hr/>

    @if(count($taskList))
        <form id="dataListForm" name="dataListForm" method="post" action="/"> 
    
        <div class="table-responsive">
            <table id="taskTable" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th>Task </th>
                    <th>Priority </th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($taskList as $index => $task)
                    <tr id="{{ $index +1 }}">
                        <td class="index">{{ $index +1 }}</td>
				        
                        <td>{{ $task->name }}</td>
                        <td>
                        
                        <input 
                            type="hidden" 
                            name="sortorder[{{ $task->id }}]" 
                            class="sortinput" 
                            value="{{ $task->priority }}">
                            <span class="priority-text">{{ $task->priority }}</span>
                        </td>
                        <td>{{ $status[$task->status] }}</td>
                        <td>
                        <a href="{{ url('/task/edit/' . $task->id) }}" class="btn btn-primary btn-xs">Edit</a>
                        <br/>
                        <br/>
                            {!! Form::open(['route' => ['task.destroy', $task->id], 'class' => 'form-inline', 'method' => 'delete', 'onsubmit' => 'return confirm(\'Are you sure?\')']) !!}
                                {!! Form::hidden('id', $task->id) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        </form>
    @else
        <div class="text-center">
            <h3>No todos available yet</h3>
            <p><a href="{{ url('/task/create') }}">Create new todo</a></p>
        </div>
    @endif
   
   <script>
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#project_id').on('change', function(){
            $(this).parents('form').submit();

        });


		var fixHelperModified = function(e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function(index) {
                $(this).width($originals.eq(index).width())
            });
            return $helper;
	    },
		updateIndex = function(e, ui) {
			$('td.index', ui.item.parent()).each(function (i) {
				$(this).html(i+1);
			});
			$('input[type=text]', ui.item.parent()).each(function (i) {
				$(this).val(i + 1);
                $(this).parent().find('.priority-text').html(i + 1);
			});
		};

        $("#taskTable tbody").sortable({
            helper: fixHelperModified,
            stop: updateIndex,
            
            distance: 5,
            delay: 20,
            opacity: 0.6,
            cursor: 'move',
            update: function( event, ui ) {
                var url = "/task/update-sort-order";

                // POST values in the background the the script URL
                $.ajax({
                    type: "POST",
                    url: url,
                    data: $('#dataListForm').find('.sortinput').serializeArray(),
                    success: function (data){
                        
                    }
                });                
            },
            change: function( event, ui ) {
                console.log('Row changed');
            }

        }).disableSelection();	

    });
    </script>
@endsection