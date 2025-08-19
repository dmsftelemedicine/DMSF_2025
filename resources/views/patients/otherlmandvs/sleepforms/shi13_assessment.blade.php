<div class="card mb-4">
    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="fas fa-list-check me-2"></i>Sleep Hygiene Index (SHI-13)</h4>
        <button type="button" class="btn btn-light btn-sm" onclick="backToSleepInitial()">
            <i class="fas fa-arrow-left me-1"></i>Back to Initial Assessment
        </button>
    </div>
    <div class="card-body">
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Instructions:</strong> Please indicate how frequently you engage in the following behaviors. 
            Use the following scale to choose the most appropriate number for each behavior:
        </div>

        <div class="alert alert-secondary">
            <strong>Scale:</strong><br>
            5 = Always<br>
            4 = Frequently (3-4 times a week)<br>
            3 = Sometimes (1-2 times a week)<br>
            2 = Rarely (1-2 times a month)<br>
            1 = Never
        </div>

        <form id="shi13-form">
            @csrf
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
            <input type="hidden" name="assessment_type" value="shi13">

            <!-- SHI-13 Questions -->
            <div class="row">
                <div class="col-12">
                    <h5 class="text-info mb-3">Assessment Questions</h5>
                </div>
            </div>

            <!-- Question 1 -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">1. I take daytime naps lasting two or more hours</label>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q1" value="5" id="shi_q1_5" required>
                                <label class="form-check-label" for="shi_q1_5">5 - Always</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q1" value="4" id="shi_q1_4" required>
                                <label class="form-check-label" for="shi_q1_4">4 - Frequently</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q1" value="3" id="shi_q1_3" required>
                                <label class="form-check-label" for="shi_q1_3">3 - Sometimes</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q1" value="2" id="shi_q1_2" required>
                                <label class="form-check-label" for="shi_q1_2">2 - Rarely</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q1" value="1" id="shi_q1_1" required>
                                <label class="form-check-label" for="shi_q1_1">1 - Never</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question 2 -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">2. I go to bed at different times from day to day</label>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q2" value="5" id="shi_q2_5" required>
                                <label class="form-check-label" for="shi_q2_5">5 - Always</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q2" value="4" id="shi_q2_4" required>
                                <label class="form-check-label" for="shi_q2_4">4 - Frequently</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q2" value="3" id="shi_q2_3" required>
                                <label class="form-check-label" for="shi_q2_3">3 - Sometimes</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q2" value="2" id="shi_q2_2" required>
                                <label class="form-check-label" for="shi_q2_2">2 - Rarely</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q2" value="1" id="shi_q2_1" required>
                                <label class="form-check-label" for="shi_q2_1">1 - Never</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question 3 -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">3. I get out of bed at different times from day to day</label>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q3" value="5" id="shi_q3_5" required>
                                <label class="form-check-label" for="shi_q3_5">5 - Always</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q3" value="4" id="shi_q3_4" required>
                                <label class="form-check-label" for="shi_q3_4">4 - Frequently</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q3" value="3" id="shi_q3_3" required>
                                <label class="form-check-label" for="shi_q3_3">3 - Sometimes</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q3" value="2" id="shi_q3_2" required>
                                <label class="form-check-label" for="shi_q3_2">2 - Rarely</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q3" value="1" id="shi_q3_1" required>
                                <label class="form-check-label" for="shi_q3_1">1 - Never</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question 4 -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">4. I exercise to the point of sweating within 1 hour of going to bed</label>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q4" value="5" id="shi_q4_5" required>
                                <label class="form-check-label" for="shi_q4_5">5 - Always</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q4" value="4" id="shi_q4_4" required>
                                <label class="form-check-label" for="shi_q4_4">4 - Frequently</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q4" value="3" id="shi_q4_3" required>
                                <label class="form-check-label" for="shi_q4_3">3 - Sometimes</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q4" value="2" id="shi_q4_2" required>
                                <label class="form-check-label" for="shi_q4_2">2 - Rarely</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q4" value="1" id="shi_q4_1" required>
                                <label class="form-check-label" for="shi_q4_1">1 - Never</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question 5 -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">5. I stay in bed longer than I should two or three times a week</label>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q5" value="5" id="shi_q5_5" required>
                                <label class="form-check-label" for="shi_q5_5">5 - Always</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q5" value="4" id="shi_q5_4" required>
                                <label class="form-check-label" for="shi_q5_4">4 - Frequently</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q5" value="3" id="shi_q5_3" required>
                                <label class="form-check-label" for="shi_q5_3">3 - Sometimes</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q5" value="2" id="shi_q5_2" required>
                                <label class="form-check-label" for="shi_q5_2">2 - Rarely</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q5" value="1" id="shi_q5_1" required>
                                <label class="form-check-label" for="shi_q5_1">1 - Never</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question 6 -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">6. I use alcohol, tobacco, or caffeine within 4 hours of going to bed or after going to bed</label>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q6" value="5" id="shi_q6_5" required>
                                <label class="form-check-label" for="shi_q6_5">5 - Always</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q6" value="4" id="shi_q6_4" required>
                                <label class="form-check-label" for="shi_q6_4">4 - Frequently</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q6" value="3" id="shi_q6_3" required>
                                <label class="form-check-label" for="shi_q6_3">3 - Sometimes</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q6" value="2" id="shi_q6_2" required>
                                <label class="form-check-label" for="shi_q6_2">2 - Rarely</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q6" value="1" id="shi_q6_1" required>
                                <label class="form-check-label" for="shi_q6_1">1 - Never</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question 7 -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">7. I do something that may wake me up before bedtime (e.g., play video games, use the internet, or clean)</label>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q7" value="5" id="shi_q7_5" required>
                                <label class="form-check-label" for="shi_q7_5">5 - Always</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q7" value="4" id="shi_q7_4" required>
                                <label class="form-check-label" for="shi_q7_4">4 - Frequently</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q7" value="3" id="shi_q7_3" required>
                                <label class="form-check-label" for="shi_q7_3">3 - Sometimes</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q7" value="2" id="shi_q7_2" required>
                                <label class="form-check-label" for="shi_q7_2">2 - Rarely</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q7" value="1" id="shi_q7_1" required>
                                <label class="form-check-label" for="shi_q7_1">1 - Never</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question 8 -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">8. I go to bed feeling stressed, angry, upset, or nervous</label>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q8" value="5" id="shi_q8_5" required>
                                <label class="form-check-label" for="shi_q8_5">5 - Always</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q8" value="4" id="shi_q8_4" required>
                                <label class="form-check-label" for="shi_q8_4">4 - Frequently</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q8" value="3" id="shi_q8_3" required>
                                <label class="form-check-label" for="shi_q8_3">3 - Sometimes</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q8" value="2" id="shi_q8_2" required>
                                <label class="form-check-label" for="shi_q8_2">2 - Rarely</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q8" value="1" id="shi_q8_1" required>
                                <label class="form-check-label" for="shi_q8_1">1 - Never</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question 9 -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">9. I use my bed for things other than sleeping or sex (e.g., watch TV, read, eat, or study)</label>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q9" value="5" id="shi_q9_5" required>
                                <label class="form-check-label" for="shi_q9_5">5 - Always</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q9" value="4" id="shi_q9_4" required>
                                <label class="form-check-label" for="shi_q9_4">4 - Frequently</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q9" value="3" id="shi_q9_3" required>
                                <label class="form-check-label" for="shi_q9_3">3 - Sometimes</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q9" value="2" id="shi_q9_2" required>
                                <label class="form-check-label" for="shi_q9_2">2 - Rarely</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q9" value="1" id="shi_q9_1" required>
                                <label class="form-check-label" for="shi_q9_1">1 - Never</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question 10 -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">10. I sleep on an uncomfortable bed (e.g., poor mattress or pillow, too much or not enough blankets)</label>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q10" value="5" id="shi_q10_5" required>
                                <label class="form-check-label" for="shi_q10_5">5 - Always</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q10" value="4" id="shi_q10_4" required>
                                <label class="form-check-label" for="shi_q10_4">4 - Frequently</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q10" value="3" id="shi_q10_3" required>
                                <label class="form-check-label" for="shi_q10_3">3 - Sometimes</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q10" value="2" id="shi_q10_2" required>
                                <label class="form-check-label" for="shi_q10_2">2 - Rarely</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q10" value="1" id="shi_q10_1" required>
                                <label class="form-check-label" for="shi_q10_1">1 - Never</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question 11 -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">11. I sleep in an uncomfortable bedroom (e.g., too bright, too stuffy, too hot, too cold, or too noisy)</label>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q11" value="5" id="shi_q11_5" required>
                                <label class="form-check-label" for="shi_q11_5">5 - Always</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q11" value="4" id="shi_q11_4" required>
                                <label class="form-check-label" for="shi_q11_4">4 - Frequently</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q11" value="3" id="shi_q11_3" required>
                                <label class="form-check-label" for="shi_q11_3">3 - Sometimes</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q11" value="2" id="shi_q11_2" required>
                                <label class="form-check-label" for="shi_q11_2">2 - Rarely</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q11" value="1" id="shi_q11_1" required>
                                <label class="form-check-label" for="shi_q11_1">1 - Never</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question 12 -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">12. I work, eat, or watch TV while in bed</label>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q12" value="5" id="shi_q12_5" required>
                                <label class="form-check-label" for="shi_q12_5">5 - Always</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q12" value="4" id="shi_q12_4" required>
                                <label class="form-check-label" for="shi_q12_4">4 - Frequently</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q12" value="3" id="shi_q12_3" required>
                                <label class="form-check-label" for="shi_q12_3">3 - Sometimes</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q12" value="2" id="shi_q12_2" required>
                                <label class="form-check-label" for="shi_q12_2">2 - Rarely</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q12" value="1" id="shi_q12_1" required>
                                <label class="form-check-label" for="shi_q12_1">1 - Never</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question 13 -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">13. I think, plan, or worry when I am in bed</label>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q13" value="5" id="shi_q13_5" required>
                                <label class="form-check-label" for="shi_q13_5">5 - Always</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q13" value="4" id="shi_q13_4" required>
                                <label class="form-check-label" for="shi_q13_4">4 - Frequently</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q13" value="3" id="shi_q13_3" required>
                                <label class="form-check-label" for="shi_q13_3">3 - Sometimes</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q13" value="2" id="shi_q13_2" required>
                                <label class="form-check-label" for="shi_q13_2">2 - Rarely</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shi_q13" value="1" id="shi_q13_1" required>
                                <label class="form-check-label" for="shi_q13_1">1 - Never</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Score Display -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="alert alert-info">
                        <strong>Total Score: <span id="shi13-total-score">0</span></strong>
                        <br>
                        <span id="shi13-interpretation">Please complete all questions to see your score.</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="row">
                <div class="col-12">
                    <button type="button" class="btn btn-info me-2" id="calculate-shi13-btn">
                        <i class="fas fa-calculator me-1"></i>Calculate Score
                    </button>
                    <button type="submit" class="btn btn-success me-2">
                        <i class="fas fa-save me-1"></i>Save Assessment
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        <i class="fas fa-undo me-1"></i>Reset Form
                    </button>
                </div>
            </div>
        </form>

        <!-- Results Area -->
        <div id="shi13-results" class="mt-4" style="display: none;">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>SHI-13 Assessment Results</h5>
                </div>
                <div class="card-body">
                    <div id="shi13-results-content"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Calculate score when any radio button changes
    $('input[type="radio"]').on('change', function() {
        calculateSHI13Score();
    });

    // Calculate button
    $('#calculate-shi13-btn').on('click', function() {
        calculateSHI13Score();
        displaySHI13Results();
    });

    // Form submission
    $('#shi13-form').on('submit', function(e) {
        e.preventDefault();
        submitSHI13Assessment();
    });

    function calculateSHI13Score() {
        let totalScore = 0;
        let questionsAnswered = 0;

        // Calculate total score
        for (let i = 1; i <= 13; i++) {
            const selectedValue = $(`input[name="shi_q${i}"]:checked`).val();
            if (selectedValue !== undefined) {
                totalScore += parseInt(selectedValue);
                questionsAnswered++;
            }
        }

        // Update score display
        $('#shi13-total-score').text(totalScore);

        // Update interpretation
        if (questionsAnswered === 13) {
            let interpretation = '';
            let severity = '';
            let color = '';

            if (totalScore < 26) {
                interpretation = 'Good sleep hygiene';
                severity = 'Good';
                color = 'success';
            } else if (totalScore >= 26 && totalScore <= 34) {
                interpretation = 'Average sleep hygiene';
                severity = 'Average';
                color = 'warning';
            } else if (totalScore >= 35) {
                interpretation = 'Poor sleep hygiene';
                severity = 'Poor';
                color = 'danger';
            }

            $('#shi13-interpretation').html(`
                <strong>Sleep Hygiene: ${severity}</strong><br>
                ${interpretation}
            `).removeClass().addClass(`text-${color}`);
        } else {
            $('#shi13-interpretation').text('Please complete all questions to see your score.').removeClass();
        }

        return { totalScore, questionsAnswered };
    }

    function displaySHI13Results() {
        const { totalScore, questionsAnswered } = calculateSHI13Score();
        
        if (questionsAnswered === 13) {
            let severity = '';
            let recommendations = '';

            if (totalScore < 26) {
                severity = 'Good';
                recommendations = 'Your sleep hygiene practices are excellent. Continue maintaining these good habits for optimal sleep quality.';
            } else if (totalScore >= 26 && totalScore <= 34) {
                severity = 'Average';
                recommendations = 'Your sleep hygiene could be improved. Consider implementing better sleep habits such as maintaining a consistent sleep schedule, avoiding screens before bed, and creating a comfortable sleep environment.';
            } else if (totalScore >= 35) {
                severity = 'Poor';
                recommendations = 'Your sleep hygiene needs significant improvement. Consider consulting with a healthcare provider or sleep specialist. Focus on establishing a regular sleep schedule, creating a relaxing bedtime routine, and optimizing your sleep environment.';
            }

            $('#shi13-results-content').html(`
                <div class="row">
                    <div class="col-md-6">
                        <h6>Assessment Summary</h6>
                        <ul class="list-unstyled">
                            <li><strong>Total Score:</strong> ${totalScore}/65</li>
                            <li><strong>Sleep Hygiene:</strong> ${severity}</li>
                            <li><strong>Assessment Date:</strong> ${new Date().toLocaleDateString()}</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>Recommendations</h6>
                        <p>${recommendations}</p>
                    </div>
                </div>
            `);

            $('#shi13-results').show();
        }
    }

    function submitSHI13Assessment() {
        const { totalScore, questionsAnswered } = calculateSHI13Score();
        
        if (questionsAnswered < 13) {
            alert('Please complete all questions before saving.');
            return;
        }

        const formData = new FormData($('#shi13-form')[0]);
        formData.append('total_score', totalScore);

        $.ajax({
            url: '{{ route("shi13-assessments.store") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    alert('SHI-13 assessment saved successfully!');
                }
            },
            error: function(xhr) {
                alert('Error saving assessment. Please try again.');
            }
        });
    }

    window.loadSHI13Data = function() {
        $.ajax({
            url: '{{ route("shi13-assessments.show", $patient->id) }}',
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success && response.data) {
                    const data = response.data;
                    
                    // Fill form fields with existing data
                    for (let i = 1; i <= 13; i++) {
                        if (data[`shi_q${i}`] !== null) {
                            $(`input[name="shi_q${i}"][value="${data[`shi_q${i}`]}"]`).prop('checked', true);
                        }
                    }
                    
                    // Recalculate and display score
                    calculateSHI13Score();
                    displaySHI13Results();
                }
            },
            error: function(xhr) {
                // No existing data found, which is fine
            }
        });
    }
});
</script> 