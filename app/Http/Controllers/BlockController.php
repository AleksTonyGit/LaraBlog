<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Topic;
use App\Models\Block;

class BlockController extends Controller
{
    public function index()
    {
        //
    }

    /*создание нового контента при условии "Логина" пользователя*/
    public function create()
    {
        if (!Auth::check()) 
            {
                return redirect('login');
            }
        $block=new Block;
        $topics=Topic::pluck('topicname','id');   
        return view('block.create',['block'=>$block,'topics'=>$topics,'page'=>'AddBlock']);
    }


    /*обработка создания нового контента*/
    public function store(Request $request)
    {
        $block=new Block;
        $fname=$request->file('imagepath');
  
        if($fname != null)
            {
                $originalname=$request->file('imagepath')->getClientOriginalName();
                $request->file('imagepath')->move(public_path().'/images/',$originalname);
                $block->imagepath='/images/'.$originalname;
            }
            else
            {
                $block->imagepath='';
            }

            $block->title=$request->title;
            $block->topicid=$request->topicid;
            $block->content=$request->content;

            if(!$block->save())
            {
                $err=$block->getErrors();
                return redirect()->action('BlockController@create')->with('errors',$err)->withInput();
            }
            return redirect()->action('BlockController@create')->with('message','New block '.$block->title. 'has been added!');
    }

    /*форма изменения контента*/
    public function edit($id)
    {
        $block=Block::find($id);
        $topics=Topic::pluck('topicname','id');   
        return view('block.edit')->with('block',$block)->with('topics',$topics)->with('page','Main Page'); 
    }


    /*обработка изменений нового контента и запись в БД*/
    public function update(Request $request, $id)
    {
        $block=Block::find($id);
            $block->title=$request->title;
            $block->content=$request->content;
            $block->topicid=$request->topicid;
            $fname=$request->file('imagepath');
		if($fname != null)
		{
		    $originalname=$request->file('imagepath')->getClientOriginalName();
		    $request->file('imagepath')->move(public_path().'/images/',$originalname);
		    $block->imagepath='/images/'.$originalname;
		}
		    $block->save();
		    return redirect('topic/'.$block->topicid);
	}


	/*удаление контента*/
    public function destroy($id)
    {
        $block=Block::find($id);
        $block->delete();
        return redirect('topic');
    }
}
