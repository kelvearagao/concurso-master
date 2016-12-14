$(document).ready(function() {
	console.log('test');
});


$(document).on('click', '.option-remove', function() {
	console.log('remover opção');
 
	var $this = $(this);

	$this.closest('.option').remove();
});


$('.option-add').click(function() {
	/*
	var html = '<div class="option">'+
		'op 1 <a href="#" class="option-remove"><span class="glyphicon glyphicon-remove"></span></a>'+
		'</div>';

	$('.options').append(html);
	*/
});

/**
 * Cria uma nova opção para questão.
 */

$('.save-option').click(function() {
	var data = {
		'question_id' : $('.question').first().attr('data-id'),
		'option_description' : $('.new-option-description').first().val(),
		'_token' : $('input:hidden[name=_token]').val()
	};

	$.ajax({
		type: 'post',
		url: BASE_URL + '/question/create/option',
		data: data
	})
	.done(function(result) {
		var $div = $('.options').first().closest('div');

		$div.empty().append(result);
		$('.new-option-description').first().val('');
	})
	.fail(function(result) {
		console.log(result)
	});
});

$(document).on('click', '.delete-option', function(e) {
	var $this = $(this);
	var $tr = $this.closest('tr');

	var option_id = $tr.attr('data-id');
	var token = $('input:hidden[name=_token]').val();

	$.ajax({
		type: 'DELETE',
		url: BASE_URL + '/question/option/'+option_id,
		data: { _token : token }
	})
	.done(function(result) {
		var $div = $('.options').first().closest('div');

		$div.empty().append(result);
	})
	.fail(function(result) {
		console.log(result)
	});

	e.preventDefault();
});

$(document).on('click', '.update-question', function(e) {
	var question_id = $('.question').first().attr('data-id');
	var option_id = $('input[name=answer]:checked').val();

	var data = {
		question_description : $('.question').first().val(),
		answer_option_id: option_id,
		_token : $('input:hidden[name=_token]').val()
	};

	$.ajax({
		type: 'PUT',
		url: BASE_URL + '/question/'+question_id,
		data: data
	})
	.done(function(result) {
		alert('Atualização realizada com sucesso!');
	})
	.fail(function(result) {
		console.log(result)
	});

	e.preventDefault();
});

/**
 * Abri a questão no modal para ser respondida.
 */
$(document).on('click', '.open-question', function() {
	var question_id = $(this).closest('tr').attr('data-id');

	$.ajax({
		type: 'GET',
		url: BASE_URL + '/question/'+question_id+'/modal'
	})
	.done(function(result) {
		$('#modal-question').find('.modal-body').empty().append(result);
	})
	.fail(function(result) {
		console.log(result)
	});
});

/**
 * Responder a questão dentro do modal.
 */
$('.answer-question').click(function() {
	var question_id = $('#modal-question .question-container').first().attr('data-id');
	var option_id =  $('#modal-question input[name=answer]:checked').val();

	$.ajax({
		type: 'GET',
		url: BASE_URL + '/question/'+question_id+'/option/'+option_id+'/answer'
	})
	.done(function(result) {
		var $question = $('#question-'+question_id);

		$question.removeClass('bg-success');
		$question.removeClass('bg-danger');

		if( result == 'true' )
		{
			alert('Resposta certa!');
			$question.addClass('bg-success');
		}
		else
		{
			alert('Resposta errada!');
			$question.addClass('bg-danger');
		}
	})
	.fail(function(result) {
		console.log(result)
	});
});

/**
 * Módulo das categorias. 
 *
 */
 (function() {
 	/**
 	 * Traz as categorias.
 	 *
 	 */
	(function() {
		$.ajax({
			type: 'get',
			url: BASE_URL + '/question/categories'
		})
		.done(function(result) {
			var categories = result;

			$('.question-category-typeahead').typeahead({
				hint: true,
				highlight: true,
				minLength: 1
			},
			{
				name: 'states',
				source: substringMatcher(categories)
			});
		})
		.fail(function() {
			console.log('Falha ao retorna as categorias!');
		})
	})();

	/**
	 * Realiza pesquisa.
	 *
	 */
	var substringMatcher = function(strs) {
	  return function findMatches(q, cb) {
	    var matches, substringRegex;

	    // an array that will be populated with substring matches
	    matches = [];

	    // regex used to determine if a string contains the substring `q`
	    substrRegex = new RegExp(q, 'i');

	    // iterate through the pool of strings and for any string that
	    // contains the substring `q`, add it to the `matches` array
	    $.each(strs, function(i, str) {
	      if (substrRegex.test(str)) {
	        matches.push(str);
	      }
	    });

	    cb(matches);
	  };
	};

	$('.add-category').click(function() {
		var question_id = $('.question').first().data('id');
		var name = $('.question-category-typeahead.tt-input').first().val();

		$.ajax({
			type: 'get',
			url: BASE_URL + '/question/'+question_id+'/add/category/'+name
		})
		.done(function(result) {
			if( result.msg == 'success' )
			{
				var category = result.data;

				console.log('Categoria adicionada com sucesso!');
				$('.question-category-typeahead.tt-input').first().val('');
				var html = "<span class='label label-info' style='padding-right: 10px;'>"
					+ category.name 
					+ "<a href='#'' data-id='"+ category.id + "'"
					+ " class='destroy-question-category'> "
					+ "<span class='glyphicon glyphicon-remove'></span>"
					+ "</a> "
				    + "</span>"

				$('.js-categories').append(html);
			}
			else
				console.log('Erro ao adicionar a tegoria!');
		})
		.fail(function(result) {
			console.log('Falha ao adicionar a categoria!');
		});
	});

	$(document).on('click', '.destroy-question-category', function(e) {
		e.preventDefault();

		var $this = $(this);
		var category_id = $this.attr('data-id');
		var token = $('input:hidden[name=_token]').val();
		var question_id = $('.question').first().data('id');

		$.ajax({
			type: 'POST',
			url: BASE_URL + '/question/' + question_id + '/category/' + category_id,
			data: {_method: 'DELETE', _token: token}
		}).done(function(data) {
			if(data == 'success')
				$this.closest('span').remove();
		}).fail(function() {
			console.log('Erro ao deletar a categoria do produto!');
		});
	});

 })()