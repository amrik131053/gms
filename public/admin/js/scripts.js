function searchSubjectsForExam() {
    showLoader();
    const semID = document.getElementById('semID').value;
    const Group = document.getElementById('Group').value;
    const typeForm = document.getElementById('typeForm').value;
    const eID = document.getElementById('eID').value;
   
    if(!semID)
    {
        showErrorMessage('Please select an semester.');
        hideLoader();
        return; 
        
    }
    if(!Group)
    {
        showErrorMessage('Please select an Group.');
        hideLoader();
        return; 
    }

    fetch('/searchExamForms', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ semid: semID, groupid: Group,typeForm:typeForm,eID:eID})
    })
    .then(response => {
        console.log('Raw response:', response);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        hideLoader();
        return response.text().then(text => {
            return text ? JSON.parse(text) : {};
        });
        
    })
    .then(data => {
        hideLoader();
       
        const { examSubjectNormalData, subjectsOpenElectiveData } = data;
        const tableContainer = document.getElementById('subjectsTableDivForm');
        tableContainer.innerHTML = '';
        // console.log(subjectsOpenElectiveData);
       
        if (( examSubjectNormalData.length > 0)) {
            
            // Create table
            let table = document.createElement('table');
            table.classList.add('table', 'table-bordered');

            // Create table header
            let headerRow = document.createElement('tr');
            headerRow.innerHTML = `
                <th>Subject Code</th>
                <th>Subject Name</th>
                <th>Action</th>
            `;
            table.appendChild(headerRow);

            // Helper function to add subjects to table
            function addSubjectsToTable(subjects) {
                subjects.forEach(subject => {
                    let row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${subject.SubjectCode}</td>
                        <td>${subject.SubjectName}</td>
                      
                        <td>
                            <select class="form-control form-select subject-dropdown" data-subject-code="${subject.SubjectCode}" 
                                    data-subject-name="${subject.SubjectName}" 
                                    data-academic-type="${subject.SubjectType}">
                                    <option value="Y">Y</option>
                                <option value="N">N</option>
                            </select>
                        </td>
                    `;
                    table.appendChild(row);
                });
            }
            if (examSubjectNormalData.length > 0) {
                addSubjectsToTable(examSubjectNormalData);
            }
            tableContainer.appendChild(table);
            if (subjectsOpenElectiveData && subjectsOpenElectiveData.length > 0) {
                let dropdownContainer = document.createElement('div');
                dropdownContainer.classList.add('dropdown-container', 'mt-5');
            
                let dropdownLabel = document.createElement('label');
                dropdownLabel.textContent = 'Select Open Elective:';
                dropdownLabel.setAttribute('for', 'electiveDropdown');
                dropdownContainer.appendChild(dropdownLabel);
            
                let selectDropdown = document.createElement('select');
                selectDropdown.id = 'electiveDropdown';
                selectDropdown.classList.add('form-select');
            
                let staticOption = document.createElement('option');
                staticOption.value = JSON.stringify({
                    SubjectType: 'O',
                    SubjectName: 'not applicable',
                    SubjectCode: 'not applicable',
                    Type: 'O'
                });
                staticOption.textContent = 'Not Applicable';
                selectDropdown.appendChild(staticOption);
            
                if (subjectsOpenElectiveData.length > 0) {
                    subjectsOpenElectiveData.forEach(elective => {
                        let option = document.createElement('option');
                        option.value = JSON.stringify({
                            SubjectType: elective.SubjectType,
                            SubjectName: elective.SubjectName,
                            SubjectCode: elective.SubjectCode,
                            Type: elective.Type || 'O'
                        });
                        option.textContent = `${elective.SubjectName} (${elective.SubjectCode}) - ${elective.Type || 'O'}`;
                        selectDropdown.appendChild(option);
                    });
                }
            
                dropdownContainer.appendChild(selectDropdown);
                tableContainer.appendChild(dropdownContainer);
            }
            

            let submitButton = document.createElement('button');
            submitButton.classList.add('btn', 'btn-primary', 'mt-3');
            submitButton.textContent = 'Submit';
            submitButton.addEventListener('click', examFormSubmit);
            tableContainer.appendChild(submitButton);
        } else {
            tableContainer.innerHTML = '<p>No subjects found for the selected exam group.</p>';
        }
    })
    .catch(error => {
        hideLoader();
        showErrorMessage('An error occurred while fetching subjects. Please try again later.');
    });
}

function examFormSubmit() {
    showLoader();

    // Gather normal subjects data
    const subjectsData = Array.from(document.querySelectorAll('.subject-dropdown')).map(select => ({
        SubjectType: select.getAttribute('data-academic-type'),
        SubjectCode: select.getAttribute('data-subject-code'),
        SubjectName: select.getAttribute('data-subject-name'),
        select: select.value
    }));

    // Handle open elective
    const electiveDropdown = document.getElementById('electiveDropdown');
    let selectedElective;

    if (!electiveDropdown || !electiveDropdown.value) {
        // Use "Not Applicable" if no dropdown or no value is selected
        selectedElective = {
            SubjectType: 'O',
            SubjectCode: 'not applicable',
            SubjectName: 'not applicable',
            Type: 'O',
            select: 'Y'
        };
    } else {
        // Parse the selected elective value
        selectedElective = JSON.parse(electiveDropdown.value);
    }

    // Combine subjects and elective into the final array
    const subjects = [
        ...subjectsData,
        {
            SubjectType: selectedElective.Type || 'O',
            SubjectCode: selectedElective.SubjectCode,
            SubjectName: selectedElective.SubjectName,
            select: selectedElective.select || 'Y'
        }
    ];

    const examTypeValue = document.getElementById('examType').value;
    const examTypeProcessed = examTypeValue.includes('/') ? examTypeValue.split('/')[0] : examTypeValue;
    
    const basicInfo = [{
        SemId: document.getElementById('semID').value,
        Examination: document.getElementById('examination').value,
        Type: examTypeProcessed,
        Group: document.getElementById('Group').value
    }];

    const eID = document.getElementById('eID').value;

    // Submit the form
    fetch('/submitSubjects', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ basicInfo, subjects,eID }),
    })
    .then(response => response.text().then(text => {
        hideLoader();
        try {
            return JSON.parse(text);
        } catch {
            throw new Error('Received non-JSON response from server.');
        }
    }))
    .then(data => {
        hideLoader();
        console.log(data);
        handleResponse(data);
    })
    .catch(error => {
        hideLoader();
        showErrorMessage('Please try again later.');
    });
}

// function examFormSubmit() {
//     showLoader();
//     const subjectsData = Array.from(document.querySelectorAll('.subject-dropdown')).map(select => ({
//         AcademicType: select.getAttribute('data-academic-type'),
//         SubjectCode: select.getAttribute('data-subject-code'),
//         SubjectName: select.getAttribute('data-subject-name'),
//         select: select.value
//     }));

   
//     if(!document.getElementById('electiveDropdown').value)
//     {
//         showErrorMessage('Please select an open elective.');
//         hideLoader();
//         return; 
//     }
//     const selectedElective = JSON.parse(document.getElementById('electiveDropdown').value) || {};
//     const subjects = [...subjectsData, {
//         AcademicType: selectedElective.Type,
//         SubjectCode: selectedElective.SubjectCode,
//         SubjectName: selectedElective.SubjectName,
//         select: 'Y'
//     }];

//     const basicInfo = [{
//         SemId: document.getElementById('semID').value,
//         Examination: document.getElementById('examination').value,
//         Type: document.getElementById('examType').value,
//         Group: document.getElementById('Group').value
//     }];

//     const eID = document.getElementById('eID').value;

//     fetch('/submitSubjects', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//         },
//         body: JSON.stringify({ basicInfo, subjects }),
//     })
//     .then(response => response.text().then(text => {
//         hideLoader();
//         try {
//             return JSON.parse(text); 
//         } catch {
//             // console.error('Response is not valid JSON:', text);
//             throw new Error('Received non-JSON response from server.');
//         }
//     }))
//     .then(data => {
//         hideLoader();
//         // console.log('Submit response:', data);
//         handleResponse(data);
//     })
//     .catch(error => {
//         hideLoader();
//         // console.error('Error submitting subjects:', error);
//         showErrorMessage('Please try again later.');
//     });
// }

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

function handleResponse(data) {
    if (data === 3) {
        showSuccessMessage('Exam Form submitted successfully!');
    } else if (data === 2) {
        showErrorMessage('Previous Exam Form Pending.');
    } else if (data === 1) {
        showErrorMessage('Exam Form Already Submitted.');
    }
}

// Function to show the toast
function showErrorMessage(message) {
    const toastEl = document.getElementById('tablerToastWarning');
    const toastBody = toastEl.querySelector('.toast-body');
    toastBody.textContent = message;
    const toast = new bootstrap.Toast(toastEl);
    
    toast.show();
    scrollToTop();
}
function showSuccessMessage(message) {
    const toastEl = document.getElementById('tablerToastSuccess');
    const toastBody = toastEl.querySelector('.toast-body');
    toastBody.textContent = message;
    const toast = new bootstrap.Toast(toastEl);
    scrollToTop();
    toast.show();
    setTimeout(function() {
        location.reload();
    }, 2000); // 2000ms = 2 seconds

}
// function showSuccessMessage(message) {
//     const alertContainer = document.getElementById('alertContainer');
//     alertContainer.innerHTML = `<div class="alert alert-success">${message}</div>`;
//     scrollToTop();
// }

// function showErrorMessage(message) {
//     const alertContainer = document.getElementById('alertContainer');
//     alertContainer.innerHTML = `<div class="alert alert-danger">${message}</div>`;
//     scrollToTop();
// }


function loadSubjects(semID) {
    showLoader();
    const spotsdrop = document.getElementById('subID');
            spotsdrop.innerHTML = '<option value="">Choose Subject</option>';
    fetch('/fetch-subject', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ semid: semID })
    })
    .then(response => response.json())
    .then(spots => {
        hideLoader();
                        spots.forEach(spot => {
                            let option = document.createElement('option');
                            option.value = spot.SubjectCode;
                            option.text = spot.SubjectName+'('+spot.SubjectCode+')';
                            spotsdrop.add(option);
                        });
                    })
    .catch(error => console.error('Error:', error));
}
function loadBusspot(spotId) {
    showLoader();
    const spotsdrop = document.getElementById('spotid');
            spotsdrop.innerHTML = '<option value="">Choose Spot</option>';
    fetch('/fetch-spots', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ spot_id: spotId })
    })
    .then(response => response.json())
    .then(spots => {
        hideLoader();
                        spots.forEach(spot => {
                            let option = document.createElement('option');
                            option.value = spot.StopageID;
                            option.text = spot.Spot;
                            spotsdrop.add(option);
                        });
                    })
    .catch(error => console.error('Error:', error));
}
function showLoader() {
    document.getElementById('fullScreenLoader').style.display = 'flex';
}

function hideLoader() {
    document.getElementById('fullScreenLoader').style.display = 'none';
}



 function checkBoxIDcard() {
    const checkbox = document.getElementById('smartCardCheckbox');
    const label = document.getElementById('checkboxLabel');
    const text = document.getElementById('confirmationText');
    
    
    document.getElementById('applyButton')?.addEventListener('click', function (event) {
        if (!checkbox.checked) {
            // alert('Please check the box to confirm all details are correct before applying.');
            showErrorMessage('Please check the box to confirm all details are correct before applying.');
            event.preventDefault(); // Prevent form submission
            checkbox.style.outline = '2px solid red';
            label.style.color = 'red';
            text.style.color = 'red';
        } else {
            checkbox.style.outline = '2px solid green';
            label.style.color = 'green';
            text.style.color = 'green';
        }
    });
    checkbox.addEventListener('change', function () {
        if (checkbox.checked) {
            checkbox.style.outline = '2px solid green';
            label.style.color = 'green';
            text.style.color = 'green';
        } else {
            checkbox.style.outline = '2px solid red';
            label.style.color = 'red';
            text.style.color = 'red';
        }
    });
}


function viewBusPass(id)
{
showLoader();
fetch('/fetch-buss-pass', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify({ ID: id })
})
.then(response => {
    if (!response.ok) {
        throw new Error('Network response was not ok: ' + response.statusText);
    }
    return response.json();
})
.then(data => {
    console.log(data);
    hideLoader();
    document.getElementById('sessionBusPass').innerHTML = data[0]['session'] || 'N/A';
    document.getElementById('routeBusPass').innerHTML = data[0]['route'] || 'N/A';
    document.getElementById('spotBusPass').innerHTML = data[0]['spot'] || 'N/A';
    document.getElementById('applyDateBusPass').innerHTML = data[0]['SubmitDate'] || 'N/A';

    var reasonP = '';
    if (data[0]['p_status'] == 2) {
        reasonP = data[0]['itreason'];
    } else if (data[0]['itreason'] == 3) {
        reasonP = data[0]['acreason'];
    } else {
        reasonP = '';
    }

    let busPassData = [
        { 'p_status': data[0]['p_status'], 'reject_reason': reasonP },
    ];
    updateProgressStatus(busPassData);
})
.catch(error => {
    console.error('Error:', error);
    hideLoader();
});
}


function viewExamForm(id) {
    showLoader();
    fetch('/fetch-exam-form', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ ID: id })
    })
    .then(response => response.json())
    .then(data => {
        hideLoader();
        const tableBody = document.getElementById('subjectsTableDiv');
        tableBody.innerHTML = '';

        if (data.length > 0) {
            data.forEach(subject => {
                let row = document.createElement('tr');
                row.innerHTML = `
                    <td>${subject.SubjectCode}</td>
                    <td>${subject.SubjectName}</td>
                    <td>${subject.ExternalExam}</td>
                `;
                tableBody.appendChild(row);
            });
        } else {
            tableBody.innerHTML = '<tr><td colspan="3" class="text-center text-danger">No subjects available</td></tr>';
        }

        // Show the modal
        let examModal = new bootstrap.Modal(document.getElementById('examModal'));
        examModal.show();
    })
    .catch(error => {
        console.error('Error:', error);
        hideLoader(); 
    });
}
function viewNoDuesModal(id) {
    showLoader();
    fetch('/fetch-no-dues-record', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ ID: id })
    })
    .then(response => response.json())
    .then(data => {
        hideLoader();
        const tableBody = document.getElementById('viewNoDuesTable');
        tableBody.innerHTML = '';
        console.log(data);

        if (data.length > 0) {
            const departments = ['Library', 'Account', 'Registration'];

            departments.forEach(dept => {
                const status = parseInt(data[0][dept]); // 1, 0, or -1
                const verifiedBy = data[0][`${dept}VerifiedName`] || '--';
                const verifiedDateRaw = data[0][`${dept}VerifiedDate`];
                const verifiedDate = verifiedDateRaw 
                    ? new Date(verifiedDateRaw).toLocaleString('en-GB') 
                    : '--';

                const rejectedBy = data[0][`${dept}RejectedName`] || null;
                const rejectedDateRaw = data[0][`${dept}RejectDate`];
                const rejectedDate = rejectedDateRaw 
                    ? new Date(rejectedDateRaw).toLocaleString('en-GB') 
                    : '--';
                const rejectReason = data[0][`${dept}RejectReason`] || '--';

                let statusBadge = '';
                let byWhom = '--';
                let date = '--';
                let reason = '';

                if (status === -1) {
                    statusBadge = `<span class="badge bg-danger text-white">Rejected</span>`;
                    byWhom = rejectedBy || '--';
                    date = rejectedDate;
                    reason = rejectReason;
                } else if (status === 1) {
                    statusBadge = `<span class="badge bg-success text-white">Verified</span>`;
                    byWhom = verifiedBy;
                    date = verifiedDate;
                } else {
                    statusBadge = `<span class="badge bg-warning text-dark">Pending</span>`;
                }

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${dept}</td>
                    <td>${byWhom}</td>
                    <td>${date}</td>
                    <td>${statusBadge}<br><b class='text-danger'>${reason}</b></td>
               
                `;
                tableBody.appendChild(row);
            });
        } else {
            tableBody.innerHTML = '<tr><td colspan="5" class="text-center text-danger">No records found</td></tr>';
        }

        // Show the modal
        let examModal = new bootstrap.Modal(document.getElementById('noDuesModal'));
        examModal.show();
    })
    .catch(error => {
        console.error('Error:', error);
        hideLoader();
    });
}

