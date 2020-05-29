<?php $rand = uniqid(); ?>

<div class="card {{ $class ?? '' }}">

    @isset($header)
        <div class="card-header" v-b-toggle.{{ $rand }}>
            {{ $header }}
        </div>
    @endisset

    <b-collapse id="{{ $rand }}" visible>
        <div class="card-body">

            {{ $slot }}

        </div>
    </b-collapse>

    @if(isset($footer) && !empty($footer->toHtml()))
        <div class="card-footer">{{ $footer }}</div>
    @endif
</div>