<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::with('category');

        if ($request->filled('name')) {
            $name = $request->name;
            $query->where(function ($q) use ($name) {
                $q->where('first_name', 'LIKE', '%' . $name . '%')
                  ->orWhere('last_name', 'LIKE', '%' . $name . '%')
                  ->orWhereRaw("CONCAT(first_name, last_name) LIKE ?", ['%' . $name . '%'])
                  ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $name . '%']);
            });
        }

        if ($request->filled('email')) {
            $query->where('email', 'LIKE', '%' . $request->email . '%');
        }

        if ($request->filled('gender') && $request->gender !== '0' && $request->gender !== '') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->paginate(7)->withQueryString();
        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories'));
    }

    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->route('admin.index');
    }

    public function export(Request $request)
    {
        $query = Contact::with('category');

        if ($request->filled('name')) {
            $name = $request->name;
            $query->where(function ($q) use ($name) {
                $q->where('first_name', 'LIKE', '%' . $name . '%')
                  ->orWhere('last_name', 'LIKE', '%' . $name . '%')
                  ->orWhereRaw("CONCAT(first_name, last_name) LIKE ?", ['%' . $name . '%'])
                  ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $name . '%']);
            });
        }

        if ($request->filled('email')) {
            $query->where('email', 'LIKE', '%' . $request->email . '%');
        }

        if ($request->filled('gender') && $request->gender !== '0' && $request->gender !== '') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->get();

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ];

        $callback = function () use ($contacts) {
            $file = fopen('php://output', 'w');
            // BOM（ExcelでのCSV文字化け防止）
            fputs($file, "\xEF\xBB\xBF");
            fputcsv($file, ['ID', '名前', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'お問い合わせの種類', 'お問い合わせ内容', '登録日時']);

            foreach ($contacts as $contact) {
                if ($contact->gender == 1) {
                    $genderLabel = '男性';
                } elseif ($contact->gender == 2) {
                    $genderLabel = '女性';
                } else {
                    $genderLabel = 'その他';
                }

                fputcsv($file, [
                    $contact->id,
                    $contact->first_name . ' ' . $contact->last_name,
                    $genderLabel,
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building,
                    $contact->category->content ?? '',
                    $contact->detail,
                    $contact->created_at,
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
