<?php

namespace App\Http\Controllers;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Models\Block;


class TopicController extends Controller
{
    
    public function index()
    {
        $topics=Topic::all();
        //dd($topics);
        $id=0;
        return view('topic.index',['page'=>'home','topics'=>$topics,'id'=>$id]);
    }

   
    public function create()
    {
        $topic=new Topic;
        return view('topic.create',['topic'=>$topic]);
    }

    
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

   
    public function show($id)
    {
        $blocks=Block::where('topicid','=',$id)->get();
        $topics=Topic::all();
        return view('topic.index',['page'=>'Main page','topics'=>$topics,'id'=>$id,'blocks'=>$blocks]);
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        $topic=Topic::find($id);
        $topic->delete();
        return redirect('topic');
    }



    public function search(Request $request)
    {
        $search=$request->searchform;   
        $search='%'.$search.'%';
        $topics=Topic::where('topicname','like', $search)->get();
        //dd($topics);
        return view('topic.index',['page'=>'Main Page','topics'=>$topics,'id'=>0]);
    }
}
