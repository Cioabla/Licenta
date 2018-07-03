@extends('layouts.layout')

@section('style')

@endsection

@section('content')

<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="signup-form"><!--sign up form-->
                    <h2 class="text-center">New User Signup!</h2>
                    <form method="post" action="/register/user">
                        {{ csrf_field() }}

                        <input id="name" name="name" type="text" placeholder="Name"
                            @if(!empty($user->name))
                                value="{{ $user->name }}"
                                    @endif
                        />
                        <p id="p-name"><span id="span-name">
                                @if(!empty($user->error->name))
                                    value="{{ $user->error->name }}"
                                @endif
                            </span></p>

                        <input id="username" name="username" type="text" placeholder="Username"
                            @if(!empty($user->username))
                                value="{{ $user->username }}"
                                    @endif
                        />
                        <p id="p-username"><span id="span-username">
                        @if(!empty($user->error->username))
                                    {{ $user->error->username }}
                                @endif
                            </span></p>

                        <input id="email" name="email" type="email" placeholder="Email Address"
                            @if(!empty($user->email))
                                 value="{{ $user->email }}"
                                    @endif
                        />
                        <p id="p-email"><span id="span-email">
                                @if(!empty($user->error->email))
                                    {{ $user->error->email }}
                                @endif
                            </span></p>


                        <input id="password" name="password" type="password" placeholder="Password"/>
                        <p id="p-password"><span id="span-password"></span></p>
                        <input id="password2" name="password2" type="password" placeholder="Retype password"/>
                        <p id="p-password2"><span id="span-password2"></span></p>
                        @if(!empty($user->error->password))
                        {{ $user->error->password }}
                        @endif
                        <button type="submit" class="btn btn-default">Signup</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->
@endsection

@section('script')
    <script>

        var typingTimer;                //timer identifier
        var doneTypingInterval = 400;  //time in ms, 0.4 second for example
        var currentName;
        var currentEmail;
        var currentUsername;
        var currentPassword;
        var currentPassword2;


        $('#name').on('keyup', function () {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        });


        $('#name').on('keydown', function () {
            clearTimeout(typingTimer);
            currentName = true;
        });

        $('#email').on('keyup', function () {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        });


        $('#email').on('keydown', function () {
            clearTimeout(typingTimer);
            currentEmail = true;
        });

        $('#username').on('keyup', function () {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        });


        $('#username').on('keydown', function () {
            clearTimeout(typingTimer);
            currentUsername = true;
        });

        $('#password').on('keyup', function () {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        });


        $('#password').on('keydown', function () {
            clearTimeout(typingTimer);
            currentPassword = true;
        });

        $('#password2').on('keyup', function () {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        });


        $('#password2').on('keydown', function () {
            clearTimeout(typingTimer);
            currentPassword2 = true;
        });


        function doneTyping () {
            if(currentName == true)
            {
                var letters = /^[a-zA-Z ]+$/;
                var value = $('#name').val();
                if(!value.match(letters) && value.length != 0)
                {
                    $('#span-name').remove();
                    $('#p-name').append('<span id="span-name">Name must contain only letters and space</span>');
                }else {
                    if(value.length <= 2 && value.length != 0) {
                        $('#span-name').remove();
                        $('#p-name').append('<span id="span-name">Name must be greater than 2 letters</span>');
                    }else if(value.length >= 30)
                    {
                        $('#span-name').remove();
                        $('#p-name').append('<span id="span-name">Name must be less than 30 letters</span>');
                    }else {
                        $('#span-name').remove();
                    }
                }

                currentName = false;
            }
            if(currentEmail == true)
            {
                var api_url = '{{ env('API_URL') }}';
                var value = $('#email').val();
                var letters = /^[0-9a-zA-Z.@_-]+$/;
                if(!value.match(letters) && value.length != 0)
                {
                    $('#span-email').remove();
                    $('#p-email').append('<span id="span-email">Email must contain only letters or numbers or _ or - or @</span>');

                }else{

                    if(value.length <= 5 && value.length != 0) {
                        $('#span-email').remove();
                        $('#p-email').append('<span id="span-email">Email must be greater than 5 letters</span>');
                    }else if(value.length >= 100)
                    {
                        $('#span-email').remove();
                        $('#p-email').append('<span id="span-email">Email must be less than 100 letters</span>');
                    }else {

                        if(value != '')
                        {
                            $.ajax({
                                type: 'get',
                                url: 'http://'+api_url+'/users/checkEmail/'+value,
                                dataType: 'jsonp',
                                success: function (data) {
                                    if (data == true) {
                                        $('#span-email').remove();
                                        $('#p-email').append('<span id="span-email">Email '+value+' is taken</span>');
                                    }else if(data === false)
                                    {
                                        $('#span-email').remove();
                                        $('#p-email').append('<span id="span-email">Email '+value+' is not taken</span>');
                                    }
                                }
                            });
                        }else if(value == '')
                        {
                            $('#span-email').remove();
                        }
                    }

                }
                currentEmail = false;
            }
            if(currentUsername == true)
            {
                var api_url = '{{ env('API_URL') }}';
                var value = $('#username').val();
                var letters = /^[0-9a-zA-Z_-]+$/;
                if(!value.match(letters) && value.length != 0)
                {
                    $('#span-username').remove();
                    $('#p-username').append('<span id="span-username">Username must contain only letters or numbers or _ or -</span>');

                }else{

                    if(value.length <= 5 && value.length != 0) {
                        $('#span-username').remove();
                        $('#p-username').append('<span id="span-username">Username must be greater than 5 letters</span>');
                    }else if(value.length >= 15)
                    {
                        $('#span-username').remove();
                        $('#p-username').append('<span id="span-username">Username must be less than 15 letters</span>');
                    }else {

                        if(value != '')
                        {
                            $.ajax({
                                type: 'get',
                                url: 'http://'+api_url+'/users/checkUsername/'+value,
                                dataType: 'jsonp',
                                success: function (data) {
                                    if (data == true) {
                                        $('#span-username').remove();
                                        $('#p-username').append('<span id="span-username">Username '+value+' is taken</span>');
                                    }else if(data === false)
                                    {
                                        $('#span-username').remove();
                                        $('#p-username').append('<span id="span-username">Username '+value+' is not taken</span>');
                                    }
                                }
                            });
                        }else if(value == '')
                        {
                            $('#span-username').remove();
                        }
                    }

                }

                currentUsername = false;
            }
            if(currentPassword == true)
            {
                // var letters = /^[a-zA-Z ]+$/;
                var value = $('#password').val();
                // alert(value);

                    if(value.length <= 7 && value.length != 0) {
                        $('#span-password').remove();
                        $('#p-password').append('<span id="span-password">Password must be greater than 7 letters</span>');
                    }else if(value.length >= 20)
                    {
                        $('#span-password').remove();
                        $('#p-password').append('<span id="span-password">Password must be less than 20 letters</span>');
                    }else {
                        $('#span-password').remove();
                    }
                currentPassword = false;
            }
            if(currentPassword2 == true)
            {
                // var letters = /^[a-zA-Z ]+$/;
                var value = $('#password').val();
                var value2 = $('#password2').val();
                // alert(value);

                if(value != value2) {
                    $('#span-password2').remove();
                    $('#p-password2').append('<span id="span-password2">Please retype same password</span>');
                }else {
                $('#span-password2').remove();
                 }
                // currentPassword2 = false;
            }
        }

    </script>
@endsection