// function viewNoDuesModal(id) {
//     showLoader();
//     fetch('/fetch-no-dues-record', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//         },
//         body: JSON.stringify({ ID: id })
//     })
//     .then(response => response.json())
//     .then(data => {
//         hideLoader();
//         const tableBody = document.getElementById('viewNoDuesTable');
//         tableBody.innerHTML = '';
//         console.log(data);

//         if (data.length > 0) {
//             const departments = ['Library', 'Account', 'Registration'];

//             departments.forEach(dept => {
//                 const verified = data[0][dept];
//                 const verifiedBy = data[0][`${dept}VerifiedName`] || '--';
//                 const verifiedDateRaw = data[0][`${dept}VerifiedDate`];
//                 const verifiedDate = verifiedDateRaw 
//                     ? new Date(verifiedDateRaw).toLocaleString('en-GB') 
//                     : '--';

//                 const rejectedBy = data[0][`${dept}RejectedBy`] || null;
//                 const rejectedDateRaw = data[0][`${dept}RejectDate`];
//                 const rejectedDate = rejectedDateRaw 
//                     ? new Date(rejectedDateRaw).toLocaleString('en-GB') 
//                     : '--';
//                 const rejectReason = data[0][`${dept}RejectReason`] || '--';

//                 let statusBadge = '';
//                 if (rejectedBy) {
//                     statusBadge = `<span class="badge bg-danger" style="color:white">Rejected</span>`;
//                 } else if (verified) {
//                     statusBadge = `<span class="badge bg-success" style="color:white">Verified</span>`;
//                 } else {
//                     statusBadge = `<span class="badge bg-warning" style="color:white">Pending</span>`;
//                 }

