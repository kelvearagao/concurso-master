
	@extends('layout.index')
	
	@section('content')
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title">Questão</h1></div>

			<div class="panel-body">
				<form class="form-horizontal" action="{{ url('question') }}" method="POST">
					{{ csrf_field() }}

					<div class="form-group">
						<label class="col-sm-1 control-label">Categoria</label>
						<div class="col-sm-11">
							<div class="input-group">
								<input type="text" class="question-category-typeahead form-control" placeholder="Adicionar categoria">
								<span class="input-group-btn">
									<button class="btn btn-default add-category" type="button">Adicionar</button>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-11 js-categories">
							@foreach( $question->categories()->get() as $category )	
								<span class="label label-info">
									{{ $category->name }} 
									<a href="#" data-id="{{ $category->id }}" 
										class="destroy-question-category">
										<span class="glyphicon glyphicon-remove"></span>
									</a> 
								</span>&nbsp;
							@endforeach
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-1 control-label">Tipo</label>
						<div class="col-sm-11">
							<select name="type_id" class="form-control">
								@foreach( $types as $type )
									<option value="{{ $type->id }}" 
										{{ $type->id == $question->type_id ? 'selected' : '' }} >
										{{ $type->name . ' - ' . $type->description }}
									</option>
								@endforeach
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-1 control-label">Decrição</label>
						<div class="col-sm-11">
							<textarea name="description" class="form-control question" 
							rows="3" data-id="{{ $question->id }}">{{ $question->description }}</textarea>
						</div>
					</div>

					
					<div class="form-group">

						<div class="col-sm-1">
							Opções
						</div>

						<div class="col-sm-11">
	  						@include('question.options', ['options' => $options])
	  					</div>

	  				</div>

	  				<div class="form-group">
	  					<div class="col-sm-offset-1 col-sm-11">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
								<span class="glyphicon glyphicon-plus"></span> Adicionar opção
							</button>

							<button type="button" class="btn btn-success update-question">
								<span></span> Salvar
							</button>
						</div>
					</div>
					 
				</form>
			</div>
		</div>

		<!-- Modal new option -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Nova opção</h4>
					</div>
					<div class="modal-body">
						
						<textarea name="description" class="form-control new-option-description" rows="2"></textarea>
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary save-option">Save changes</button>
					</div>
				</div>
			</div>
		</div>
	@endsection

	