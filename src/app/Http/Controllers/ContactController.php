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
        $input = $request->except('_token');
        $input['tel'] = $request->tel_1 . $request->tel_2 . $request->tel_3;
        $category = Category::find($request->category_id);
        return view('contact.confirm', compact('input', 'category'));
    }

    public function store(Request $request)
    {
        $input = $request->except(['_token', 'tel_1', 'tel_2', 'tel_3']);
        Contact::create($input);
        return redirect()->route('thanks');
    }

    public function thanks()
    {
        return view('contact.thanks');
    }

    public function back(Request $request)
    {
        $input = $request->except('_token');
        $categories = Category::all();
        return view('contact.index', compact('input', 'categories'));
    }
}
