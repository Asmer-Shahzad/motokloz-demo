@extends('layouts.app')

@section('content')
<style>
    .coming-soon-container{
        height:500px;
        display:flex;
        justify-content:center;
        align-items:center;
    }

    .logo {
        font-size: 32px;
        font-weight: bold;
        letter-spacing: 2px;
        margin-bottom: 20px;
    }

    .coming-soon-heading {
        font-size: 48px;
        font-weight:bold;
        margin-bottom: 10px;
        text-align:center;
    }

    .coming-soon-heading span {
        font-size: 48px;
        font-weight:bold;
        margin-bottom: 10px;
        text-align:center;
    }
</style>
<div class="coming-soon-container">
    <h1 class="coming-soon-heading">Coming<span style="color:#F58D02;"> Soon</span> </h1>
</div>
@endsection