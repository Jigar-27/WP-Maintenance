@extends('layouts.admin')

@section('title', 'Plans & Features')

@section('content')
<style>
    /* Premium Admin Styles for Plans & Features */
    .admin-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: var(--space-6);
        gap: var(--space-4);
    }
    
    .plans-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: var(--space-6);
        margin-bottom: var(--space-10);
    }

    .plan-info-card {
        background: var(--surface-container-lowest);
        border-radius: var(--radius-lg);
        padding: var(--space-6);
        border: 1.5px solid rgba(228, 190, 180, 0.1);
        transition: all var(--transition-base);
        display: flex;
        flex-direction: column;
    }
    .plan-info-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary-fixed-dim);
    }

    .plan-info-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: var(--space-5);
    }

    .plan-title-box h3 {
        font-size: 1.125rem;
        font-weight: 800;
        color: var(--on-surface);
        margin-bottom: 0.25rem;
        letter-spacing: -0.01em;
    }
    .plan-price-tag {
        font-size: 1.5rem;
        font-weight: 900;
        color: var(--primary);
    }
    .plan-price-tag span { font-size: 0.8125rem; opacity: 0.7; font-weight: 600; }

    .plan-meta-row {
        display: flex;
        gap: var(--space-6);
        margin-bottom: var(--space-6);
        padding: 1rem;
        background: var(--surface-container-low);
        border-radius: var(--radius-md);
    }
    .plan-meta-item { display: flex; flex-direction: column; gap: 4px; }
    .plan-meta-label { font-size: 0.6875rem; font-weight: 800; color: var(--on-surface-variant); text-transform: uppercase; letter-spacing: 0.05em; }
    .plan-meta-val { font-size: 0.9375rem; font-weight: 700; color: var(--on-surface); }

    .tech-matrix-card {
        background: var(--surface-container-lowest);
        border-radius: var(--radius-xl);
        padding: var(--space-8);
        border: 1px solid rgba(228, 190, 180, 0.2);
        box-shadow: var(--shadow-md);
    }

    .tech-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    .tech-table th {
        text-align: left;
        padding: 1.25rem 1.5rem;
        background: var(--surface-container-low);
        font-size: 0.75rem;
        font-weight: 800;
        color: var(--on-surface-variant);
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }
    .tech-table th:first-child { border-radius: var(--radius-md) 0 0 var(--radius-md); }
    .tech-table th:last-child { border-radius: 0 var(--radius-md) var(--radius-md) 0; }
    
    .tech-table td {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--surface-container-low);
        vertical-align: middle;
    }
    .tech-table tr:hover td { background: var(--surface-container-low); transition: background 0.15s ease; }

    .feat-indicator { font-size: 1.25rem; font-weight: 900; }
    .feat-active { color: #ea580c; }
    .feat-inactive { color: #e2e8f0; }

    .hours-footer-row {
        background: var(--inverse-surface);
        border-radius: var(--radius-md);
    }
    .hours-footer-row td {
        color: white;
        font-weight: 800;
        padding: 1.5rem;
        border-bottom: none;
    }
    .hours-footer-row .feat-indicator { color: var(--primary-fixed-dim); }

    .admin-icon-btn.delete { color: var(--error); }
    .admin-icon-btn.delete:hover { background: var(--error-container); color: var(--on-error); }

    /* Premium Modal Styling */
    .p-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.4);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
    }
    .p-modal-card {
        background: white;
        width: 100%;
        max-width: 520px;
        border-radius: var(--radius-xl);
        box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.15);
        border: 1px solid var(--surface-container-high);
        overflow: hidden;
        animation: modalScaleUp 0.3s var(--ease-out);
    }
    @keyframes modalScaleUp {
        from { opacity: 0; transform: scale(0.95) translateY(10px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }
    .p-modal-header {
        padding: 1.75rem 2rem;
        border-bottom: 1px solid var(--surface-container-high);
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: var(--surface-container-low);
    }
    .p-modal-header h3 {
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--on-surface);
        display: flex;
        align-items: center;
        gap: 12px;
        letter-spacing: -0.01em;
    }
    .p-modal-body { padding: 2rem; }
    .p-modal-footer {
        padding: 1.5rem 2rem;
        background: var(--surface-container-low);
        border-top: 1px solid var(--surface-container-high);
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }
    .p-check-box {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 16px;
        background: var(--surface-container-low);
        border: 1px solid var(--surface-container-high);
        border-radius: var(--radius-md);
        cursor: pointer;
        transition: all 0.2s ease;
        flex: 1;
    }
    .p-check-box:hover { border-color: var(--primary-fixed-dim); background: white; }
    .p-check-box input { width: 18px; height: 18px; accent-color: var(--primary); }
    .p-check-box span { font-size: 0.8125rem; font-weight: 700; color: var(--on-surface); }
</style>


<div class="admin-container">
    <div class="admin-card-header">
        <div>
            <h1 class="headline-lg" style="margin-bottom: 8px;">Plans & Features</h1>
            <p class="body-md text-muted">Manage your core service tiers and the technical specification comparison matrix.</p>
        </div>
        <button class="btn btn-primary" onclick="openFeatureModal()">
            <span class="material-icons-outlined">add</span>
            Add Technical Feature
        </button>
    </div>

    {{-- 1. Core Plans Cards --}}
    <h2 class="title-lg" style="margin-bottom: 1.5rem; letter-spacing: -0.01em;">Core Service Tiers</h2>
    <div class="plans-grid">
        @foreach($plans as $plan)
        <div class="plan-info-card">
            <div class="plan-info-header">
                <div class="plan-title-box">
                    <h3>{{ $plan->name }}</h3>
                    <div class="plan-price-tag">${{ number_format($plan->price, 0) }}<span>/yr</span></div>


                </div>
                <button type="button" class="btn btn-icon btn-outline" title="Edit Plan" onclick="openPlanModal({{ $plan->id }}, '{{ addslashes($plan->name) }}', '{{ addslashes($plan->best_for) }}', {{ $plan->price }}, {{ $plan->dev_hours }}, '{{ $plan->is_popular ? 1 : 0 }}', '{{ is_array($plan->features) ? implode('\n', array_map('addslashes', $plan->features)) : '' }}')">
                    <span class="material-icons-outlined">edit</span>
                </button>

            </div>
            
            <div class="plan-meta-row">
                <div class="plan-meta-item">
                    <span class="plan-meta-label">Allocation</span>
                    <span class="plan-meta-val">{{ $plan->dev_hours }} Hours/yr</span>
                </div>
                <div class="plan-meta-item">
                    <span class="plan-meta-label">Status</span>
                    <span class="plan-meta-val">
                        @if($plan->is_popular)
                            <span class="badge badge-active" style="background:#fff7ed; color:#c2410c;">POPULAR</span>
                        @else
                            <span class="badge badge-pending" style="background:#f1f5f9; color:#64748b;">STANDARD</span>
                        @endif
                    </span>
                </div>
            </div>
            
            <p class="body-sm" style="color:var(--on-surface-variant); line-height:1.5;">{{ $plan->best_for ?: 'Precision-engineered for modern WordPress infrastructure and high-performance scaling.' }}</p>
        </div>
        @endforeach
    </div>

    {{-- 2. Technical Comparison Matrix --}}
    <div class="tech-matrix-card">
        <div style="margin-bottom: 2rem;">
            <h2 class="title-lg" style="margin-bottom: 4px;">Technical Specifications Matrix</h2>
            <p class="body-sm text-muted">Configure the features appearing in the "Compare Technical Specifications" frontend section.</p>
        </div>
        
        <div class="admin-table-wrapper">
            <table class="tech-table">
                <thead>
                    <tr>
                        <th style="width: 80px; text-align:center;">#ID</th>
                        <th>FEATURE NAME & TOOLTIP</th>
                        <th style="text-align:center;">STARTUP</th>
                        <th style="text-align:center;">SCALEUP</th>
                        <th style="text-align:center;">ENTERPRISE</th>
                        <th style="text-align:right; padding-right:2rem;">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($features as $feature)
                    <tr>
                        <td style="text-align:center; font-weight:800; color:var(--outline);">{{ $feature->sort_order }}</td>
                        <td>
                            <div style="font-weight:800; color:var(--on-surface); font-size:0.9375rem;">{{ $feature->name }}</div>
                            @if($feature->description)
                                <div class="body-sm" style="color:var(--on-surface-variant); font-size:0.75rem;">{{ $feature->description }}</div>
                            @endif
                        </td>
                        <td style="text-align:center;">
                            @if($feature->startup)
                                <span class="material-icons-outlined feat-indicator feat-active">check_circle</span>
                            @else
                                <span class="feat-indicator feat-inactive">—</span>
                            @endif
                        </td>
                        <td style="text-align:center;">
                            @if($feature->scaleup)
                                <span class="material-icons-outlined feat-indicator feat-active">check_circle</span>
                            @else
                                <span class="feat-indicator feat-inactive">—</span>
                            @endif
                        </td>
                        <td style="text-align:center;">
                            @if($feature->enterprise)
                                <span class="material-icons-outlined feat-indicator feat-active">check_circle</span>
                            @else
                                <span class="feat-indicator feat-inactive">—</span>
                            @endif
                        </td>
                        <td style="text-align:right; padding-right:1rem;">
                            <div style="display:flex; justify-content:flex-end; gap:8px;">
                                <button class="btn btn-icon btn-outline btn-sm" onclick="editFeature({{ $feature->id }}, '{{ addslashes($feature->name) }}', '{{ addslashes($feature->description) }}', {{ $feature->startup ? 1 : 0 }}, {{ $feature->scaleup ? 1 : 0 }}, {{ $feature->enterprise ? 1 : 0 }}, {{ $feature->sort_order }})">
                                    <span class="material-icons-outlined">edit</span>
                                </button>
                                <form action="{{ route('admin.plan-features.delete', $feature->id) }}" method="POST" onsubmit="return confirm('Delete this feature?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-icon btn-outline btn-sm delete">
                                        <span class="material-icons-outlined">delete_outline</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align:center; padding: 4rem; color:var(--outline);">
                            No technical features configured yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="hours-footer-row">
                        <td style="text-align:center; font-size:1.1rem;">★</td>
                        <td>CORE DEVELOPMENT TIME</td>
                        @foreach($plans as $plan)
                            <td style="text-align:center; font-size:1.1rem; color:{{ $plan->is_popular ? '#ea580c' : 'var(--primary-fixed-dim)' }}; font-weight:{{ $plan->is_popular ? '900' : 'normal' }};">
                                {{ $plan->dev_hours ?: 0 }} hrs
                            </td>
                        @endforeach
                        <td></td>
                    </tr>
                </tfoot>

            </table>
        </div>
    </div>
</div>

{{-- Premium Feature Modal --}}
<div id="featureModal" class="p-modal-overlay" onclick="if(event.target === this) closeFeatureModal()">
    <div class="p-modal-card">
        <div class="p-modal-header">
            <h3 id="modalTitle">
                <span class="material-icons-outlined" style="color:var(--primary);">category</span>
                Add Technical Feature
            </h3>
            <button class="btn btn-icon btn-ghost btn-sm" onclick="closeFeatureModal()" style="color:var(--outline);">
                <span class="material-icons-outlined">close</span>
            </button>
        </div>
        <form id="featureForm" action="{{ route('admin.plan-features.store') }}" method="POST">
            @csrf
            <div id="methodField"></div>
            
            <div class="p-modal-body">
                <div class="form-group">
                    <label class="form-label">Feature Name</label>
                    <input type="text" name="name" id="f_name" class="form-input" required placeholder="e.g. 24/7 Security Shield">
                    <p class="form-hint">Displayed as the main label in the comparison table.</p>
                </div>

                <div class="form-group">
                    <label class="form-label">Description (Optional Tooltip)</label>
                    <input type="text" name="description" id="f_desc" class="form-input" placeholder="e.g. Enterprise-grade protection for high-traffic sites">
                    <p class="form-hint">Will appear as an 'info' icon with a hover tooltip.</p>
                </div>

                <label class="form-label" style="display:block; margin-bottom:0.75rem;">Plan Availability</label>
                <div style="display:flex; gap:12px; margin-bottom:1.5rem;">
                    <label class="p-check-box">
                        <input type="checkbox" name="startup" id="f_startup" value="1">
                        <span>Startup</span>
                    </label>
                    <label class="p-check-box">
                        <input type="checkbox" name="scaleup" id="f_scaleup" value="1">
                        <span>Scaleup</span>
                    </label>
                    <label class="p-check-box">
                        <input type="checkbox" name="enterprise" id="f_enterprise" value="1">
                        <span>Enterprise</span>
                    </label>
                </div>

                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label">Sequence (Sort Order)</label>
                    <input type="number" name="sort_order" id="f_order" class="form-input" value="0">
                    <p class="form-hint">Rows are sorted low to high (e.g., 1 appears before 2).</p>
                </div>
            </div>

            <div class="p-modal-footer">
                <button type="button" class="btn btn-outline" onclick="closeFeatureModal()">Cancel</button>
                <button type="submit" class="btn btn-primary">
                    <span class="material-icons-outlined" style="font-size:1.1rem;">save</span>
                    Save Feature
                </button>
            </div>
        </form>
    </div>
{{-- Premium Plan Edit Modal --}}
<div id="planModal" class="p-modal-overlay" onclick="if(event.target === this) closePlanModal()">
    <div class="p-modal-card">
        <div class="p-modal-header">
            <h3 id="p_modalTitle">
                <span class="material-icons-outlined" style="color:var(--primary);">payments</span>
                Edit Service Tier
            </h3>
            <button class="btn btn-icon btn-ghost btn-sm" onclick="closePlanModal()" style="color:var(--outline);">
                <span class="material-icons-outlined">close</span>
            </button>
        </div>
        <form id="planForm" action="" method="POST">
            @csrf
            @method('PUT')
            
            <div class="p-modal-body">
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; margin-bottom:1.5rem;">
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label">Plan Name</label>
                        <input type="text" name="name" id="p_name" class="form-input" required>
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label">Yearly Price ($)</label>
                        <input type="number" name="price" id="p_price" class="form-input" required step="0.01">
                        <p class="form-hint">Enter the total annual investment amount.</p>

                    </div>

                </div>

                <div class="form-group">
                    <label class="form-label">Best For (Tagline)</label>
                    <input type="text" name="best_for" id="p_best_for" class="form-input" placeholder="e.g. WooCommerce Stores">
                </div>

                <div class="form-group">
                    <label class="form-label">Annual Dev Hours</label>
                    <input type="number" name="dev_hours" id="p_hours" class="form-input" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Features List (Bulk Edit)</label>
                    <textarea name="features" id="p_features" class="form-input" style="height:120px; font-family:monospace; font-size:0.8125rem;" placeholder="One feature per line..."></textarea>
                    <p class="form-hint">Enter each feature on a new line. These will be displayed as checkmarks on the site.</p>
                </div>

                <div class="form-group" style="margin-bottom:0;">
                    <label class="p-check-box" style="flex:none; width:fit-content;">
                        <input type="checkbox" name="is_popular" id="p_popular" value="1">
                        <span>Mark as "Most Popular" Tier</span>
                    </label>
                </div>
            </div>

            <div class="p-modal-footer">
                <button type="button" class="btn btn-outline" onclick="closePlanModal()">Cancel</button>
                <button type="submit" class="btn btn-primary">
                    <span class="material-icons-outlined" style="font-size:1.1rem;">save</span>
                    Update Pricing Plan
                </button>
            </div>
        </form>
    </div>
</div>


    function openFeatureModal() {
        document.getElementById('modalTitle').innerText = 'Add Technical Feature';
        document.getElementById('featureForm').action = "{{ route('admin.plan-features.store') }}";
        document.getElementById('methodField').innerHTML = "";
        document.getElementById('f_name').value = "";
        document.getElementById('f_desc').value = "";
        document.getElementById('f_startup').checked = false;
        document.getElementById('f_scaleup').checked = false;
        document.getElementById('f_enterprise').checked = false;
        document.getElementById('f_order').value = "0";
        document.getElementById('featureModal').style.display = 'flex';
    }

    function editFeature(id, name, desc, startup, scaleup, enterprise, order) {
        document.getElementById('modalTitle').innerText = 'Edit Technical Feature';
        document.getElementById('featureForm').action = `/admin/plan-features/${id}`;
        document.getElementById('methodField').innerHTML = '@method("PUT")';
        document.getElementById('f_name').value = name;
        document.getElementById('f_desc').value = desc;
        document.getElementById('f_startup').checked = startup === 1;
        document.getElementById('f_scaleup').checked = scaleup === 1;
        document.getElementById('f_enterprise').checked = enterprise === 1;
        document.getElementById('f_order').value = order;
        document.getElementById('featureModal').style.display = 'flex';
    }

    function closeFeatureModal() {
        document.getElementById('featureModal').style.display = 'none';
    }

    function openPlanModal(id, name, bestFor, price, hours, isPopular, features) {
        document.getElementById('planForm').action = `/admin/plans/${id}`;
        document.getElementById('p_name').value = name;
        document.getElementById('p_best_for').value = bestFor;
        document.getElementById('p_price').value = price;
        document.getElementById('p_hours').value = hours;
        document.getElementById('p_popular').checked = isPopular == 1;
        document.getElementById('p_features').value = features.replace(/\\n/g, '\n');
        document.getElementById('planModal').style.display = 'flex';
    }

    function closePlanModal() {
        document.getElementById('planModal').style.display = 'none';
    }
</script>

@endsection
