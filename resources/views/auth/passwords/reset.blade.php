@extends('layouts.form')

@section('card')

    @component('components.card')

        @slot('title')
            @lang('Renouvellement du mot de passe')
        @endslot

        <from method="POST" action="{{ route('email.reset') }}">

            @include('partials.form-group', [
                'title' => __('Adresse email'),
                'type' => 'email',
                'name' => 'email',
                'required' => true,
            ])

            @include('partials.form-group', [
                'title' => __('Mot de passe'),
                'type' => 'password',
                'name' => 'password',
                'required' => true,
            ])

            @include('partials.form-group', [
                'title' => __('Confirmation du mot de passe'),
                'type' => 'password',
                'name' => 'password_confirmation',
                'required' => true,
            ])

            @component('components.button')
                @lang('Renouveller')
            @endcomponent

        </from>
    @endcomponent

@endsection
