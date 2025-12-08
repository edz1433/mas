<!-- Sidebar -->
<div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <!-- Dashboard -->
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" 
                   class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-home"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <!-- Drive (Free - Your Original Style) -->
            <li class="nav-item">
                <a href="{{ route('drive') }}" class="nav-link {{ request()->is('drive*') || request()->is('account*') || request()->is('logs*')? 'active' : '' }}">
                    <i class="nav-icon fas fa-folder"></i>
                    <p>
                        Drive
                    </p>
                </a>
            </li>

            <!-- PREMIUM MODULES - ELEMENTARY ONLY (Your Style + Lock Icons) -->
            <li class="nav-header">PREMIUM MODULES</li>

            <li class="nav-item">
                <a href="#" class="nav-link" onclick="checkPremium(event)">
                    <i class="nav-icon fas fa-user-graduate"></i>
                    <p>
                        Students & Enrollment
                        <i class="right fas fa-lock text-gray"></i>
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link" onclick="checkPremium(event)">
                    <i class="nav-icon fas fa-file-alt"></i>
                    <p>
                        Grades & Form 137
                        <i class="right fas fa-lock text-gray"></i>
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link" onclick="checkPremium(event)">
                    <i class="nav-icon fas fa-award"></i>
                    <p>
                        Promotion & Completion
                        <i class="right fas fa-lock text-gray"></i>
                    </p>
                </a>
            </li>

            <!-- ADMIN SECTION (Only for Admins - Your Original) -->
            @if(auth()->user()->role == "Administrator" || auth()->user()->role == "Principal" )
                <li class="nav-header">ADMINISTRATION</li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" 
                       class="nav-link {{ request()->is('users*') || request()->is('ulist*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>

                <!-- Settings (Your Original) -->
                <li class="nav-item">
                    <a href="#" 
                    class="nav-link {{ request()->is('settings*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-gear"></i>
                        <p>Settings</p>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
</div>

<!-- Premium Modal (Same Style as Your App) -->
<!-- Premium Feature Modal – Professional & Polite (Paid but Limited Plan) -->
<!-- Upgrade Prompt – Professional & Respectful (Paid User with Limited Access) -->
<script>
function checkPremium(e) {
    e.preventDefault();

    Swal.fire({
        icon: 'info',
        title: 'Unlock Full Features',
        html: `
            <div class="text-center mb-4">
                <i class="fas fa-school fa-3x text-primary mb-3"></i>
            </div>

            <p class="mb-4">
                Your current access includes <strong>Document Drive</strong> only.<br>
                To manage students, grades, and generate Form 137, upgrade your account:
            </p>

            <div class="text-left px-4 mb-4">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> Student Enrollment & Masterlist</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> Quarterly Grades & Report Cards</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> Auto-Generate Form 137 (SF10)</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> Promotion & Grade 6 Completers</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> Full School Management Tools</li>
                </ul>
            </div>

            <p class="text-muted small">
                One-time upgrade • Lifetime access • No recurring fees
            </p>
        `,
        showCancelButton: true,
        confirmButtonText: '<i class="fas fa-crown mr-2"></i> Upgrade Now',
        cancelButtonText: 'Maybe Later',
        confirmButtonColor: '#1e90ff',
        cancelButtonColor: '#6c757d',
        width: '620px',
        customClass: {
            popup: 'rounded shadow-lg border-0',
            confirmButton: 'btn btn-primary px-5 py-2',
            cancelButton: 'btn btn-secondary px-4 py-2 ml-2'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "#"; // your upgrade route
        }
    });
}
</script>