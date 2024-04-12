@extends('user.user_Dashboard')

@section('user')

@extends('layouts._footer-script')
@extends('layouts._head')

<div class="page-content" style="user-select: none;
-moz-user-select: none;
-khtml-user-select: none;
-webkit-user-select: none;
-o-user-select: none;">

    @if (session('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="d-flex flex-wrap justify-content-center" style="user-select: none;
    -moz-user-select: none;
    -khtml-user-select: none;
    -webkit-user-select: none;
    -o-user-select: none;">
        <button class="btn btn-primary mx-2 my-2" onclick="showAllSections()">View All</button>
        @foreach($InbredInfo as $district => $varieties)
        <button class="btn btn-primary mx-2 my-2" onclick="showSection('{{ strtoupper($district) }}')">{{ strtoupper($district) }}</button>
        @endforeach
    </div>

    <br>

    @foreach($InbredInfo as $district => $varieties)
    <div id="{{ strtoupper($district) }}_section" class="table-section">
        <br>
        <div class="card border rounded">
            <div class="card-body">
                <h4 class="mb-3 mb-md-0">{{ strtoupper($district) }} Rice Variety </h4>
                <div class="table-responsive tab">
                    <table class="table table-bordered datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>Rice Variety</th>
                                <th>No. of Farmers</th>
                                <th>Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($varieties as $variety => $data)
                            <tr class="table-light">
                                <td>
                                    @if (strtolower($variety) === 'n/a' || strtolower($variety) === 'na')
                                        {{ isset($data['prefered_variety']) ? $data['prefered_variety'] : 'N/A' }}
                                    @else
                                        {{ $variety }}
                                    @endif
                                </td>
                                <td>{{ $data['count'] }}</td>
                                <td>{{ $data['percentage'] }}%</td>
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
