<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\QuestionType;
use App\Question;
use App\Option;
use App\QuestionOption;
use App\QuestionOptionAnswer;
use App\Category;
use App\Exam;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( isset($_GET['cat']) )
            $questions = Category::where('name', 'like', $_GET['cat'])->first()->questions()->get();
        else    
            $questions = Question::all();

        return view('question.index', ['questions' => $questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = QuestionType::all();
        $exams = Exam::all();

        return view('question.create', [
            'types' => $types,
            'exams' => $exams
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = Question::create([
            'description' => $request->description,
            'type_id' => $request->type_id
        ]); 

        $exam = Exam::find($request->exam_id);

        $exam->questions()->save($question);

        return redirect('question/' . $question->id . '/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = \App\Question::find($id);
        $types = QuestionType::all();

        $type = $question->type;
        $options = $question->options()->get();

        $answer = $question->answer()->first();

        return view('question.edit', [
            'question' => $question,
            'types' => $types,
            'options' => $options,
            'answer_id' => ! empty($answer->id) ? $answer->id : ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $option_id = $request->answer_option_id;

        $question = Question::find($id);
        $question->description = $request->question_description;
        $question->save();

        QuestionOptionAnswer::where('question_id', $id)->delete();

        if( ! empty($option_id) )
        {
            QuestionOptionAnswer::create([
                'question_id' => $id,
                'option_id' => $option_id
            ]);
        }

        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function createOption(Request $request)
    {
        $question_id = $request->question_id;
        $option_description = $request->option_description;

        $option = Option::create(['description' => $option_description]);

        $question_option = QuestionOption::create([
            'question_id' => $question_id,
            'option_id' => $option->id
        ]);

        $options = Question::find($question_id)->options()->get();

        return view('question.options', ['options' => $options]);
    }

    public function destroyOption($option_id)
    {
        $option = Option::find($option_id);
        $question = $option->question()->first();

        $option->delete();

        $options = $question->options()->get();

        return view('question.options', ['options' => $options]);
    }

    public function showModal($question_id)
    {
        $question = Question::find($question_id);
        $options = $question->options()->get();
        $options = $this->randomOptions($options);

        return view('question.modal', [
            'question' => $question,
            'options' => $options
        ]);
    }

    public function isAnswer($question_id, $option_id)
    {
        $count = QuestionOptionAnswer::where('question_id', $question_id)
            ->where('option_id', $option_id)->count();

        if( $count > 0 )
            return 'true';

        return 'false';
    }

    /**
     * Retorna as questões ordenasdas aleatoriamente.
     *
     */
    private function randomOptions($options)
    {
        $count = $options->count();
        $list = [];
        foreach( $options as $option )
            $list[] = $option;

        shuffle($list);

        return $list;
    }

    /**
     * Retorna as categorias.
     *
     */
    public function getCategories() {
        return Category::all()->pluck('name');
    }

    /**
     * Adiciona uma categoria a questão
     *
     */
    public function addCategory($question_id, $category_name) {
        // Pesquisa pela categoria
        $category = Category::where('name', 'like', $category_name)->first();

        // Se não existir, salva
        if( empty($category) )
            $category = Category::create(['name' => $category_name]);

        // Pesquisa pela questão
        $question = Question::find($question_id);

        // Adiciona a categoria a questão
        $question->categories()->attach($category);

        return [
            'msg' => 'success',
            'data' => $category
        ];
    }

    public function destroyQestionCategory($question_id, $category_id) {
        $question = Question::find($question_id);
        $question->categories()->detach($category_id);

        return 'success';
    }

}
