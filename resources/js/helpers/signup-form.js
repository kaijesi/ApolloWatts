// Function to handle checkbox-triggered visibility of fields to allow for household creation
function handleHouseholdJoinCheckbox() {
    const $householdOptions = $('input[name="householdOption"]');
    const $householdJoinFieldsContainer = $('#householdJoinFieldsContainer');
    const $householdCreateFieldsContainer = $('#householdCreateFieldsContainer');
    const $householdInviteCode = $('#householdInviteCode');

    // Handle whether to show or hide the household creation fields
    function handleVisibility() {
        const selectedOption = $('input[name="householdOption"]:checked').val();
        if (selectedOption === 'join') {
            $householdJoinFieldsContainer.show();
            $householdInviteCode.prop('required', true).prop('disabled', false); 
            $householdCreateFieldsContainer.hide();
            $householdCreateFieldsContainer.find('input').prop('required', false).prop('disabled', true);
        } else {
            $householdJoinFieldsContainer.hide();
            $householdInviteCode.prop('required', false).prop('disabled', true);
            $householdCreateFieldsContainer.show();
            // Solis-realted fields are excluded from being set to required but should still be reenabled
            $householdCreateFieldsContainer.find('input').not('#solis_api_id, #solis_api_key').prop('required', true);
            $householdCreateFieldsContainer.find('input').prop('disabled', false);
        }
    }

    // Initial setup
    handleVisibility();

    // React to changes of the radio button selection
    $householdOptions.change(handleVisibility);
}

// Execute when document is loaded
$(document).ready(function () {
    handleHouseholdJoinCheckbox();
})