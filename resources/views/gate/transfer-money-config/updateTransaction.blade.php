@extends('index')
@section('page-header', 'Cập nhật giao dịch')
@section('page-sub-header', 'Cập nhật giao dịch')
@section('style')
    <style>
        textarea::-webkit-input-placeholder {
          color: #959cb6;
        }

        textarea:-moz-placeholder { /* Firefox 18- */
          color: #959cb6;
        }

        textarea::-moz-placeholder {  /* Firefox 19+ */
          color: #959cb6;
        }

        textarea:-ms-input-placeholder {
          color: #959cb6;
        }

        textarea::placeholder {
          color: #959cb6;
        }
    </style>
@endsection
@section('content')
<livewire:gate.transfer-money-config.update-transaction />
@endsection

@section('script')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
@endsection
