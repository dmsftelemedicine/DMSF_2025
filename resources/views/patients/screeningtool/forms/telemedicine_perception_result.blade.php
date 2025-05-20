<div class="card shadow-lg p-4 border-0">
    <!-- Flex container for heading and button -->
    <div class="d-flex justify-content-between align-items-center">
        <h5>Telemedicine Perception Results</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TelemedicinePerceptionModal">
            Add Telemedicine Perception
        </button>
    </div>
    @if($patient->telemedicinePerceptionTests()->exists())
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Date</th>
                <th>Satisfaction</th>
                <th>First Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patient->telemedicinePerceptionTests as $test)
            <tr>
                <td>{{ \Carbon\Carbon::parse($test->created_at)->format('M d, Y') }}</td>
                <td>{{ $test->satisfaction }}</td>
                <td>{{ $test->first_time}}</td>
                <td>
                    <button class="btn btn-info btn-sm view-details" 
                            data-date="{{ \Carbon\Carbon::parse($test->created_at)->format('M d, Y') }}"
                            data-first="{{ $test->first_time }}"
                            data-q1="{{ $test->question_1 }}"
                            data-q2="{{ $test->question_2 }}"
                            data-q3="{{ $test->question_3 }}"
                            data-q4="{{ $test->question_4 }}"
                            data-q5="{{ $test->question_5 }}"
                            data-satisfaction="{{ $test->satisfaction }}"
                            data-bs-toggle="modal" 
                            data-bs-target="#viewTestModal">
                        View Details
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p class="text-muted text-center mt-3">No test results available.</p>
    @endif
    
</div>
<!-- Telemedicine Perception Modal -->
<div class="modal fade" id="TelemedicinePerceptionModal" tabindex="-1" aria-labelledby="TelemedicinePerceptionModalabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TelemedicinePerceptionModalLabel">Telemedicine Perception Test</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
				<!-- Telemedicine Form -->
			    <form id="telemedicine-perception-form">
			        @csrf
			        <div class="mb-3">
			            <label class="form-label">Is this the first time you are using a telemedicine app?</label>
			            <div>
			                <input type="radio" name="first_time" value="yes" required> Yes
			                <input type="radio" name="first_time" value="no"> No
			            </div>
			        </div>
			        @php
			            $questions = [
			                "This method (telemedicine) gives the physician a good understanding of the patient’s health status.",
			                "This method (telemedicine) does not violate the privacy of the patient’s medical information.",
			                "This method (telemedicine) is a good addition to regular care.",
			                "This method (telemedicine) saves time.",
			                "I would use this method (telemedicine) in the future."
			            ];
			        @endphp

			        @foreach ($questions as $index => $question)
			            <div class="mb-3">
			                <label class="form-label">{{ $index + 1 }}. {{ $question }}</label>
			                <div>
			                    @for ($i = 1; $i <= 5; $i++)
			                        <input style="margin-left: 0.5rem;" type="radio" name="question_{{ $index + 1 }}" value="{{ $i }}" required> {{ $i }}
			                        <br/>
			                    @endfor
			                </div>
			            </div>
			        @endforeach
			        <input type="hidden" name="patient_id" id="patient_id" value="{{ $patient->id }}">
			        <!-- Submit Button -->
			        <button type="submit" class="btn btn-primary">Submit</button>
			    </form>
            </div>
        </div>
    </div>
</div>

<!--Telemedicine Perception View Modal -->
<div class="modal fade" id="viewTestModal" tabindex="-1" aria-labelledby="viewTestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewTestModalLabel">Telemedicine Perception Details (<strong><span id="test-date"></span></strong>)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Is this the first time you are using a telemedicine app?: <strong><span id="test-first"></span></strong>  </p>
                <hr>
                <p>This method (telemedicine) gives the physician a good understanding of the patient’s health status.:  <strong><span id="test-q1"></span></strong></p>
                <hr>
                <p>This method (telemedicine) does not violate the privacy of the patient’s medical information.:  <strong><span id="test-q2"></span></strong></p>
                <hr>
                <p>This method (telemedicine) is a good addition to regular care.: <strong><span id="test-q3"></span></strong></p>
                <hr>
                <p>This method (telemedicine) saves time.: <strong><span id="test-q4"></span></strong></p>
                <hr>
                <p>I would use this method (telemedicine) in the future.: <strong><span id="test-q5"></span></strong></p>
                <hr>
                <p>Satisfaction Level: <strong><span id="test-satisfaction"></span></strong></p>
            </div>
        </div>
    </div>
</div>