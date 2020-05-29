{{-- Breadcrumb --}}
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>

    @foreach(array_filter(explode('/', request()->path())) as $slug)
        <li class="breadcrumb-item"> <span>{{ ucwords(str_replace('-', ' ', $slug)) }}</span> </li>
    @endforeach
</ol>