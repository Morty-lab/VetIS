@foreach ($notifications as $notification)
    <a href="{{ $notification->link }}" class="text-decoration-none">
        <div class="card mb-3 shadow-sm">
            <!-- Header -->
            <div class="card-header d-flex align-items-center bg-{{ $notification->notification_type }} text-white">
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
