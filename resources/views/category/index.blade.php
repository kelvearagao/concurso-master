@extends('layout.index')
	
@section('content')
	<table class="table">
		<thead>
			<tr>
				<th>Nome</th>
				<th>Quantidade</th>
			</tr>
		</thead>
		<tbody>
			@foreach( $categories as $category )
				<tr>
					<td><a href="{{ url('question?cat=' . $category->name) }}">{{ $category->name }}</a></td>

					<?php 
						$label = 'label-';

						if( $category->amount < 10 )
							$label .= 'danger';
						else
							$label .= 'warning';
					?>

				 	<td><span class="label {{ $label }}">{{ $category->amount }}</span></td>
				 </tr>
			@endforeach
		</tbody>
	</table>
@endsection