//                 const row = document.createElement('tr');
//                 row.innerHTML = `
//                     <td>${dept}</td>
//                     <td>${verifiedBy}</td>
//                     <td>${rejectedBy ? rejectedDate : verifiedDate}</td>
//                     <td>${statusBadge}<br><small class='text-danger'>${rejectedBy ? rejectReason : ''}</small></td>
                    
//                 `;
//                 tableBody.appendChild(row);
//             });
//         } else {
//             tableBody.innerHTML = '<tr><td colspan="5" class="text-center text-danger">No records found</td></tr>';
//         }

//         // Show the modal
//         let examModal = new bootstrap.Modal(document.getElementById('noDuesModal'));
//         examModal.show();
//     })
//     .catch(error => {
//         console.error('Error:', error);
//         hideLoader();
//     });
// }


// function viewExamForm(id) {
//     showLoader();
//     fetch('/fetch-exam-form', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//         },
//         body: JSON.stringify({ ID: id })
//     })
//     .then(response => response.json())
//     .then(data => {
//         // console.log(data);
//         hideLoader();
//         const examSubjectNormalData = data;
//         const tableContainer = document.getElementById('subjectsTableDiv');
//         tableContainer.innerHTML = '';  
//         let table = document.createElement('table');
//         table.classList.add('table', 'table-bordered', 'table-striped', 'table-hover', 'card-table'); 
//         let headerRow = document.createElement('tr');
//         headerRow.innerHTML = `
//             <th>Subject Code</th>
//             <th>Subject Name</th>
//             <th>Y/N</th>
//         `;
//         table.appendChild(headerRow);
//         function addSubjectsToTable(subjects) {
//             subjects.forEach(subject => {
//                 let row = document.createElement('tr');
//                 row.innerHTML = `
//                     <td>${subject.SubjectCode}</td>
//                     <td>${subject.SubjectName}</td>
//                     <td>${subject.ExternalExam}</td>
//                 `;
//                 table.appendChild(row);
//             });
//         }
//         if (examSubjectNormalData.length > 0) {
//             addSubjectsToTable(examSubjectNormalData);
//         }

