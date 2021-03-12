<?php


namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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

    public function read(Ad $ad)
    {
        $ads[] = $ad;

        return view('pages.index', compact('ads'));
    }

    public function edit(Ad $ad)
    {
        $response = Gate::inspect('update', $ad);

        if ($response->allowed()){

            $submit = false;

            return view('ad.form', compact('ad', 'submit'));
        }
        return redirect()->route('home');
    }

    public function update(Request $request, Ad $ad)
    {

        $response = Gate::inspect('update', $ad);

        if ($response->allowed()){

            $data = $request->validate([
                'title'       => ['required'],
                'description' => ['required'],
            ]);

            $ad->update($data);

            return redirect()->route('read', $ad->id)->with('success', "Ad \"{$ad->title}\" successfully saved");
        }
    }

    public function destroy(Ad $ad)
    {
        $response = Gate::inspect('delete', $ad);

        if ($response->allowed()){

            $ad->delete();

            return redirect()->route('home')->with('success', "Ad \"{$ad->title}\" successfully deleted");
        }
    }
}
