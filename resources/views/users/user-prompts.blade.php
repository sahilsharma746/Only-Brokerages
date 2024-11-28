  {{-- ------------------------upgrade required modal----------------------------------}}
  <div id="upgradeRequiredModal" class="modal" style="display: none;">
    <div class="modal-dialog d-flex flex-column justify-content-center align-items-center">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class="modal-title">UPGRADE REQUIRED</h3>
                <p class="modal-text">Hello, Your account has exceeded the withdrawal and trading limits for your current plan. Please upgrade <span id ="upgrade_propmpt_plan_name" style="font-weight: bolder; font-size: large; color:#00BCD4;"></span> plan to continue trading without interruptions.</p>
                <input type="hidden" id="upgrade_propmpt_plan_id" name="upgrade_propmpt_plan_id" value="" class="payout">
                <div class="btn-area d-flex g-15 justify-content-center">
                        <button class="btn btn-modal-close upgrade_prompt" type="button">OK</button>
                    </div>
            </div>
        </div>
    </div>
</div>

  {{-- ------------------------identity error  modal----------------------------------}}

<div id="identityErrorModal" class="modal" style="display: none;">
    <div class="modal-dialog d-flex flex-column justify-content-center align-items-center">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class="modal-title"> IDENTITY ERROR</h3>
                <p class="modal-text">
                    Hello, we encountered a withdrawal error due to a mismatch between your account certificate and your identity credentials. Please contact support for assistance.
                    <span style="font-weight: bolder; font-size: large;"></span>
                </p>
                <div class="btn-area d-flex g-15 justify-content-center">
                    <button class="btn btn-modal-close identity_error_prompt" type="button">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- -----------------------------------ACCOUNT ON HOLD MODAL----------------------------- --}}
<div id="accountOnHoldModal" class="modal" style="display: none;">
    <div class="modal-dialog d-flex flex-column justify-content-center align-items-center">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class="modal-title"> ACCOUNT ON HOLD </h3>
                <p class="modal-text">
                    ALERT: We regret to inform you that your account is currently on hold. Please contact support to resolve this issue and continue using your account.
                    <span style="font-weight: bolder; font-size: large;"></span>
                </p>
                <div class="btn-area d-flex g-15 justify-content-center">
                    <button class="btn btn-modal-close account_on_hold_prompt" type="button">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ----------------------------------- KYC VERIFICATION NEEDED MODAL----------------------------- --}}

<div id="kycVerificationModal" class="modal" style="display: none;">
    <div class="modal-dialog d-flex flex-column justify-content-center align-items-center">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class="modal-title">KYC VERIFICATION NEEDED</h3>
                <p class="modal-text">
                    Hello, please complete your KYC verification to be able to withdraw and use other functionalities.
                    <span style="font-weight: bolder; font-size: large;"></span>
                    to continue trading without interruptions.
                </p>
                <div class="btn-area d-flex g-15 justify-content-center">
                    <button class="btn btn-modal-close kyc_verification_prompt" type="button">OK</button>
                    {{-- <button class="btn btn-modal-close kyc_verification_prompt"  href="#account-verification" type="button">OK</button> --}}
                </div>
            </div>
        </div>
    </div>
</div>

<!------------------------------------- Account Certificate Prompt Modal ------------------------------------->
<div id="accountCertificateModal" class="modal" style="display: none;">
<div class="modal-dialog d-flex flex-column justify-content-center align-items-center">
    <div class="modal-content">
        <div class="modal-body text-center">
            <h3 class="modal-title"> ACCOUNT CERTIFICATE REQUIRED</h3>
            <p class="modal-text">
                Withdrawal certificate and broker's permit license code not found on your account. Please contact support for assistance.                </p>
                <input type="hidden" name="account_certificate_prompt_amount" id="account_certificate_prompt_amount" class="account_certificate_prompt_amount" value="">

            <div class="btn-area d-flex g-15 justify-content-center">
                <button class="btn btn-modal-close account_certificate_prompt" type="button">OK</button>
            </div>
        </div>
    </div>
</div>
</div>

