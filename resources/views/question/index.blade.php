@extends('layout.index')
	
@section('content')
	<a href="{{ url('question/create') }}" class="btn btn-primary">Adicionar questão</a>
	<br><br>
	<table class="table">
		<?php $cont = 0; ?>
		@foreach( $questions as $question )
			<tr id="question-{{ $question->id }}" data-id="{{ $question->id }}">
				<td>{{ ++$cont }}</td>
				<td>{!! nl2br($question->description) !!}</td>
				<td width="6%">
					<span class="glyphicon glyphicon-open-file open-question" 
						data-toggle="modal" data-target="#modal-question"></span>

					<a href="{{ url('question/'.$question->id.'/edit') }}">
						<span class="glyphicon glyphicon-edit"></span>
					</a>
				</td>
			</tr>
		@endforeach

	</table>

	<!-- Modal new option -->
		<div class="modal fade" id="modal-question" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Nova opção</h4>
					</div>
					<div class="modal-body">
						
						
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary answer-question" data-dismiss="modal">Save changes</button>
					</div>
				</div>
			</div>
		</div>
@endsection