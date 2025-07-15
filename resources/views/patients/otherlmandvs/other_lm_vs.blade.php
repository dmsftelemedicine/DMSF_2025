<div class="row">
    <div class="col-4">
        <div class="list-group" id="other-lm-vs-list" role="tablist">
            <a class="list-group-item list-group-item-action active" id="list-sleep-list" data-bs-toggle="list" href="#list-sleep" role="tab" aria-controls="list-sleep">Sleep</a>
            <a class="list-group-item list-group-item-action" id="list-stress-management-list" data-bs-toggle="list" href="#list-stress-management" role="tab" aria-controls="list-stress-management">Stress Management</a>
            <a class="list-group-item list-group-item-action" id="list-social-connectedness-list" data-bs-toggle="list" href="#list-social-connectedness" role="tab" aria-controls="list-social-connectedness">Social Connectedness</a>
            <a class="list-group-item list-group-item-action" id="list-substance-use-list" data-bs-toggle="list" href="#list-substance-use" role="tab" aria-controls="list-substance-use">Substance Use</a>
        </div>
    </div>
    <div class="col-8">
        <div class="tab-content" id="other-lm-vs-tabContent">
            <div class="tab-pane fade show active" id="list-sleep" role="tabpanel" aria-labelledby="list-sleep-list">
                @include('patients.otherlmandvs.sleep_tab')
            </div>
            <div class="tab-pane fade" id="list-stress-management" role="tabpanel" aria-labelledby="list-stress-management-list">
                @include('patients.otherlmandvs.stress_management_tab')
            </div>
            <div class="tab-pane fade" id="list-social-connectedness" role="tabpanel" aria-labelledby="list-social-connectedness-list">
                @include('patients.otherlmandvs.social_connectedness_tab')
            </div>
            <div class="tab-pane fade" id="list-substance-use" role="tabpanel" aria-labelledby="list-substance-use-list">
                @include('patients.otherlmandvs.substance_use_tab')
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// You may add tab-specific JS here if needed
</script> 