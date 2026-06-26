@extends('layouts.app')

@section('title', $realisation['title'] . ' – Djibo Services')

@section('content')

    <div class="breadcrumb-area bg-color-primary py-5 text-center text-white" style="background-image: linear-gradient(135deg, var(--vert-dark), var(--vert));">
        <div class="container">
            <h1 class="font-weight-bold text-white mb-2">{{ $realisation['title'] }}</h1>
            <p class="lead m-0" style="color: var(--jaune-agri) !important; font-weight: 700;">{{ $realisation['location'] }} · {{ $realisation['impact'] }}</p>
        </div>
    </div>

    <div class="container my-5">
        <div class="row">
            <div class="col-lg-8">
                <img src="{{ asset($realisation['image']) }}" alt="{{ $realisation['title'] }}" class="img-fluid rounded mb-4">
                <div class="card p-4">
                    <div class="card-body">
                        <p style="white-space:pre-line;">{!! nl2br(e($realisation['description'])) !!}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card p-3">
                    <h5>Informations</h5>
                    <ul class="list-unstyled mt-3">
                        <li><strong>Localisation:</strong> {{ $realisation['location'] }}</li>
                        <li><strong>Impact:</strong> {{ $realisation['impact'] }}</li>
                    </ul>
                    <a href="https://wa.me/22392692448?text=Je%20souhaite%20en%20savoir%20plus%20sur%20le%20projet%20{{ urlencode($realisation['title']) }}" target="_blank" class="btn btn-success mt-3">Contactez-nous</a>
                </div>
            </div>
        </div>
    </div>

@endsection
