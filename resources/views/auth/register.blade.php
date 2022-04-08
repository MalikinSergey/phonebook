@extends('app.layout')


@section('content')

    <div class="mspb-layer">
        <div class="mspb-container pt-128 d-f jc-c ai-c">
            <div class="mspb-card mspb-card--small">
                <div class="mspb-card__title">Register</div>
                <div class="mspb-card__subtitle mb-24">at ms-phonebook</div>

                @if($errors->count())
                    <div class="mspb-alert mspb-alert--error mb-24" role="alert">
                        @foreach($errors->all() as $msg)
                            <p>{{trans($msg)}}</p>
                        @endforeach
                    </div>
                @endif

                <form method="post" action="{{route('auth.store')}}">
                    @csrf

                    <div class="mspb-form-group mb-16">
                        <label class="mspb-label" for="name">Your name</label>
                        <input id="name" class="mspb-input" type="text" name="name" value="{{old('name')}}"/>
                    </div>

                    <div class="mspb-form-group mb-16">
                        <label class="mspb-label" for="email">Email</label>
                        <input id="email" class="mspb-input" type="text" name="email" value="{{old('email')}}"/>
                    </div>

                    <div class="mspb-form-group mb-16">
                        <label class="mspb-label" for="password">Password</label>
                        <input id="password" class="mspb-input" type="password" name="password" value=""/>
                    </div>

                    <div class="mspb-form-group mb-16">
                        <label class="mspb-label" for="password_confirmation">Password again</label>
                        <input id="password_confirmation" class="mspb-input" type="password" name="password_confirmation"/>
                    </div>

                    <div class="d-f ai-c">
                        <button type="submit" class="mspb-button mspb-button--primary">Register</button>
                        <div class="mr-16 ml-16">or</div>
                        <a href="/login" class="link link--primary">sign in</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection