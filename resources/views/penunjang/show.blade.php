@extends('layouts.coreui')

@section('title', $title)

@section('content')

@component('kunjungan.banner', ['kunjungan' => $kunjungan, 'title' => $title])
    <b-form-group label="Catatan:">
        <textarea
            class="form-control"
            disabled
            placeholder="Catatan"
            readonly>{{ $penunjang->catatan }}
        </textarea>
    </b-form-group>
@endcomponent

<b-card no-body>
    <b-tabs lazy card>
        @include('penunjang.' . $tindakan)
    </b-tabs>
</b-card>

@endsection