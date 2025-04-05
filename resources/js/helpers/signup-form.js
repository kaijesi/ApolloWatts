// Function to handle checkbox-triggered visibility of fields to allow for household creation
function handleHouseholdJoinCheckbox() {
    const $householdOptions = $('input[name="householdOption"]');
    const $householdJoinFieldsContainer = $('#householdJoinFieldsContainer');
    const $householdCreateFieldsContainer = $('#householdCreateFieldsContainer');

    // Handle whether to show or hide the household creation fields
    const selectedOption = $('input[name="householdOption"]:checked').val();
    if (selectedOption === 'join') {
        $householdJoinFieldsContainer.show();
        $householdCreateFieldsContainer.hide();
    } else {
        $householdJoinFieldsContainer.hide();
        $householdCreateFieldsContainer.show();
    }

    // React to changes of the radio button seelection
    $householdOptions.change(function() {
        const selectedOption = $('input[name="householdOption"]:checked').val();
        if (selectedOption === 'join') {
            $householdJoinFieldsContainer.show();
            $householdCreateFieldsContainer.hide();
        } else {
            $householdJoinFieldsContainer.hide();
            $householdCreateFieldsContainer.show();
        }
    });
}

// Execute when document is loaded
$(document).ready(function() {
    handleHouseholdJoinCheckbox();
})