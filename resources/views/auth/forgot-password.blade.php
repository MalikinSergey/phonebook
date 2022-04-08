@extends('app.layout')


@section('content')

    <div class="mspb-layer">
        <div class="mspb-container pt-128 d-f jc-c ai-c">
            <div class="mspb-card mspb-card--small">
                <div class="mspb-card__title">Forgot password?</div>
                <div class="mspb-card__subtitle mb-24">at ms-phonebook</div>

                @if($errors->count())
                    <div class="mspb-alert mspb-alert--error mb-24" role="alert">
                        @foreach($errors->all() as $msg)
                            <p>{{trans($msg)}}</p>
                        @endforeach
                    </div>
                @endif

                @if(session('status'))
                    <div class="mspb-alert mspb-alert--success mb-24" role="alert">
                        <p>{{session('status')}}</p>
                    </div>
                @endif

                @if(session('dev_password_reset_link'))
                    <div>
                        <p>
                            <a class="link link--primary mb-16" href="{{session('dev_password_reset_link')}}">Reset password link (dev only)</a>
                        </p>
                    </div>
                @endif

                <form method="post" action="{{route('password.email')}}">
                    @csrf

                    <div class="mspb-form-group mb-16">
                        <label class="mspb-label" for="email">Email</label>
                        <input id="email" class="mspb-input" type="text" name="email" value="{{old('email')}}"/>
                    </div>

                    <div class="d-f ai-c">
                        <button type="submit" class="mspb-button mspb-button--primary">Send me reset password link</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection