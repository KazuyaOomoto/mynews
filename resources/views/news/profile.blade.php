@extends('layouts.front')
@section('title', 'プロフィール')

@section('content')
    <div class="container">
        <h1 class="profile_main_title">プロフィール</h1>
        <h2 class="profile_sub_title">名前</h2>
            <p class="profile_sub_detail">{{ $profile_form->name }}</p>
        <h2 class="profile_sub_title">性別</h2>
            <p class="profile_sub_detail">{{ $profile_form->gender }}</p>
        <h2 class="profile_sub_title">趣味</h2>
            <p class="profile_sub_detail">{{ $profile_form->hobby }}</p>
        <h2 class="profile_sub_title">自己紹介文</h2>
            <p class="profile_sub_detail">{{ $profile_form->introduction }}</p>
        </p>
    </div>
@endsection
