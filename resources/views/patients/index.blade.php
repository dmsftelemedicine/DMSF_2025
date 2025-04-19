<x-app-layout>
    <!-- Add DataTables CSS in the head section -->
    <x-slot name="styles">
        <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
    </x-slot>

    <div class="container-xl mt-6">
        <div class="row justify-content-end mb-4">
            <div class="col-2">
                <a href="{{ route('patients.create') }}" class="btn btn-primary float-right">
            Create Patient
        </a>
            </div>
        </div>
        <table id="patientsTable" class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th width="15%">First Name</th>
                    <th width="15%">Last Name</th>
                    <th width="60%">Diagnosis</th>
                    <th width="10%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patients as $patient)
                    <tr>
                        <td>{{ $patient->first_name }}</td>
                        <td>{{ $patient->last_name }}</td>
                        <td>{{ $patient->diagnosis }}</td>
                        <td>
                            <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-primary">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Add DataTables JS at the end of the body -->
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#patientsTable').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: false,
                });
                $("#patientsTable_length").hide();
            });
        </script>
    @endpush

</x-app-layout>
