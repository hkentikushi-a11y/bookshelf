@extends('layouts.app')

@section('content')
<div class="container" style="display:flex; justify-content:center; align-items:center; min-height:60vh;">
    <div class="form-card" style="text-align:center; padding:60px 80px;">
        <p style="font-size:18px; letter-spacing:1px; color:#555; margin-bottom:40px;">
            お問い合わせありがとうございました
        </p>
        <a href="{{ route('contact') }}" class="btn" style="display:inline-block;">HOME</a>
    </div>
</div>
@endsection
