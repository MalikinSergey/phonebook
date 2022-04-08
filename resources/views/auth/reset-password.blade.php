@extends('app.layout')


@section('content')

    <div class="mspb-layer">
        <div class="mspb-container pt-128 d-f jc-c ai-c">
            <div class="mspb-card mspb-card--small">
                <div class="mspb-card__title">New password</div>
                <div class="mspb-card__subtitle mb-24">at ms-phonebook</div>

                @if($errors->count())
                    <div class="mspb-alert mspb-alert--error mb-24" role="alert">
                        @foreach($errors->all() as $msg)
                            <p>{{trans($msg)}}</p>
                        @endforeach
                    </div>
                @endif

                <form method="post" action="{{route('password.update')}}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <input type="hidden" name="email" value="{{ $request->email }}">

                    <div class="mspb-form-group mb-16">
                        <label class="mspb-label" for="password">Password</label>
                        <input id="password" class="mspb-input" type="password" name="password" value=""/>
                    </div>

                    <div class="mspb-form-group mb-16">
                        <label class="mspb-label" for="password_confirmation">Password again</label>
                        <input id="password_confirmation" class="mspb-input" type="password" name="password_confirmation"/>
                    </div>

                    <div class="d-f ai-c">
                        <button type="submit" class="mspb-button mspb-button--primary">Save my new password</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection