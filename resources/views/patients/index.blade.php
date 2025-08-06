<x-app-layout>
    <!-- Add DataTables CSS -->
    <x-slot name="styles">
        <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
    </x-slot>

    <style>
        .bg-falls {
            background: url('{{ asset('images/hagimit-bg.jpg') }}');
            background-size: cover;
            min-height: 100vh;
            position: relative;
        }

        .bg-overlay {
            position: absolute;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5); /* Dark overlay */
            z-index: 1;
        }

        .content-wrapper {
            position: relative;
            z-index: 2;
            background-color: rgba(255, 255, 255, 0.9); /* Light semi-transparent container */
            border-radius: 10px;
            padding: 2rem;
        }

        .btn-color {
            background-color: #7CAD3E;
            color: white;
        }
    </style>

    <div class="bg-falls pt-20">
        <div class="bg-overlay"></div>

        <div class="container-xl content-wrapper">
            <div class="row justify-content-end mb-4">
                <div class="col-2">
                    <a href="{{ route('patients.create') }}"
                       class="btn bg-[#7CAD3E] hover:bg-[#1A5D77] text-white border-none px-3 py-2 rounded-full mt-2 text-base w-full transition-colors duration-300">
                        Create Patient
                    </a>
                </div>
            </div>

            <table id="patientsTable" class="table table-bordered table-hover bg-white text-dark">
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
                                <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-color">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

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
