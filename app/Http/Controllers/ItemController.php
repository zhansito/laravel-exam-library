<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::where('status', 1)->get();
        $tags  = Tag::all();

        return view('pages.items.all', compact('items', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Item;
        $item->title = $request->title;
        $item->price = $request->price;
        $item->status = $request->status;
        $item->description = $request->description;

        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $item->user()->associate($user);

        $item->save();

        return redirect()->route('items.edit', ['id'=>$item->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::with('likes')
                    ->with('views')
                    ->with('reviews')
                    ->findOrFail($id);

        if(auth()->user())
        {
            $user = auth()->user();

            $latestview = $item ->views()
                                ->where('user_id', $user->id)
                                ->where('created_at', '>=', date('Y-m-d', strtotime('-15 seconds')))
                                ->orderBy('created_at', 'DESC')
                                ->first();

            if(!$latestview)
            {
                $item->views()->create(['user_id' => $user->id]);
            }                                
        }

        return view('pages.items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $tags = Tag::all();

        return view('pages.items.edit', compact('item', 'tags'));
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
        $item = Item::findOrFail($id);
        $item->title = $request->title;
        $item->price = $request->price;
        $item->status = $request->status;
        $item->photo_url = $request->photo_url;
        $item->description = $request->description;
        $item->save();

        return back();
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

    public function attach_tag(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $tag = Tag::findOrFail($request->tag_id);

        if($item->tags()->where('tag_id', $tag->id)->count() == 0)
        {
            $item->tags()->attach($tag);
        }

        return back();
    }

    public function detach_tag(Request $request, $id)
    {
        $item= Item::findOrFail($id);
        $tag = Tag::findOrFail($request->tag_id);

        $item->tags()->detach($tag);

        return back();
    }

    public function show_by_tag($id)
    {
        $tag_id = $id;
        $items = Item::whereRelation('tags', 'tag_id', $tag_id)->get();
        $tags = Tag::all();

        return view('pages.items.by_tag', compact('items', 'tags'));
    }

    public function like($id)
    {
        $item = Item::findOrFail($id);
        $user = auth()->user();

        if($user && $item && !$item->is_liked)
        {
            $item->likes()->create(['user_id' => $user->id]);
        }

        return back();
    }

    public function dislike($id)
    {
        $item = Item::findOrFail($id);
        $user = auth()->user();

        if($user && $item && $item->is_liked)
        {
            $item->likes()->where('user_id', $user->id)->delete();
        }

        return back();
    }

    public function add_to_basket(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $user = auth()->user();

        if($user && $item)
        {
            $basket_item = $item->users()->where('user_id', $user->id)->orderby('created_at', 'DESC')->first();
            if($basket_item)
            {
                $item->users()->where('user_id', $user->id)->update(['amount' => $request->amount]);
            } else {
                $item->users()->attach($user->id, ['amount' => $request->amount]);
            }

            return back();
        }
    }
    
    public function remove_from_basket($id)
    {
            $item = Item::findOrFail($id);
            $user = auth()->user();

            if($user && $item)
            {
                $basket_item = $item->users()->where('user_id', $user->id)->orderby('created_at', 'DESC')->first();
                if($basket_item)
                {
                    $item->users()->detach($user->id);
                }
            }

            return back();
    }

    public function review_store(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $user = auth()->user();

        if($user && $item)
        {
            $item->reviews()->create([
                'user_id' =>$user->id,
                'rating' =>$request->rating,
                'body'    =>$request->body,
            ]);
        }

        return back();
    }
}