//         tableContainer.appendChild(table);
//     })
//     .catch(error => {
//         console.error('Error:', error);
//         hideLoader(); 
//     });
// }



function updateProgressStatus(data) {
    
    let pStatus = data[0]['p_status'];
    let rejectReason = data[0]['reject_reason'] || ''; 
    var statusMessage = '';
    let steps = document.getElementsByClassName('step');
    for (let i = 0; i < steps.length; i++) {
        steps[i].classList.remove('active');
        steps[i].classList.remove('completed');
        steps[i].classList.remove('disabled');  // Reset disabled state
        steps[i].classList.remove('rejected');  // Reset rejected state
        steps[i].classList.add('hidden');  // Hide all initially
    }
    document.getElementById('rejectReason').classList.add('hidden'); // Hide reject reason initially
    document.getElementById('step-1').classList.remove('hidden'); // Pending
    document.getElementById('step-3').classList.remove('hidden'); // Forward to Account
    document.getElementById('step-5').classList.remove('hidden'); // Ready to Print
    document.getElementById('step-6').classList.remove('hidden'); // Printed
    if (pStatus == '1') {
        statusMessage = "Pending";
        document.getElementById('step-1').classList.add('active');
    }
    else if (pStatus == '2') {

        statusMessage = "Rejected By IT";
        document.getElementById('step-1').classList.add('completed'); 
        document.getElementById('step-2').classList.remove('hidden'); 
        document.getElementById('step-2').classList.add('active');
        document.getElementById('step-2').classList.add('rejected'); 
        disableUpcomingSteps(2); 
        showRejectReason(rejectReason); 
    }
    else if (pStatus == '3') {
        statusMessage = "Forward to Account";
        document.getElementById('step-1').classList.add('completed');
        document.getElementById('step-3').classList.add('active');
    }
    else if (pStatus == '4') {
        statusMessage = "Rejected By Account";
        document.getElementById('step-1').classList.add('completed');
        document.getElementById('step-3').classList.add('completed'); 
        document.getElementById('step-4').classList.remove('hidden'); 
        document.getElementById('step-4').classList.add('active');
        document.getElementById('step-4').classList.add('rejected'); 
        disableUpcomingSteps(4); 
        showRejectReason(rejectReason); 
    }
    else if (pStatus == '5') {
        statusMessage = "Ready to Print";
        document.getElementById('step-1').classList.add('completed');
        document.getElementById('step-3').classList.add('completed');
        document.getElementById('step-5').classList.add('active');
    }
    else {
        statusMessage = "Printed";
        document.getElementById('step-1').classList.add('completed');
        document.getElementById('step-3').classList.add('completed');
        document.getElementById('step-5').classList.add('completed');
        document.getElementById('step-6').classList.add('active');
    }

    document.getElementById('pstatusBusPass').innerHTML = statusMessage;
}

