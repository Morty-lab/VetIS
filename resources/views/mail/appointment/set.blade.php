<x-mail::message>
    {{ config('app.name') }}

    {!! $data['content'] !!}


    Status: {{ $data['status'] }}


    Thank you for being a part of our community!
    — {{ config('app.name') }}
</x-mail::message>
