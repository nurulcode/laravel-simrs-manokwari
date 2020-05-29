@extends('layouts.coreui')

@section('content')
<b-tabs v-model='selected_tab' lazy no-fade> @yield('tabs') </b-tabs>
@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            selected_tab: 0
        }
    }
});
</script>
@endpush