function disableUpcomingSteps(step) {
    let steps = document.getElementsByClassName('step');
    for (let i = step; i < steps.length; i++) {
        steps[i].classList.add('disabled'); 
    }
}

function showRejectReason(reason) {
    if (reason) {
        let rejectReasonElem = document.getElementById('rejectReason');
        rejectReasonElem.innerHTML = "Reason: " + reason;
        rejectReasonElem.classList.remove('hidden'); // Show rejection reason
    }
}


function submitProfile() {
    showLoader();

    var gender = document.getElementById('gender').value;
    var email = document.getElementById('email').value;
    var mobile = document.getElementById('mobile').value;
    var abcid = document.getElementById('abcid').value;

    fetch('/submitProfileData', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            gender: gender,
            email: email,
            mobile: mobile,
            abcid: abcid,
            bloodgroup:bloodgroup,
            address:address
        })
    })
    .then(response => {
        // Debug the actual response from the server
        console.log("Raw response from server:", response);

        // Check if the response type is JSON, otherwise handle non-JSON gracefully
        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
            return response.json();
        } else {
            throw new Error('Server returned a non-JSON response');
        }
    })
    .then(data => {
        hideLoader();
        console.log('Submit response:', data);
        handleResponseProfile(data);
    })
    .catch(error => {
        hideLoader();
        console.error('Error submitting profile:', error);
        // Optionally, show an error message to the user
    });
}


function handleResponseProfile(data) {
    // if (data === 3) {
    //     showSuccessMessage('Exam Form submitted successfully!');
    // } else if (data === 2) {
    //     showErrorMessage('Previous Exam Form Pending.');
    // } else if (data === 1) {
    //     showErrorMessage('Exam Form Already Submitted.');
    // }
}
// function trackComplaint() {
//     showLoader();
//     const complaint_no = document.getElementById('complaint_no').value;

//     if (!complaint_no) {
//         showErrorMessage('Please enter a valid complaint number.');
//         hideLoader();
//         return;
//     }

//     fetch('/complaintTrack', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
//         },
//         body: JSON.stringify({ complaintno: complaint_no }),
//     })
//     .then(response => {
//         if (!response.ok) {
//             throw new Error(`HTTP error! status: ${response.status}`);
//         }
//         hideLoader();
//         return response.json(); // Parse the JSON response
//     })
//     .then(data => {
//         hideLoader();
//         const trackingData = data['trackingData'];
//         if (!trackingData || trackingData.length === 0) {
//             showErrorMessage('No tracking data found for this complaint.');
//             return;
//         }

