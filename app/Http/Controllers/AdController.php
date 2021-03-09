<?php


namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdController
{
    public function create()
    {
        $submit = true;

        return view('ad.form', compact('submit'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => ['required'],
            'description' => ['required'],
        ]);

        $data['user_id'] = Auth::id();
        $ad = Ad::create($data);

        return redirect()->route('read', $ad->id)->with('success', "Ad \"{$ad->title}\" successfully saved");
    }

    public function read($id)
    {
        $ads[] = Ad::find($id);

        return view('pages.index', compact('ads'));
    }

    public function edit($id)
    {
        $ad = Ad::find($id);
        $submit = false;

        return view('ad.form', compact('ad', 'submit'));
    }

    public function update(Request $request, $id)
    {
        $ad = Ad::find($id);

        $data = $request->validate([
            'title'       => ['required'],
            'description' => ['required'],
        ]);



        $ad->update($data);

        return redirect()->route('read', $ad->id)->with('success', "Ad \"{$ad->title}\" successfully saved");;
    }

    public function destroy($id)
    {
        $ad = Ad::find($id);
        $ad->delete();

        return redirect()->route('home')->with('success', "Ad \"{$ad->title}\" successfully deleted");;
    }
}
