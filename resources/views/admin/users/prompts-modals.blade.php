{{-----------------------------------------------Upgrade Prompt Account Plan----------------------------------------------}}
    <!-- upgrade prompt -->
    <div id="accountPlanUpgradeModal" class="modal" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-header">
                <div class="modal-title"> Upgrade Prompt Account Plan:
                    <span>{{ $full_data['user_data']['first_name'] }}
                        {{ $full_data['user_data']['last_name'] }}</span>
                </div>
                <button class="btn-modal-close" onclick="closeModal('accountPlanUpgradeModal')">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form id="upgradePlanForm"  method="POST">
             @csrf
            <div class="modal-body">
                    <div class="input-group">
                        <label class="form-label">Select New Plan</label>
                        <select class="form-control" id="new_plan" name="plan_id">
                            @foreach ($full_data['all_account_type'] as $account_type)
                                <option value="{{ $account_type->id }}">{{ $account_type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                <input type="hidden" class="upgradepromptKey" name="prompt_key" value="upgrade_prompt">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-confirm-info"
                        style="margin-right: 10px; justify-content:center;background-color:white; color:#00b300; border: 1px solid #00b300"
                        onclick="closeModal('accountPlanUpgradeModal')">Close</button>
                    <button class="btn btn-confirm-info"
                        style="margin-right: 10px; justify-content:center;"> Select Plan</button>
                </div>
            </form>
        </div>
    </div>


<!---------------------------------- Account Certificate Prompt Modal ---------------------------------->
<div id="account_certificate_prompt-modal" class="modal" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-header">
            <div class="modal-title">Account Certificate Prompt</div>
            <button class="btn-modal-close" onclick="closeModal('account_certificate_prompt-modal')">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <form method="POST" action="" id="account_certificate_form">
            @csrf
            <div class="modal-body">
                <div class="input-group">
                    <label class="form-label">Amount</label>
                    <input class="form-control" name="amount" id="amount" type="number" min="0" placeholder="Enter Amount">
                </div>
            </div>
            <input type="hidden" class="account_certificate_promptKey" value="account_certificate_prompt">
            <div class="modal-footer">
                    <button type="button" class="btn btn-confirm-info"
                        style="margin-right: 10px; justify-content:center;background-color:white; color:#00b300; border: 1px solid #00b300"
                        onclick="closeModal('account_certificate_prompt-modal')">Close</button>
                    <button class="btn btn-confirm-info"
                        style="margin-right: 10px; justify-content:center;">Save Prompt</button>
                </div>
        </form>
    </div>
</div>

<!---------------------------------- Tax Reference Prompt Modal ------------------------------------>
<div id="tax_reference_prompt-modal" class="modal" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-header">
            <div class="modal-title">Tax Reference Prompt</div>
            <button class="btn-modal-close" onclick="closeModal('tax_reference_prompt-modal')">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <form method="POST" action="" id="tax_reference_form">
            @csrf
            <div class="modal-body">
                <div class="input-group">
                    <label class="form-label">Amount</label>
                    <input class="form-control" id="amount" type="number" min="0" placeholder="Enter Amount">
                </div>
            </div>
            <input type="hidden" class="tax_reference_promptKey" value="tax_reference_prompt">
            <div class="modal-footer">
                    <button type="button" class="btn btn-confirm-info"
                        style="margin-right: 10px; justify-content:center;background-color:white; color:#00b300; border: 1px solid #00b300"
                        onclick="closeModal('tax_reference_prompt-modal')">Close</button>
                    <button class="btn btn-confirm-info"
                        style="margin-right: 10px; justify-content:center;">Save Prompt</button>
                </div>
        </form>
    </div>
</div>

<!---------------------------------- Axillary System Prompt Modal ---------------------------------->
<div id="axillary_system_prompt-modal" class="modal" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-header">
            <div class="modal-title">Axillary System Prompt</div>
            <button class="btn-modal-close" onclick="closeModal('axillary_system_prompt-modal')">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <form method="POST" id="axillary_system_form">
            @csrf
            <div class="modal-body">
                <div class="input-group">
                    <label class="form-label">Amount</label>
                    <input class="form-control" id="amount" type="number" min="0" placeholder="Enter Amount">
                </div>
            </div>
            <input type="hidden" class="axillary_system_promptKey" value="axillary_system_prompt">
            <div class="modal-footer">
                    <button type="button" class="btn btn-confirm-info"
                        style="margin-right: 10px; justify-content:center;background-color:white; color:#00b300; border: 1px solid #00b300"
                        onclick="closeModal('axillary_system_prompt-modal')">Close</button>
                    <button class="btn btn-confirm-info"
                        style="margin-right: 10px; justify-content:center;">Save Prompt</button>
                </div>
        </form>
    </div>
</div>

<!---------------------------------- Trade Limit Prompt Modal ------------------------------------>
<div id="trade_limit_prompt-modal" class="modal" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-header">
            <div class="modal-title">Trade Limit Prompt</div>
            <button class="btn-modal-close" onclick="closeModal('trade_limit_prompt-modal')">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <form method="POST" action="" id="trade_limit_form">
            @csrf
            <div class="modal-body">
                <div class="input-group">
                    <label class="form-label">Amount</label>
                    <input class="form-control" id="amount" type="number" min="0" placeholder="Enter Amount">
                </div>
            </div>
            <input type="hidden"  class="trade_limit_promptKey" value="trade_limit_prompt">
            <div class="modal-footer">
                    <button type="button" class="btn btn-confirm-info"
                        style="margin-right: 10px; justify-content:center;background-color:white; color:#00b300; border: 1px solid #00b300"
                        onclick="closeModal('trade_limit_prompt-modal')">Close</button>
                    <button class="btn btn-confirm-info"
                        style="margin-right: 10px; justify-content:center;">Save Prompt</button>
                </div>
        </form>
    </div>
</div>

<!---------------------------------- Credit Facility Approval Modal ------------------------------------>
<div id="credit_facility_approval-modal" class="modal" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-header">
            <div class="modal-title">Credit Facility Approval</div>
            <button class="btn-modal-close" onclick="closeModal('credit_facility_approval-modal')">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <form method="POST" action="" id="credit_facility_form">
            @csrf
            <div class="modal-body">
                <div class="input-group">
                    <label class="form-label">Amount</label>
                    <input class="form-control" id="amount" type="number" min="0" placeholder="Enter Amount">
                </div>
            </div>
            <input type="hidden"  class="credit_facility_approvalKey" value="credit_facility_approval">
            <div class="modal-footer">
                    <button type="button" class="btn btn-confirm-info"
                        style="margin-right: 10px; justify-content:center;background-color:white; color:#00b300; border: 1px solid #00b300"
                        onclick="closeModal('credit_facility_approval-modal')">Close</button>
                    <button class="btn btn-confirm-info"
                        style="margin-right: 10px; justify-content:center;">Save Prompt</button>
                </div>
        </form>
    </div>
</div>

<!---------------------------------- Loan Facility Approval Modal ------------------------------------>
<div id="loan_facility_approval-modal" class="modal" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-header">
            <div class="modal-title">Loan Facility Approval</div>
            <button class="btn-modal-close" onclick="closeModal('loan_facility_approval-modal')">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <form method="POST" action="" id="loan_facility_form">
            @csrf
            <div class="modal-body">
                <div class="input-group">
                    <label class="form-label">Amount</label>
                    <input class="form-control" id="amount" type="number" min="0" placeholder="Enter Amount">
                </div>
            </div>
            <input type="hidden"  class="loan_facility_approvalKey" value="loan_facility_approval">
            <div class="modal-footer">
                    <button type="button" class="btn btn-confirm-info"
                        style="margin-right: 10px; justify-content:center;background-color:white; color:#00b300; border: 1px solid #00b300"
                        onclick="closeModal('loan_facility_approval-modal')">Close</button>
                    <button class="btn btn-confirm-info"
                        style="margin-right: 10px; justify-content:center;">Save Prompt</button>
                </div>
        </form>
    </div>
</div>
