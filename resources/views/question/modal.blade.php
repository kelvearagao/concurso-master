<html>

<style type="text/css">
	.posts-related-wrapper {
	    clear: both;
	}
</style>

<body>
<div class="question-container" data-id="{{ $question->id }}">
	<p name="description" class="lead text-justify question" rows="3" data-id="{{ $question->id }}">
		{!! nl2br($question->description) !!}
	</p>

	<br>

	<table class="table">
	@foreach( $options as $option )
		<tr data-id="{{ $option->id }}">
			<td width="5%"><input type="radio" name="answer" value="{{ $option->id }}"></td>
			<td class="text-justify">{{ $option->description }}</td>
		</tr>
	@endforeach
	</table>
</div>
</body>
</html>