<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $inputs = $request->all();

        return view('index', compact('categories', 'inputs'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel1',
            'tel2',
            'tel3',
            'address',
            'building',
            'category_id',
            'content'
        ]);
        $contact['tel'] = $contact['tel1'] . $contact['tel2'] . $contact['tel3'];

        session(['contact' => $contact]);

        $categories = Category::pluck('content', 'id')->toArray();
        return view('confirm', compact('contact', 'categories'));
    }

    public function store(ContactRequest $request)
    {
        $genderMap = [
            'male' => 1,
            'female' => 2,
            'other' => 3,
        ];
        $tel = $request->input('tel');

        $contact = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'address',
            'building',
            'category_id',
            'content'
        ]);
        $contact['gender'] = $genderMap[$contact['gender']] ?? 1;
        $contact['tel'] = $tel;
        $contact['detail'] = $contact['content'];
        unset($contact['content']);

        Contact::create($contact);
        return redirect()->route('contacts.thanks');
    }

    public function edit(Request $request)
    {
        $categories = Category::all();
        $inputs = $request->all();
        $tel = $inputs['tel'];
        $inputs['tel1'] = substr($tel, 0, 3);
        $inputs['tel2'] = substr($tel, 3, 4);
        $inputs['tel3'] = substr($tel, 7, 4);

        return view('index', compact('categories', 'inputs'));
    }

    public function thanks()
    {
        return view('thanks');
    }
}