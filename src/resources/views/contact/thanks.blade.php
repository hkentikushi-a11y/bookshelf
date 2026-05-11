@extends('layouts.app')

@section('content')
<style>
    .thanks-wrap {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 65px);
    }

    .thanks-box {
        text-align: center;
        padding: 60px 80px;
        background-color: #fff;
        border-radius: 4px;
    }

    .thanks-box p {
        font-size: 18px;
        margin-bottom: 30px;
        color: #333;
    }
</style>

<div class="thanks-wrap">
    <div class="thanks-box">
        <p>お問い合わせありがとうございました</p>
        <a href="{{ route('contact.index') }}" class="btn btn-primary">HOME</a>
    </div>
</div>
@endsection
