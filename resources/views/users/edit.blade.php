@extends('layouts.form')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/css/bootstrap-slider.min.css">
@endsection

@section('card')

    @slot('title')
        @lang('Modifier le profil')
    @endslot

    <form method="POST" action="{{ route('profile.update', $user->id) }}" class="text-white">
        {{csrf_field()}}
        {{method_field('PUT')}}
        @include('partials.form-group', [
            'title' => __('Adresse email'),
            'type' => 'email',
            'name' => 'email',
            'value' => $user->email,
            'required' => true,
        ])

        <div class="form-group text-white">
            @lang('Pagination : ')
            <span id="nbr">{{ $settings->pagination }}</span>
            @lang('images par page')<br>
            <input id="pagination" name="pagination" type="number" data-slider-min="3" data-slider-max="20" data-slider-step="1" data-slider-value="{{ $settings->pagination }}" data-slider-enabled="false"/><br>
            <input id="pagination-enabled" type="checkbox"/> @lang('Activer le curseur')
        </div>

        @component('components.button')
            @lang('Envoyer')
        @endcomponent
    </form>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.9.0/bootstrap-slider.min.js"></script>
    <script>
        $(function() {
            $("#pagination").slider()
                .on("slide", function(e) {
                    $("#nbr").text(e.value)
                })
                .on("change", function(e) {
                    $("#nbr").text(e.value.newValue)
                })
            $('#pagination-enabled').click(function () {
                if(this.checked)
                    $("#pagination").slider("enable")
                else
                    $("#pagination").slider("disable")
            })
        })
    </script>
@endsection