//         const tableContainer = document.getElementById('trackedApplicationShow');
//         let stepsHTML = `
//             <li class="step-item active">
//                 <div class="h4 m-0">You</div>
//                 <div class="text-success">${trackingData[0]['Complaint']}</div>
//                 <div class="text-primary"><strong>Subject:</strong> ${trackingData[0]['Comments']}</div>
//                 <div class="text-secondary">${trackingData[0]['ComplaintDate']}</div>
//             </li>
//             <li class="step-item">
//                 <div class="h4 m-0">${trackingData[0]['ComplaineeName']} (${trackingData[0]['ComplaineeIDNo']})</div>
//                 <div class="text-success">${trackingData[0]['ForwardToRemarks']}</div>
//                 <div class="text-secondary">${trackingData[0]['ForwardDate']}</div>
//             </li>
//         `;

//         trackingData.forEach((step, index) => {
//             const isLastStep = index === trackingData.length - 1;
//             const stepClass = step['Action'] === 'Forwarded' ? 'active' : isLastStep ? 'completed' : 'pending';

//             stepsHTML += `
//                 <li class="step-item ${stepClass}">
//                     <div class="h4 m-0">${stepClass}${step['ForwardToName']} - ${step['ForwardToDesignation']} (${step['ForwardToIDNo']}) | ${step['ForwardToDep'] || 'N/A'}</div>
                   
//                     <div class="text-secondary">${step['ForwardToRemarks'] || 'N/A'}</div>

//                     <div class="text-secondary">${step['ForwardDate'] || 'N/A'}</div>
//                 </li>
//             `;
//         });

//         tableContainer.innerHTML = `
//             <div class="col-lg-12">
//                 <div class="card">
//                     <div class="card-body">
//                         <h3 class="card-title">Application No: ${trackingData[0]['ComplaintNo']} - Total Steps: ${trackingData.length}</h3>
//                         <ul class="steps steps-vertical">
//                             ${stepsHTML}
//                         </ul>
//                     </div>
//                 </div>
//             </div>
//         `;
//     })
//     .catch(error => {
//         hideLoader();
//         console.error('Error:', error);
//         showErrorMessage('An error occurred while fetching complaint tracking data. Please try again later.');
//     });
// }
function formatDateTime(dateTime) {
    if (!dateTime) return 'N/A'; // Handle null or undefined
    const date = new Date(dateTime);
    return date.toLocaleString('en-IN', {
        timeZone: 'Asia/Kolkata', // Convert to IST
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        hour12: true // Use 12-hour format
    });
}

function trackComplaint() {
    showLoader();
    const complaint_no = document.getElementById('complaint_no').value;

    if (!complaint_no) {
        showErrorMessage('Please enter a valid complaint number.');
        hideLoader();
        return;
    }

    fetch('/complaintTrack', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({ complaintno: complaint_no }),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        hideLoader();
        const trackingData = data['trackingData'];
// console.log(data);
        if (!trackingData) {
            showErrorMessage('No tracking data found for this complaint.');
            return;
        }
        
        const normalizedData = Array.isArray(trackingData) ? trackingData : [trackingData];
        const tableContainer = document.getElementById('trackedApplicationShow');
        let stepsHTML = '';
        // console.log(normalizedData);
        normalizedData.forEach((step, index) => {
            if (index === 0) {
                stepsHTML += `
                <li class="step-item">
                    <div class="card card-body">
                        <div class="card-status-top bg-primary"></div>
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">You</h4>
                            <div class="d-flex align-items-center">${step['SubmitDate'] || ''}
                             </div>
                        </div>
                        <div class="text-primary"><strong>Subject:</strong> ${step['Subject'] || ''}</div>
                        <div class="h4 m-0">${step['Description'] || ''}</div>
                        ${step['FilePath']!='null' ? `<div class="h4 m-0 text-primary"><a href="http://erp.gku.ac.in:86/Images/Grievance/${step['FilePath']}" class="btn">Attachment: &nbsp;<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 4c4.29 0 7.863 2.429 10.665 7.154l.22 .379l.045 .1l.03 .083l.014 .055l.014 .082l.011 .1v.11l-.014 .111a.992 .992 0 0 1 -.026 .11l-.039 .108l-.036 .075l-.016 .03c-2.764 4.836 -6.3 7.38 -10.555 7.499l-.313 .004c-4.396 0 -8.037 -2.549 -10.868 -7.504a1 1 0 0 1 0 -.992c2.831 -4.955 6.472 -7.504 10.868 -7.504zm0 5a3 3 0 1 0 0 6a3 3 0 0 0 0 -6z" /></svg></a></div>
                            ` :''}
                    </div>
                </li>`;
                
                stepsHTML += `
                <li class="step-item">
                    <div class="card card-body">
                        <div class="card-status-top bg-primary"></div>
                        <div class="d-flex justify-content-between align-items-center">
                        <div class="">
                        <div class="text-success">${step['EmployeeRemarks'] || ''}</div>
                                ${step['EmployeeName'] || ''} (${step['EmployeeId'] || ''})-${step['EmployeeDesignation'] || ''}- ${step['EmployeeDepartment'] || ''}
                              
                            </div>
                              <div class="text-secondary">${step['ForwardDateTime'] || ''}</div>
                          

                        </div>
                      
                    </div>
                </li>
                `;
                
            } else {
   
                stepsHTML += `
                <li class="step-item">
                    <div class="card card-body">
                        <div class="card-status-top bg-primary"></div>
                        <div class="d-flex justify-content-between align-items-center">
                        <div class="">
                        <div class="text-success">${step['EmployeeRemarks'] || ''}</div>
                               ${step['EmployeeName'] || ''} (${step['EmployeeId'] || ''})-${step['EmployeeDesignation'] || ''}- ${step['EmployeeDepartment'] || ''}
                               
                            </div>
                           <div class="text-secondary">${step['ForwardDateTime'] || ''}</div>
                           
                           
                        </div>
                       
                    </div>
                </li>
`;

            }
        });

        tableContainer.innerHTML = `
          <div class="col-lg-12">
            <div class="card">
            <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Application No: ${normalizedData[0]['TokenNo'][0] || ''}</h4>
                            <div class="d-flex align-items-center"><b>Status:&nbsp; </b> <b class="text-${normalizedData[0]['Status']==2 ? 'success':'warning' || ''}">  ${normalizedData[0]['Status']==2 ? ' Completed':' Forwarded' || ''}</b></div>
                        </div>
               
                <ul class="steps steps-vertical">
                  ${stepsHTML}
                </ul>

              </div>
            </div>
          </div>`;
    })
    .catch(error => {
        hideLoader();
        console.error('Error:', error);
        showErrorMessage('An error occurred while fetching complaint tracking data. Please try again later.');
    });
}



