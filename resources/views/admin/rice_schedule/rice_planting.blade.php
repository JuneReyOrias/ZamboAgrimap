@extends('admin.dashb')

@section('admin')

@extends('layouts._footer-script')
@extends('layouts._head')

<div class="page-content">

    @if (session('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="d-flex flex-wrap justify-content-center">
        <button class="btn btn-primary mx-2 my-2" onclick="showAllSections()">View All</button>
        @foreach($plantingSchedule as $district => $farmers)
        <button class="btn btn-primary mx-2 my-2" onclick="showSection('{{ strtoupper($district) }}')">{{ strtoupper($district) }}</button>
        @endforeach
    </div>

    <br>

    @foreach($plantingSchedule as $district => $farmers)
    {{-- <h4 class="mb-3 mb-md-0">{{ $district }} Rice Farmers Info</h4> --}}

    <div id="{{ strtoupper($district) }}_section" class="table-section">
        <br>
        <div class="card border rounded">
            <div class="card-body">
                <h4 class="mb-3 mb-md-0">{{ strtoupper($district) }} Rice Planting Schedule </h4>

                <div class="table-responsive tab">
                    <table class="table table-bordered datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Rice Variety</th>
                                <th>Date Planted</th>
                        </thead>
                        <tbody>
                            @foreach($farmers as $farmer)
                            <tr class="table-light">
                                <td>{{ $farmer['last_name'] }}</td>
                                <td>{{ $farmer['first_name'] }}</td>
                                <td>
                                    @if(strtoupper($farmer['type_rice_variety']) === 'N/A')
                                        @if(strtoupper($farmer['prefered_variety']) === 'N/A')
                                            N/A
                                        @else
                                            {{ $farmer['prefered_variety'] }}
                                        @endif
                                    @else
                                        {{ $farmer['type_rice_variety'] }}
                                    @endif
                                </td>
                                <td>{{ $farmer['date_planted'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>

<script>
    function showAllSections() {
        // Show all sections
        document.querySelectorAll('[id$="_section"]').forEach(section => {
            section.style.display = 'block';
        });
    }

    function showSection(sectionName) {
        // Hide all sections
        document.querySelectorAll('[id$="_section"]').forEach(section => {
            section.style.display = 'none';
        });

        // Show the selected section
        document.getElementById(sectionName + '_section').style.display = 'block';
    }
</script>

@endsection
