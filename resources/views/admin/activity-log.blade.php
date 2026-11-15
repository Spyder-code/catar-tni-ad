@extends('layouts.admin')

@section('page', 'Riwayat Aktivitas')

@section('content')
<div class="card">
    <div class="card-body">
        <form method="GET" action="{{ route('admin-activity.index') }}" class="row g-2 mb-3">
            <div class="col-md-2">
                <select name="role" class="form-select" aria-label="Peran">
                    <option value="">Semua peran</option>
                    <option value="admin" @selected(($filters['role'] ?? '') === 'admin')>Admin</option>
                    <option value="superadmin" @selected(($filters['role'] ?? '') === 'superadmin')>Superadmin</option>
                </select>
            </div>
            <div class="col-md-2"><input type="number" min="1" name="user_id" class="form-control" placeholder="ID pengguna" value="{{ $filters['user_id'] ?? '' }}"></div>
            <div class="col-md-2"><input type="date" name="date_from" class="form-control" value="{{ $filters['date_from'] ?? '' }}" aria-label="Dari tanggal"></div>
            <div class="col-md-2"><input type="date" name="date_to" class="form-control" value="{{ $filters['date_to'] ?? '' }}" aria-label="Sampai tanggal"></div>
            <div class="col-md-2"><button class="btn btn-primary" type="submit">Filter</button> <a href="{{ route('admin-activity.index') }}" class="btn btn-secondary">Reset</a></div>
        </form>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead><tr><th>Waktu</th><th>Pengguna</th><th>Peran</th><th>Aktivitas</th><th>Rute</th><th>Metode</th><th>Status</th><th>IP</th></tr></thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>{{ $log->created_at?->format('d-m-Y H:i:s') }}</td>
                            <td>{{ $log->user_name }} ({{ $log->user_id }})</td>
                            <td>{{ $log->user_role }}</td>
                            <td>{{ $log->action }}</td>
                            <td>{{ $log->route_name ?? $log->path }}<br><small>{{ $log->path }}</small></td>
                            <td>{{ $log->method }}</td>
                            <td>{{ $log->status_code }}</td>
                            <td>{{ $log->ip_address }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center">Belum ada aktivitas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $logs->links() }}
    </div>
</div>
@endsection
