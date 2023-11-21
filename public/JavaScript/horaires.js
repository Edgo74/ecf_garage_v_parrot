
    function toggleHours(index, value) {
        var timeInputs = document.getElementById('time-inputs-' + index);
    
        if (value === 'closed') {
            timeInputs.style.display = 'none';
        } else {
            timeInputs.style.display = 'block';
        }
    }
    