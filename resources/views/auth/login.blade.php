@extends('layouts.layout')

@section('style')

@endsection

@section('content')

    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="signup-form"><!--sign up form-->
                        <h2 class="text-center">Login!</h2>
                        <form method="post" action="/login/user">
                            {{ csrf_field() }}
                            <input name="name" type="text" placeholder="Name"/>
                            <input name="password" type="password" placeholder="Password"/>
                            {{--<input name="address" type="text" placeholder="Address"/>--}}
                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                        <a href="/register"><button type="submit" class="btn btn-default">Signup</button></a>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
@endsection

@section('script')

@endsection