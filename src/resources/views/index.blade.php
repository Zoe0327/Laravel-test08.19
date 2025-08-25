@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Contact</h2>
    </div>
    <form class="form" action="{{ url('/contacts/confirm') }}" method="post">
        @csrf

        <!-- お名前 -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input-name-container">
                    <div class="form__input--last_name">
                        <input type="text" name="last_name" placeholder="例）山田" value="{{ old('last_name', $inputs['last_name'] ?? '') }}"/>
                        <div class="form__error">
                            @error('last_name')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form__input--first_name">
                        <input type="text" name="first_name" placeholder="例）太郎" value="{{ old('first_name', $inputs['first_name'] ?? '') }}"/>
                        <div class="form__error">
                            @error('first_name')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 性別 -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--radio">
                    <label>
                        <input type="radio" name="gender" value="male" {{ old('gender', $inputs['gender'] ?? 'male') == 'male' ? 'checked' : '' }}>男性
                    </label>
                    <label>
                        <input type="radio" name="gender" value="female" {{ old('gender', $inputs['gender'] ?? '') == 'female' ? 'checked' : '' }}>女性
                    </label>
                    <label>
                        <input type="radio" name="gender" value="other" {{ old('gender', $inputs['gender'] ?? '') == 'other' ? 'checked' : '' }}>その他
                    </label>
                    <div class="form__error">
                        @error('gender')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- メールアドレス -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--email">
                    <input type="email" name="email" placeholder="例）test@example.com" value="{{ old('email', $inputs['email'] ?? '') }}"/>
                    <div class="form__error">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <!-- 電話番号 -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--tel">
                    <input type="text" name="tel1" maxlength="5" placeholder="080" value="{{ old('tel1', $inputs['tel1'] ?? '') }}"> -
                    <input type="text" name="tel2" maxlength="5" placeholder="1234" value="{{ old('tel2', $inputs['tel2'] ?? '') }}"> -
                    <input type="text" name="tel3" maxlength="5" placeholder="5678" value="{{ old('tel3', $inputs['tel3'] ?? '') }}">
                    <div class="form__error">
                        @if ($errors->has('tel1'))
                        {{ $errors->first('tel1') }}
                        @elseif ($errors->has('tel2'))
                        {{ $errors->first('tel2') }}
                        @elseif ($errors->has('tel3'))
                        {{ $errors->first('tel3') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- 住所 -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--address">
                    <input type="text" name="address" placeholder="例）東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address', $inputs['address'] ?? '') }}">
                    <div class="form__error">
                        @error('address'){{ $message }}@enderror
                    </div>
                </div>
            </div>
        </div>
        <!-- 建物名 -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--building">
                    <input type="text" name="building" placeholder="例）千駄ヶ谷マンション101" value="{{ old('building', $inputs['building'] ?? '') }}">
                    <div class="form__error">@error('building'){{ $message }}@enderror</div>
                </div>
            </div>
        </div>
        <!-- お問い合わせの種類 -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <select name="category_id" required>
                    <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>選択してください</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $inputs['category_id'] ?? '') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                    @endforeach
                </select>

                <div class="form__error">
                    @error('category_id')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <!-- お問い合わせ内容 -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ内容</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea name="content" placeholder="お問い合わせ内容をご記載ください">{{ old('content', $inputs['content'] ?? '') }}</textarea>
                    <div class="form__error">
                        @error('content')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>

    </form>
</div>
@endsection
