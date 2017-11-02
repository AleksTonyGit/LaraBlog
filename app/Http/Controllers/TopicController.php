<?php

namespace App\Http\Controllers;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Models\Block;


class TopicController extends Controller
{

   /* отображение всех топиков на странице 'index'*/
    public function index()
    {
        $topics=Topic::all();
        $id=0;
        return view('topic.index',['page'=>'home','topics'=>$topics,'id'=>$id]);
    }


    /*форма создания нового Топика*/
    public function create()
    {
        $topic=new Topic;
        return view('topic.create',['topic'=>$topic]);
    }

    /*обработка формы создания нового Топика*/
    public function store(Request $request)
    {
        $topic=new Topic;
        $topic->topicname=$request->topicname;
        if(!$topic->save())
        {
            $err=$topic->getErrors();
            return redirect()->action('TopicController@create')->with('errors',$err)->withInput();
        }
            return redirect()->action('TopicController@create')->with('success',"Заголовок был добавлен с id=".$topic->id);
    }


   /*Отображение контента выбраного Топика*/
    public function show($id)
    {
        $blocks=Block::where('topicid','=',$id)->get();
        $topics=Topic::all();
        return view('topic.index',['page'=>'Main page','topics'=>$topics,'id'=>$id,'blocks'=>$blocks]);
    }


    /*удаление Топика*/
    public function destroy($id)
    {
        $topic=Topic::find($id);
        $topic->delete();
        return redirect('topic');
    }


    /*поиск Топика*/
    public function search(Request $request)
    {
        $search=$request->searchform;   
        $search='%'.$search.'%';
        $topics=Topic::where('topicname','like', $search)->get();
        //dd($topics);
        return view('topic.index',['page'=>'Main Page','topics'=>$topics,'id'=>0]);
    }
}
