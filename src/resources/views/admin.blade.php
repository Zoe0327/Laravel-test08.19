@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="category__content">
    <div class="category-title">
        <h2>Admin</h2>
    </div>
    <form class="search-form" action="{{ url('/search') }}" method="GET">
        <!-- 名前・メール用の検索ボックス -->
        <div class="form-group">
            <input class="form-control_keyword" type="text" name="keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください">
        </div>

        <!-- 性別 -->
        <div class="form-group">
            <select class="form-control_gender" name="gender">
                <option value="">性別</option>
                <option value="all" {{ request('gender') == 'all' ? 'selected' : '' }}>全部</option>
                <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
            </select>
        </div>

        <!-- お問い合わせ種類 -->
        <div class="form-group">
            <select class="form-control_category" name="category_id">
                <option value="">お問い合わせの種類</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- 日付 -->
        <div class="form-group">
            <input class="form-control_date" type="date" name="date" value="{{ request('date') }}" placeholder="年/月/日">
        </div>
        <div class="form-group">
            <div class="category__button">
                <button class="search-button" type="submit">検索</button>
                <button class="reset-button" type="button" onclick="window.location='{{ url('/admin') }}'">リセット</button>
            </div>
        </div>
    </form>
    <div class="top-footer">
        <!-- エクスポート （送信の設定をする際にtype=submitに修正が必要）-->
        <div class="export__button">
            <button class="export-submit" type="button">エクスポート</button>
        </div>
        <!-- ページネーション -->
        <div class="pagination-wrapper">
            <ul class="pagination">
                {{-- 前へ --}}
                <li class="{{ $contacts->onFirstPage() ? 'disabled' : '' }}">
                    @if ($contacts->onFirstPage())
                        <span>＜</span>
                    @else
                        <a href="{{ $contacts->previousPageUrl() }}">＜</a>
                    @endif
                </li>
                {{-- ページ番号 --}}
                @for ($i = 1; $i <= $contacts->lastPage(); $i++)
                    <li class="{{ $contacts->currentPage() == $i ? 'active' : '' }}">
                        <a href="{{ $contacts->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                {{-- 次へ --}}
                <li class="{{ $contacts->currentPage() == $contacts->lastPage() ? 'disabled' : '' }}">
                    @if ($contacts->currentPage() == $contacts->lastPage())
                        <span>＞</span>
                    @else
                        <a href="{{ $contacts->nextPageUrl() }}">＞</a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- お問い合わせ一覧 -->
<div class="category__table">
    <table class="table-bordered">
        <thead>
            <tr>
                <th>名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                    <td>
                        @if($contact->gender == 1) 男性
                        @elseif($contact->gender == 2) 女性
                        @else その他
                        @endif
                    </td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category->content ?? '' }}</td>
                    <td><a class="btn btn-sm btn-info" href="#">詳細</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection