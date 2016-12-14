@extends('layout.index')
	
@section('content')
	
	<div class="panel panel-default">
		<div class="panel-heading"><h3 class="panel-title">Questão</h1></div>

		<div class="panel-body">
			<form class="form-horizontal" action="{{ url('question') }}" method="POST">
				{{ csrf_field() }}

				<div class="form-group">
					<label class="col-sm-1 control-label">Tipo</label>
					<div class="col-sm-11">
						<select name="type_id" class="form-control">
							@foreach( $types as $type )
								<option value="{{ $type->id }}">
									{{ $type->name . ' - ' . $type->description }}
								</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-1 control-label">Prova</label>
					<div class="col-sm-11">
						<select name="exam_id" class="form-control">
							@foreach( $exams as $exam )
								<option value="{{ $exam->id }}">
									{{ $exam->title }}
								</option>
							@endforeach
						</select>
					</div>
				</div>

				{{--<div class="form-group">
					<label class="col-sm-1 control-label">Instituto</label>
					<div class="col-sm-11">
						<select name="instiute_id" class="form-control">
							@foreach( $institutes as $institute )
								<option value="{{ $institute->id }}">
									{{ $institute->name }}
								</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-1 control-label">Cargo</label>
					<div class="col-sm-11">
						<select name="job_id" class="form-control">
							@foreach( $jobs as $job )
								<option value="{{ $job->id }}">
									{{ $job->name }}
								</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-1 control-label">Banca</label>
					<div class="col-sm-11">
						<select name="jury_id" class="form-control">
							@foreach( $juries as $jury )
								<option value="{{ $jury->id }}">
									{{ $jury->name }}
								</option>
							@endforeach
						</select>
					</div>
				</div> --}}
				
				<div class="form-group">
					<label class="col-sm-1 control-label">Decrição</label>
					<div class="col-sm-11">
						<textarea name="description" class="form-control" rows="3"></textarea>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-11">
						 <button type="submit" class="btn btn-default">Salvar</button>
					</div>
				</div>
			</form>
		</div>
	</div>

@endsection