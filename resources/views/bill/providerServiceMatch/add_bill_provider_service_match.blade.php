@extends('index')
@section('page-header', 'Bill Provider Service Match')
@section('page-sub_header', 'Thêm mới bill provider Service Match')
@section('content')
@livewire('bill.add-bill-provider-service-match', [
    'data' => $data,
    'partnerCodelist' => $partnerCodelist,
    'providerCodeList' => $providerCodeList
    ])

@endsection
@section('script')
<script src="admin/js/pages/bill/providerServiceMatch/add_provider_service_match.js" type="text/javascript" defer></script>
@endsection

@section('scriptlivewire')
    <script src="{{asset('js/bilProviderServiceMatch.js')}}"></script>
@endsection
