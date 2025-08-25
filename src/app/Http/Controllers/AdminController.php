<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Contact::query();

        if ($request->filled('keyword')) {
            //半角スペース・全角スペース・スペースなしに対応する用設定
            $keyword = str_replace([' ', '　'], '', $request->keyword);

            $query->where(function ($q) use ($keyword, $request) {
                $q->Where('last_name', 'like', "%{$keyword}%")
                    ->orWhere('first_name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$request->keyword}%")
                    ->orWhere(DB::raw("REPLACE(CONCAT(last_name, first_name), ' ', '')"), 'like', "%{$keyword}%");
            });
        }
        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->paginate(7);

        return view('admin', compact('contacts', 'categories'));
    }
}
