@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__content">
    <div class="confirm__heading">
        <h2>Confirm</h2>
    </div>

    <form action="{{ route('contacts.store') }}" method="POST">
        @csrf
        <table class="confirm-table">
            <tr>
                <th>お名前</th>
                <td>
                    {{ $contact['last_name'] }} {{ $contact['first_name'] }}
                    <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}" />
                    <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}" />
                </td>
            </tr>
            <tr>
                <th>性別</th>
                <td>
                    @php
                        $genders = ['male' => '男性', 'female' => '女性', 'other' => 'その他'];
                    @endphp
                    {{ $genders[$contact['gender']] ?? '未選択' }}
                    <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                </td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>
                    {{ $contact['email'] }}
                    <input type="hidden" name="email" value="{{ $contact['email'] }}" />
                </td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>
                    {{ $contact['tel'] ?? '' }}
                    <input type="hidden" name="tel" value="{{ $contact['tel'] ?? '' }}" />
                </td>
            </tr>
            <tr>
                <th>住所</th>
                <td>
                    {{ $contact['address'] }}
                    <input type="hidden" name="address" value="{{ $contact['address'] }}" />
                </td>
            </tr>
            <tr>
                <th>建物名</th>
                <td>
                    {{ $contact['building'] ?? '-' }}
                    <input type="hidden" name="building" value="{{ $contact['building'] ?? '' }}" />
                </td>
            </tr>
            <tr>
                <th>お問い合わせの種類</th>
                <td>
                    {{ $categories[$contact['category_id']] ?? '未選択' }}
                    <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}" />
                </td>
            </tr>
            <tr>
                <th>お問い合わせ内容</th>
                <td style="white-space: pre-wrap;">{{ $contact['content'] }}<input type="hidden" name="content" value="{{ $contact['content'] }}" />
                </td>
            </tr>
        </table>
        
        <div class="form__buttons-wrapper">
            <button class="form__button-submit" type="submit">送信</button>

            <button class="form__button-edit" type="submit" formaction="{{ route('contacts.edit') }}">修正</button>
        </div>
    </form>
</div>
@endsection