// function trackComplaint() {
//     showLoader();
//     const complaint_no = document.getElementById('complaint_no').value;
//     if(!complaint_no)
//     {
//         showErrorMessage('Please select an semester.');
//         hideLoader();
//         return; 
        
//     }
   
//     fetch('/complaintTrack', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//         },
//         body: JSON.stringify({ complaintno: complaint_no})
//     })
//     .then(response => {
//         // console.log('Raw response:', response);
//         if (!response.ok) {
//             throw new Error(`HTTP error! status: ${response.status}`);
//         }
//         hideLoader();
//         return response.text().then(text => {
//             return text ? JSON.parse(text) : {};
//         });
        
//     })
//     .then(data => {
//         hideLoader();
//         console.log(data['trackingData']);
//         const datashow=data['trackingData'][0];
//         const datashowloop=data['trackingData'];
//         const Status=data['trackingData'][0]['Action'];
        
//         const tableContainer = document.getElementById('trackedApplicationShow');
//         tableContainer.innerHTML = `
//           <div class="col-lg-12">
//                 <div class="card">
//                   <div class="card-body">
//                     <h3 class="card-title">Application No: `+datashow['ComplaintNo']+`-- `+datashowloop.length+`</h3>
//                     <ul class="steps steps-vertical">
//                       <li class="step-item">
//                         <div class="h4 m-0">You</div>
//                         <div class="text-success">`+datashow['Complaint']+`</div>
//                         <div class="text-primary"><strong>Subject:</strong> `+datashow['Comments']+`</div>
//                         <div class="text-secondary">`+datashow['ComplaintDate']+`</div>
//                       </li>`
//                           for (let i = 0; i < datashowloop.length; i++) {`
//                       <li class="step-item ">
//                         <div class="h4 m-0">`+datashow['ComplaineeName']+`(`+datashow['ComplaineeIDNo']+`)</div>
//                         <div class="text-secondary">`+datashow['ForwardToRemarks']+`</div>
//                         <div class="text-secondary">`+datashow['ForwardedDate']+`</div>
//                       </li>
//                            `}`
//                       <li class="step-item">
//                         <div class="h4 m-0">Completed</div>
//                         <div class="text-secondary"></div>
//                       </li>
//                     </ul>
//                   </div>
                 
//                 </div>
//               </div>

    
//         `;
//     })
//     .catch(error => {
//         hideLoader();
//         showErrorMessage('An error occurred while fetching subjects. Please try again later.');
//     });
// }



function updateTextBox() {
    var searchType = document.getElementById("searchType").value;
    var textBox = document.getElementById("searchValue");

    // Update placeholder text based on selected search type
    switch (searchType) {
        case "Edition":
            textBox.placeholder = "Enter Edition";
            break;
        case "Title":
            textBox.placeholder = "Enter Title";
            break;
        case "AccessionNo":
            textBox.placeholder = "Enter Accession Number";
            break;
        case "Author":
            textBox.placeholder = "Enter Author";
            break;
        case "Publisher":
            textBox.placeholder = "Enter Publisher";
            break;
        default:
            textBox.placeholder = "Enter Search Value";
            break;
    }
}

function showLoaders() {
    document.getElementById('fullScreenLoader').style.display = 'flex';
}



