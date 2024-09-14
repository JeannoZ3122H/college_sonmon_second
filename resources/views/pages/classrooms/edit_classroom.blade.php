@extends('main.admin_layout')
@section('title')
    Modifier une classe
@endsection
@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Modifier de la classe /</span>niveau d'étude</h4>
    <div class="row justify-content-center">
        <div class="col-md-6 col-12">
            <div class="card mb-4">
                <h4 class="card-header">Modifier de la classe</h4>
                <div class="card-body pt-2 mt-1">
                    @if($data)
                        <form id="formAccountSettings" method="POST" action="{{ route('dashboard.update_classroom_request', $data->id) }}">
                            @csrf
                            <div class="row mt-2 justify-content-center">
                                <div class="col-12 mb-3">
                                    <div class="form-floating form-floating-outline">
                                        <select id="classroom" name="classroom" class="select2 form-select">
                                            <option selected value="{{ $data->classroom }}">{{ $data->classroom }}</option>
                                            @foreach ($liste_classe as $item)
                                                <option value="{{ $item->niveau_etude }}">{{ $item->niveau_etude }}</option>
                                            @endforeach
                                        </select>
                                        <label for="classroom">Selectionnez la classe</label>
                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    <div class="form-floating form-floating-outline">
                                        <select id="level" name="level" class="select2 form-select">
                                            <option selected value="{{ $data->level }}">{{ $data->level }}</option>
                                            @foreach ($liste_level as $item)
                                                @if ($item == '')
                                                    <option disabled>{{ $item }}</option>
                                                @else
                                                    <option value="{{ $item }}">{{ $item }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <label for="level">Selectionnez le niveau </label>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                        class="form-control"
                                        type="text"
                                        id="building"
                                        name="building"
                                        value="{{ $data->building == null?'':$data->building }}"
                                        placeholder="Bâtiment où est la classe"
                                        autofocus />
                                        <label for="building">Le numéro ou la lettre du bâtiment <code>(champ facultatif)</code></label>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="mdi mdi-home-plus-outline me-2"></i>
                                    Modifier la classe</button>
                                <a role="button" href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                    Retour
                                </a>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->
@endsection
