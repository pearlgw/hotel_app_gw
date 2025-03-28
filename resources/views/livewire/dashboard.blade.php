<style>
    .dashboard-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .icon-wrapper {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: #fff;
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, #4e73df, #224abe);
    }

    .bg-gradient-success {
        background: linear-gradient(135deg, #1cc88a, #159c66);
    }

    .bg-gradient-danger {
        background: linear-gradient(135deg, #e74a3b, #be261c);
    }

    .bg-gradient-warning {
        background: linear-gradient(135deg, #f6c23e, #c99a11);
    }

    .bg-gradient-info {
        background: linear-gradient(135deg, #36b9cc, #278fa1);
    }
</style>

@hasanyrole('super_admin|admin|staff')
    <div class="my-5">
        <h3 class="mb-4 fw-semibold">Dashboard</h3>
        <div class="row g-4">
            <!-- Users -->
            <div class="col-md-6 col-xl-4">
                <div class="card dashboard-card border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-wrapper bg-gradient-primary">
                            <i class="bi bi-people-fill fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0">Total Users</h6>
                            <h4 class="fw-bold mb-0">{{ $total_user }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Reservations -->
            <div class="col-md-6 col-xl-4">
                <div class="card dashboard-card border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-wrapper bg-gradient-success">
                            <i class="bi bi-calendar-check-fill fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0">Total Reservations</h6>
                            <h4 class="fw-bold mb-0">{{ $total_reservation }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Transactions -->
            <div class="col-md-6 col-xl-4">
                <div class="card dashboard-card border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-wrapper bg-gradient-danger">
                            <i class="bi bi-receipt-cutoff fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0">Total Transactions</h6>
                            <h4 class="fw-bold mb-0">{{ $total_transaction ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bedrooms -->
            <div class="col-md-6 col-xl-4 mt-3">
                <div class="card dashboard-card border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-wrapper bg-gradient-warning">
                            <i class="bi bi-door-open-fill fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0">Total Bedrooms</h6>
                            <h4 class="fw-bold mb-0">{{ $total_bedroom }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Categories -->
            <div class="col-md-6 col-xl-4 mt-3">
                <div class="card dashboard-card border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-wrapper bg-gradient-info">
                            <i class="bi bi-tags-fill fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0">Total Categories</h6>
                            <h4 class="fw-bold mb-0">{{ $total_category ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="my-5">
        <h3 class="fw-semibold">Halo, selamat datang {{ auth()->user()->name }} 👋</h3>
    </div>
@endhasanyrole