function loadState(country) {
    showLoader();
    const stateDrop = document.getElementById('outside_state');
            stateDrop.innerHTML = '<option value="">Choose State</option>';
    fetch('/fetch-states', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ ID: country })
    })
    .then(response => response.json())
    .then(states => {
        hideLoader();
                        states.forEach(spot => {
                            let option = document.createElement('option');
                            option.value = spot.id;
                            option.text = spot.name;
                            stateDrop.add(option);
                        });
                    })
    .catch(error => console.error('Error:', error));
}
function loadCity(country) {
    showLoader();
    const cityDrop = document.getElementById('outside_city');
            cityDrop.innerHTML = '<option value="">Choose city</option>';
    fetch('/fetch-citys', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ ID: country })
    })
    .then(response => response.json())
    .then(citys => {
        hideLoader();
                        citys.forEach(spot => {
                            let option = document.createElement('option');
                            option.value = spot.id;
                            option.text = spot.name;
                            cityDrop.add(option);
                        });
                    })
    .catch(error => console.error('Error:', error));
}


function loadState_i(country) {
    showLoader();
    const stateDrop = document.getElementById('state');
            stateDrop.innerHTML = '<option value="">Choose State</option>';
    fetch('/fetch-states', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ ID: country })
    })
    .then(response => response.json())
    .then(states => {
        hideLoader();
                        states.forEach(spot => {
                            let option = document.createElement('option');
                            option.value = spot.id;
                            option.text = spot.name;
                            stateDrop.add(option);
                        });
                    })
    .catch(error => console.error('Error:', error));
}
function loadCity_i(country) {
    showLoader();
    const cityDrop = document.getElementById('city');
            cityDrop.innerHTML = '<option value="">Choose city</option>';
    fetch('/fetch-citys', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ ID: country })
    })
    .then(response => response.json())
    .then(citys => {
        hideLoader();
                        citys.forEach(spot => {
                            let option = document.createElement('option');
                            option.value = spot.id;
                            option.text = spot.name;
                            cityDrop.add(option);
                        });
                    })
    .catch(error => console.error('Error:', error));
}



// Apply Documents SIC

function viewApplyDsassocuments(id) {
    showLoader();
    fetch('/fetch-apply-documents', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ ID: id })
    })
    .then(response => response.json())
    .then(result => {
        hideLoader();

        const docsData = result.data;

        const modalBody = document.querySelector('#modal-view-apply-documents .modal-body');

        let html = `
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody> 
                       
                        <tr><th>Applied For</th><td>${docsData.AppliedDoc}</td></tr>
                        <tr><th>Amount</th><td>₹${docsData.Amount}</td></tr>
                        <tr><th>Delivery Mode</th><td>${docsData.ReceivingType}</td></tr>
                        <tr><th>Address</th><td>
                            ${docsData.AddressLine}, ${docsData.District}, ${docsData.State}, ${docsData.Country} - ${docsData.Pin}
                        </td></tr>
                        <tr><th>Documents</th><td>
                            <ul>
                                ${docsData.Docs.map(doc => `<li>${doc.DocumentName}</li>`).join('')}
                            </ul>
                        </td></tr>
                    </tbody>
                </table>
            </div>
        `;

        modalBody.innerHTML = html;

        // Show the modal
        const modal = new bootstrap.Modal(document.getElementById('modal-view-apply-documents'));
        modal.show();
    })
    .catch(error => {
        console.error('Error:', error);
        hideLoader();
    });
}

function viewApplyDocuments(id) {
    showLoader();
    fetch('/fetch-apply-documents', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ ID: id })
    })
    .then(response => response.json())
    .then(result => {
        hideLoader();
        const data = result.data;

        // Fill form
        document.getElementById('edit_id').value = data.Id;
        document.getElementById('edit_IDNo').value = data.IDNo;
        document.getElementById('edit_appliedDoc').value = data.AppliedDoc;
        document.getElementById('edit_amount').value = data.Amount;
        document.getElementById('edit_receivingType').value = data.ReceivingType;
        document.getElementById('edit_submitDate').value = new Date(data.SubmitDate).toLocaleDateString();

        document.getElementById('edit_country').value = data.Country || '';
        document.getElementById('edit_state').value = data.State || '';
        document.getElementById('edit_district').value = data.District || '';
        document.getElementById('edit_pin').value = data.Pin || '';
        document.getElementById('edit_addressLine').value = data.AddressLine || '';

        // Show/hide address
        toggleAddressSection(data.ReceivingType);

        // Render documents
        const docContainer = document.getElementById('edit_docsList');
        docContainer.innerHTML = '';
        data.Docs.forEach(doc => {
            docContainer.innerHTML += `
                <div class="col-md-4">
                    <div class="border p-2 rounded bg-light">
                        <strong>${doc.DocumentName}</strong>
                        <br>Status: <span class="text-${doc.DocStatus == 1 ? 'success' : 'warning'}">
                            ${doc.DocStatus == 1 ? 'Uploaded' : 'Pending'}
                        </span>
                    </div>
                </div>
            `;
        });

        const modal = new bootstrap.Modal(document.getElementById('modal-view-apply-documents'));
        modal.show();
    })
    .catch(error => {
        hideLoader();
        console.error('Error fetching data:', error);
    });
}

document.getElementById('edit_receivingType').addEventListener('change', function () {
    toggleAddressSection(this.value);
});

function toggleAddressSection(receivingType) {
    const section = document.getElementById('edit_addressSection');
    if (receivingType === 'By Hand') {
        section.style.display = 'none';
    } else {
        section.style.display = 'block';
    }
}