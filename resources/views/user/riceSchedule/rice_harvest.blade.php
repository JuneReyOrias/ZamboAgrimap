@extends('user.user_dashboard')

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

    <div class="d-flex flex-wrap justify-content-center"style="user-select: none;
    -moz-user-select: none;
    -khtml-user-select: none;
    -webkit-user-select: none;
    -o-user-select: none;">
    <button class="btn btn-primary mx-2 my-2" onclick="showAllSections()">View All</button>
        @foreach($harvestSchedule as $district => $farmers)
        <button class="btn btn-primary mx-2 my-2" onclick="showSection('{{ strtoupper($district) }}')">{{ strtoupper($district) }}</button>
        @endforeach
    </div>

    <br>

    @foreach($harvestSchedule as $district => $farmers)
    {{-- <h4 class="mb-3 mb-md-0">{{ $district }} Rice Farmers Info</h4> --}}

    <div id="{{ strtoupper($district) }}_section" class="table-section" style="user-select: none;
    -moz-user-select: none;
    -khtml-user-select: none;
    -webkit-user-select: none;
    -o-user-select: none;">
        <br>
        <div class="card border rounded">
            <div class="card-body">
                <h4 class="mb-3 mb-md-0">{{ strtoupper($district) }} Rice Harvest Schedule </h4>

                <div class="table-responsive tab">
                    <table class="table table-bordered datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Rice Variety</th>
                                <th>Date of Harvest</th>
                            </tr>
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
                                <td>{{ $farmer['date_harvested'] }}</td>
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
