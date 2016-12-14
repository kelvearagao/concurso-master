<table class="table options">
	<tbody>
		@foreach( $options as $option )
			<tr data-id="{{ $option->id }}">
				<td width="3%">
					@if( ! empty($answer_id) AND ($answer_id == $option->id) )
						<input type="radio" name="answer" value="{{ $option->id }}" checked >
					@else
						<input type="radio" name="answer" value="{{ $option->id }}">
					@endif
				</td>
				<td>
					{{ $option->description }}
				</td>
				<td width="5%">
					<a href="#" class="delete-option"><span class="glyphicon glyphicon-remove"></span></a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>