<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('contact.index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $input = $request->validated();
        $input['tel'] = $input['tel_1'] . '-' . $input['tel_2'] . '-' . $input['tel_3'];
        $category = Category::find($input['category_id']);
        return view('contact.confirm', compact('input', 'category'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Contact::create([
            'category_id' => $input['category_id'],
            'first_name'  => $input['first_name'],
            'last_name'   => $input['last_name'],
            'gender'      => $input['gender'],
            'email'       => $input['email'],
            'tel'         => $input['tel'],
            'address'     => $input['address'],
            'building'    => $input['building'] ?? null,
            'detail'      => $input['detail'],
        ]);
        return redirect()->route('thanks');
    }

    public function thanks()
    {
        return view('contact.thanks');
    }

    public function back(Request $request)
    {
        return redirect()->route('contact')->withInput($request->all());
    }
}
