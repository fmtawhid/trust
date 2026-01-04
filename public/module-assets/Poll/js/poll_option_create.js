$(document).ready(function() {
    let maxOptions = 10;

    function numberToWords(number) {
        const words = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten'];
        return words[number - 1] || number;
    }

    function updateLabels() {
        $('#options-wrapper .option-item').each(function(index) {
            $(this).find('label').html('Option ' + numberToWords(index + 1));
            $(this).find('input').attr('placeholder', 'Option ' + numberToWords(index + 1));
        });
    }

    function getOptionCount() {
        return $('#options-wrapper .option-item:visible').length;
    }

    function checkAddButton() {
        let totalOptions = getOptionCount();
        if (totalOptions >= maxOptions) {
            $('#add-option').prop('disabled', true);
            alert('Maximum 10 options allowed.');
        } else {
            $('#add-option').prop('disabled', false);
        }
    }

    $('#add-option').click(function() {
        let totalOptions = getOptionCount();
        if (totalOptions < maxOptions) {
            $('#options-wrapper').append(`
                <div class="option-item mb-3">
                    <label class="col-form-label fw-semibold">Option ${numberToWords(totalOptions + 1)}</label>
                    <div class="input-group">
                        <input type="text" name="options[]" class="form-control" placeholder="Option ${numberToWords(totalOptions + 1)}" required>
                        <button class="btn btn-danger remove-option" type="button">&times;</button>
                    </div>
                </div>
            `);
            checkAddButton();
        }
    });

    $(document).on('click', '.remove-option', function() {
        let totalOptions = getOptionCount();
        if (totalOptions > 2) {
            $(this).closest('.option-item').remove();
            updateLabels();
            checkAddButton();
        }
    });

    checkAddButton();
});