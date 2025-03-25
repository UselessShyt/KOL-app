@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Dashboard</div>

            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Commission</h5>
                                <h2 class="text-success">RM{{ number_format($totalCommission, 2) }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Sales</h5>
                                <h2>{{ $totalSales }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Your Referral Code</h5>
                        <div class="input-group">
                            <input type="text" class="form-control" value="{{ $referralCode }}" readonly>
                            <button class="btn btn-outline-secondary" type="button" onclick="copyToClipboard('{{ $referralCode }}')">
                                Copy
                            </button>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('simulate.sale') }}" class="text-center">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg">
                        Simulate Sale (RM1,000)
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('Referral code copied to clipboard!');
    });
}
</script>
@endsection 