{{-- -----------------------------------Tax Reference Prompt Modal ----}}
<div id="taxReferenceModal" class="modal" style="display: none;">
<div class="modal-dialog d-flex flex-column justify-content-center align-items-center">
    <div class="modal-content">
        <div class="modal-body text-center">
            <h3 class="modal-title">TAX REFERENCE CODE  </h3>
            <p class="modal-text">
                Our system has detected an issue with the tax information on this account. Please validate your account's tax reference code to complete the withdrawal. If you need assistance, please contact our support team.               </p>
                 <input type="hidden" name="tax_reference_prompt_amount" id="tax_reference_prompt_amount" class="tax_reference_prompt_amount" value="">
            <div class="btn-area d-flex g-15 justify-content-center">
                <button class="btn btn-modal-close tax_reference_prompt" type="button">OK</button>
            </div>
        </div>
    </div>
</div>
</div>

{{-- ----------------------------------- Axillary System Prompt Modal ----------------------------------- --}}
<div id="axillarySystemModal" class="modal" style="display: none;">
<div class="modal-dialog d-flex flex-column justify-content-center align-items-center">
    <div class="modal-content">
        <div class="modal-body text-center">
            <h3 class="modal-title">AXILLARY PROMPT</h3>
            <p class="modal-text">
            The admin has turned off your Axillary prompt system. Please make a deposit of  <span class="axillary_prompt_amount"style="font-weight: bolder; font-size: large; color:#00BCD4;"></span> to continue.</p>
                <input type="hidden" name="axillary_system_prompt_amount" id="axillary_system_prompt_amount" value="" >
            <div class="btn-area d-flex g-15 justify-content-center">
                <button class="btn btn-modal-close axillary_system_prompt" type="button">OK</button>
            </div>
        </div>
    </div>
</div>
</div>

{{-- ----------------------------------- Trade Limit Prompt Modal ----------------------------------- --}}
<div id="tradeLimitModal" class="modal" style="display: none;">
<div class="modal-dialog d-flex flex-column justify-content-center align-items-center">
    <div class="modal-content">
        <div class="modal-body text-center">
            <h3 class="modal-title">EXCEEDED TRADE LIMIT</h3>
            <p class="modal-text">
                Your account has surpassed the allowed trading limit. Please upgrade your account to resume trading. If you need assistance, contact our support team.
            </p>
             <input type="hidden" name="trade_limit_prompt_amount" id="trade_limit_prompt_amount" value="" class="trade_limit_prompt_amount">
            <div class="btn-area d-flex g-15 justify-content-center">
                <button class="btn btn-modal-close trade_limit_prompt" type="button">OK</button>
            </div>
        </div>
    </div>
</div>
</div>

{{-- ----------------------------------- Credit Facility Approval Modal ----------------------------------- --}}
<div id="creditFacilityApprovalModal" class="modal" style="display: none;">
<div class="modal-dialog d-flex flex-column justify-content-center align-items-center">
    <div class="modal-content">
        <div class="modal-body text-center">
            <h3 class="modal-title">CREDIT FACILITY APPROVAL </h3>
            <p class="modal-text">
                Congratulations! Your account has been approved for a loan facility of $<span id ="credit_facility_amount" style="font-weight: bolder; font-size: large; color:#00BCD4;"></span>. To add this amount to your total balance, please contact support for further assistance.
            </p>
             <input type="hidden" name="credit_facility_approval_amount" id="credit_facility_approval_amount" class="credit_facility_approval_amount" value="">

            <div class="btn-area d-flex g-15 justify-content-center">
                <button class="btn btn-modal-close credit_facility_approval" type="button">OK</button>
            </div>
        </div>
    </div>
</div>
</div>

{{-- ----------------------------------- Loan Facility Approval Modal ----------------------------------- --}}
<div id="loanFacilityApprovalModal" class="modal" style="display: none;">
<div class="modal-dialog d-flex flex-column justify-content-center align-items-center">
    <div class="modal-content">
        <div class="modal-body text-center">
            <h3 class="modal-title">LOAN FACILITY APPROVAL  </h3>
            <p class="modal-text">
                Congratulations! Your account has been approved for a loan facility of $<span id ="loan_facility_amount" style="font-weight: bolder; font-size: large; color:#00BCD4;">$</span>. To add this amount to your total balance, please contact support for further assistance.
            </p>
             <input type="hidden" name="loan_facility_approval_amount" id="loan_facility_approval_amount" class="loan_facility_approval_amount" value="">

            <div class="btn-area d-flex g-15 justify-content-center">
                <button class="btn btn-modal-close loan_facility_approval" type="button">OK</button>
            </div>
        </div>
    </div>
</div>
</div>


