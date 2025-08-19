<div class="row">
    <div class="col-4">
        <div class="list-group" id="lifestyle-measures-list" role="tablist">
            <a class="list-group-item list-group-item-action active" id="list-sleep-list" data-bs-toggle="list" href="#list-sleep" role="tab" aria-controls="list-sleep">Sleep Assessment</a>
            <a class="list-group-item list-group-item-action" id="list-stress-management-list" data-bs-toggle="list" href="#list-stress-management" role="tab" aria-controls="list-stress-management">Stress Management</a>
            <a class="list-group-item list-group-item-action" id="list-social-connectedness-list" data-bs-toggle="list" href="#list-social-connectedness" role="tab" aria-controls="list-social-connectedness">Social Connectedness</a>
            <a class="list-group-item list-group-item-action" id="list-substance-use-list" data-bs-toggle="list" href="#list-substance-use" role="tab" aria-controls="list-substance-use">Substance Use</a>
        </div>
    </div>
    <div class="col-8">
        <div class="tab-content" id="lifestyle-measures-tabContent">
            <div class="tab-pane fade show active" id="list-sleep" role="tabpanel" aria-labelledby="list-sleep-list">
                @include('patients.otherlmandvs.components.sleep_assessment', ['patient' => $patient])
            </div>
            <div class="tab-pane fade" id="list-stress-management" role="tabpanel" aria-labelledby="list-stress-management-list">
                @include('patients.otherlmandvs.components.stress_management', ['patient' => $patient])
            </div>
            <div class="tab-pane fade" id="list-social-connectedness" role="tabpanel" aria-labelledby="list-social-connectedness-list">
                @include('patients.otherlmandvs.components.social_connectedness', ['patient' => $patient])
            </div>
            <div class="tab-pane fade" id="list-substance-use" role="tabpanel" aria-labelledby="list-substance-use-list">
                @include('patients.otherlmandvs.components.substance_use', ['patient' => $patient])
            </div>
        </div>
    </div>
</div> 