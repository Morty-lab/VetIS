@extends('layouts.app')

@section('content')
    <div class="container-xl px-4 mt-4">
        <h1 class="mb-4">Notifications</h1>

        <div id="notifications-container">
            @foreach ($notifications as $notification)
                <a href="{{ $notification->link }}" class="text-decoration-none">
                    <div class="card mb-3 shadow-sm">
                        <!-- Header -->
                        <div
                            class="card-header d-flex align-items-center bg-{{ $notification->notification_type }} text-white">
                            <i data-feather="activity" class="me-2"></i>
                            <strong>{{ ucfirst($notification->notification_type) }} Notification</strong>
                        </div>

                        <!-- Body -->
                        <div class="card-body text-dark">
                            <p class="mb-1">{{ $notification->message }}</p>
                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($notification->created_at)->format('F j, Y \a\\t g:i A') }}
                                ({{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }})
                            </small>
                        </div>
                    </div>
                </a>
            @endforeach

        </div>

        <div class="text-center mt-4">
            <button id="load-more" class="btn btn-outline-primary" data-page="2">Load More</button>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#load-more').on('click', function() {
            var page = $(this).data('page');

            $.ajax({
                url: "{{ route('notifications.load') }}?page=" + page,
                type: 'GET',
                success: function(data) {
                    if (data.html.trim() === '') {
                        $('#load-more').hide();
                    } else {
                        $('#notifications-container').append(data.html);
                        $('#load-more').data('page', page + 1);
                    }
                }
            });
        });
    </script>
@endsection
